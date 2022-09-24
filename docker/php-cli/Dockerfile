FROM php:8.1-cli-alpine

# Install dependencies
RUN apk add --no-cache --update \
    autoconf g++ make \
    postgresql-dev \
    && pecl install xdebug redis \
    && docker-php-ext-install pgsql pdo_pgsql pcntl \
    && docker-php-ext-enable xdebug redis \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql

# Copy configs
COPY ./docker/php/config /usr/local/etc/php/conf.d

# Install composer
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

# Set default directory
WORKDIR /app/src