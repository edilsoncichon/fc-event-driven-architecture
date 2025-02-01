FROM php:8.2-cli

RUN apt-get update && apt-get install -y \
    librdkafka-dev \
    git \
    unzip \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    default-mysql-client \
    && docker-php-ext-install pdo_mysql mysqli zip mbstring exif pcntl bcmath gd

RUN pecl install rdkafka && docker-php-ext-enable rdkafka

WORKDIR /app

CMD ["tail", "-f", "/dev/null"]
