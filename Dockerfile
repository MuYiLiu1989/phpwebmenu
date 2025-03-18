FROM php:8.2-apache

WORKDIR /var/www/html

COPY . .

# 安装 mysqli 和 pdo_mysql 和 mongodb 扩展
RUN docker-php-ext-install mysqli \
&& echo "date.timezone=Asia/Taipei" > /usr/local/etc/php/conf.d/timezone.ini \
&& pecl install mongodb \
&& docker-php-ext-enable mongodb 