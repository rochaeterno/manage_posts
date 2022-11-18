<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $dynamicRule = $this->method() == "PUT" ? "required" : "nullable";
        return [
            "id" => $dynamicRule . "|string",
            "title" => "required|string",
            "author" => "required|string",
            "content" => "required|string",
            "tags" => ["required","array","min:1"],
        ];
    }
}
