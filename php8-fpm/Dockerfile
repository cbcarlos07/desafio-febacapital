FROM php:8.0.2-fpm-buster

RUN docker-php-ext-install pdo pdo_mysql bcmath opcache 

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install unzip utility and libs needed by zip PHP extension 
RUN apt-get update && apt-get install -y \
    default-mysql-client \
    zlib1g-dev \
    libzip-dev \
    unzip



RUN docker-php-ext-install zip

# RUN useradd -G www-data,root -u $uid -d /home/$user $user
# RUN mkdir -p /home/$user/.composer && \
#     chown -R $user:$user /home/$user

# USER $user
COPY wait-for-it.sh /usr/local/bin/wait-for-it.sh
COPY init.sh /usr/local/bin/init.sh

RUN chmod +x /usr/local/bin/wait-for-it.sh
RUN chmod +x /usr/local/bin/init.sh

EXPOSE 9000
ENTRYPOINT ["/usr/local/bin/init.sh"]
CMD ["php-fpm"]
