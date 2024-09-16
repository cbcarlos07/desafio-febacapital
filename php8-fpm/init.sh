#!/bin/bash

# Esperar o MySQL estar pronto
/usr/local/bin/wait-for-it.sh db:3306 --timeout=30 --strict -- echo "MySQL está pronto"

# Criar o banco de dados
echo "Criando o banco de dados..."
mysql -h"db" -u"root" -p"secret" -e "CREATE DATABASE IF NOT EXISTS db_client;"

# Executar o Composer Install
echo "Executando o Composer install..."
cd /var/www/html && composer install

# Executar as migrações do Yii
echo "Executando as migrações do Yii..."
php /var/www/html/yii migrate --interactive=0

echo "Todos os comandos foram executados com sucesso."

# Iniciar PHP-FPM
php-fpm