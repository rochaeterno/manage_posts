<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Http\Resources\PostsResource;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->query('tag')) {
            $tag = Tag::where('name', '=', strtolower($request->query('tag')))->first();
            if ($tag) {
                $tagId = $tag->id;
                $posts = Post::whereHas('tags', function ($q) use ($tagId) {
                    $q->where('tag_id', '=', $tagId);
                })->get();
            }
        }

        $posts = Post::all();

        return PostsResource::collection($posts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        try {
            DB::beginTransaction();

            $payload = array_merge($request->validated());
            $post = Post::create($payload);

            $tags = $request->input('tags');

            if ($post) {
                foreach ($tags as &$tag) {
                    $requested_tag = Tag::where('name', '=', $tag)->first();

                    if (!$requested_tag) {
                        $new_tag = Tag::create(['name' => $tag]);
                        $requested_tag = Tag::find($new_tag->id);
                    }

                    $post->tags()->attach($requested_tag->id);
                }
            }

            DB::commit();
            return new PostsResource($post);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'error' => true,
                'message' => "Não foi possivel cadastrar o post. Por favor entre em contato com o administrador do sistema.",
                "serve_error_message" => $e->getMessage()
            ], 402);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return new PostsResource($post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {
        try {
            DB::beginTransaction();

            $payload = array_merge($request->validated());
            if ($post) {
                $post->update($payload);
                $tags = $request->input('tags');

                foreach ($post->tags as &$tag) {
                    $post->tags()->detach($tag->id);
                }
                foreach ($tags as &$tag) {
                    $requested_tag = Tag::where('name', '=', strtolower($tag))->first();

                    if (!$requested_tag) {
                        $new_tag = Tag::create(['name' => strtolower($tag)]);
                        $requested_tag = Tag::find($new_tag->id);
                    }

                    $post->tags()->attach($requested_tag->id);
                }

                DB::commit();

                $result = Post::findOrFail($post->id);
                return new PostsResource($result);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'error' => true,
                'message' => "Não foi possivel editar o post. Por favor entre em contato com o administrador do sistema.",
                "serve_error_message" => $e->getMessage()
            ], 402);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        try {
            if ($post->delete()) {
                return response()->json([
                    'error' => false,
                    'message' => "204 No Content",
                ], 204);
            }
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => "Não foi possível deletar a noticia selecionada",
                "serve_error_message" => $e->getMessage()
            ], 402);
        }
    }
}
