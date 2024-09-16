
# O Desafio

## Para criar o banco de dados

Para criar o banco de dados execute seguinte comando

    CREATE DATABASE db_client;

Para criar as tabelas e o insert inicial de usuários o comando dentro do container

    php yii migrate

Para desfazer um item

    php yii migrate/down 1

Para desfazer tudo

    php yii migrate/down all

Ou 

    php yii migrate/down

O comando para criar usuário é

    php yii create-user/index --username=seuusuario --password=sua-senha --name="Seu Nome"

ou

    php yii create-user/index -u=seuusuario -p=sua-senha -n="Seu Nome"
