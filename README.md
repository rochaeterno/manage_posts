# Desafio Post Management Logaroo


### 📝Sobre:
Este projeto foi desenvolvido com o intuito de pleitear uma vaga na Logaroo e se propõe a apresentar uma API que controle as requisições sobre postagens.

### 💻 Tecnologias Utilizadas:
Conforme solicitado, o sistema utiliza Laravel para seu desenvolvimento contando com o uso de recursos como Laravel Sail, PHP Unit e PHPMyAdmin.
Para o DB foi selecionado o MySQL por afinidade do desenvolvedor. 

### 🔧 Preparando o sistema para o uso:
Após baixar o repositório, deve-se instalar suas dependencias. Por conveniência, foi disponibilizado um arquivo ```deploy.sh``` que se encarregará de executar os scripts de instalação. Para conseguir executar este arquivo, é necessário ter uma maquina Unix com Docker e PHP 8.1 ou superior instalado. Depois da configuração inicial, acesse a pasta do projeto clonado e execute os comandos:

 
  #### Inicie o Docker
  ```sudo service docker start```

  #### Crie um alias para o Laravel Sail
  ```alias sail='[ -f sail ] && sh sail || sh vendor/bin/sail'```

  #### Execute o arquivo de deploy
  ```. deploy.sh```

  #### Inicie o servidor
  ```sail up -d```


Após a execução dos comandos, o sistema está pronto para ser testado. No arquivo de deploy, existe uma seeder que popula o banco de dados com alguns posts e tags.

### ❔ Como testar o sistema?
Com o servidor docker iniciado e dentro da pasta do projeto execute o comando ```sail artisan test``` que por sua vez rodará o teste automatizado já pré-programado no sistema.

### ❔ Como testar manualmente as rotas da API
Você tambem pode testar manualmente a API, seja através do arquivo YALM do OpenAPI 3 ou através de um programa que simule requisições como o insominia.
Para testar a API manualmente basta iniciar o servidor docker e acessar o endereço http://localhost/api/docs, caso prefira ultilizar o Insominia ou algum outro programa de sua preferência nesta url você encontrará as rotas assim como suas regras de uso.