FROM richarvey/nginx-php-fpm:3.1.6

COPY . /var/www/html

# Image config
ENV SKIP_COMPOSER 1
ENV WEBROOT /var/www/html/public
ENV PHP_ERRORS_STDERR 1
ENV RUN_SCRIPTS 1
ENV REAL_IP_HEADER 1

# Laravel config
ENV APP_ENV production
ENV APP_DEBUG false
ENV LOG_CHANNEL stderr

# Allow composer to run as root
ENV COMPOSER_ALLOW_SUPERUSER 1

# Ensure SQLite database and scripts are writable
RUN chown -R www-data:www-data /var/www/html/database \
    && chmod -R 664 /var/www/html/database/database.sqlite \
    && chmod +x /var/www/html/00-laravel-deploy.sh

CMD ["/start.sh"]
