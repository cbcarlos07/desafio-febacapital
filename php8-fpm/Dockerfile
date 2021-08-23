FROM php:8.0.1-fpm-buster

RUN docker-php-ext-install pdo pdo_mysql bcmath opcache

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

USER $user

EXPOSE 9000
ENTRYPOINT ["php-fpm"]
