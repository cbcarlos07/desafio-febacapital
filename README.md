# php8-nginx-docker
Ambiente de desenvolvimento PHP 8 + JIT habilitado, Nginx, SGBD MySQL e Adminer

**Pré-requisitos:** Ter o Docker e Docker-compose instalados.


[Instalando Docker no Windows 10](https://mundodacomputacaointegral.blogspot.com/2019/10/instalando-o-docker-no-windows.html)

[Instalando Docker e Docker-compose no Linux (qualquer distro)](https://mundodacomputacaointegral.blogspot.com/2019/10/instalando-docker-e-docker-compose-no-Linux.html)

Após ter instalado o Docker e Docker-compose, segue os procedimentos: 

1. Fork do repositório

2. Clonar o repositório forkado

3. Acessar o diretório onde salvou o clone do repositório

4. Execute `docker-compose up -d` ou `docker-compose up` para ver os logs

O diretório src do HOST é o volume mapeado no diretório /var/www/html do CONTAINER. Então, é no diretório src que deve salvar os arquivos .php.

No browser http://localhost/info.php e veja o JIT e outras extensões habilitadas do PHP.

Acessar a ferramenta web para gerenciar o banco de dados no SGBD MySQL, acesse http://localhost:8080 as credencias de acesso, encontra-se no arquivo docker-compose.yml

Feito!

## Script automatizado

Ao executar o comando para subir o docker-compose, por favor espere ao menos de uns 30 segundos a 1 minuto para que a aplicação crie:

1. O banco de dados
2. Instale as dependências
4. As tabelas
5. Faça uns inserts iniciais

## Testes

Para testes de enpoint foi disponilizado o arquivo json ([Insomnia_2024-09-16.json](https://github.com/cbcarlos07/desafio-febacapital/blob/main/Insomnia_2024-09-16.json)) do insomnia para testar os endpoints

Para testar qualquer endpoint é preciso primeiro chamar o endpoint auth

Para poder testar os outros endpoints

![print](https://github.com/cbcarlos07/desafio-febacapital/blob/main/prints/Screenshot_1.png)




# O Desafio

## Para criar o banco de dados

Caso o script automático não execute pode-se executar os seguintes comandos

Para criar o banco de dados execute seguinte comando no container `mysql1`

    CREATE DATABASE db_client;

Para criar as tabelas e o insert inicial de usuários o comando dentro do container `php8-fpm`

    php yii migrate

Caso dê problema em algum migrate e queira desfazer Para desfazer um item

    php yii migrate/down 1

Para desfazer tudo

    php yii migrate/down all

Ou 

    php yii migrate/down

O comando para criar usuário dentro do container `php8-fpm` é

    php yii create-user/index --username=seuusuario --password=sua-senha --name="Seu Nome"

ou

    php yii create-user/index -u=seuusuario -p=sua-senha -n="Seu Nome"
