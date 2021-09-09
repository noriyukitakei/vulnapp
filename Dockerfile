FROM php:7.4.16-apache
 
ADD app/index.php /var/www/html
ADD app/todo.php /var/www/html
ADD app/getfile.php /var/www/html

RUN docker-php-ext-install pdo_mysql
