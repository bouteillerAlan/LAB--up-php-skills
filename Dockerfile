FROM php:8.3-fpm

# same uid has the local user, this facilite handling file w/ artisant for example
ARG uid=1000
ARG user=a2n

# setup php and package needed for composer, larevel and so on
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    libpq-dev \
    libzip-dev \
    libcurl4-openssl-dev \
    zip \
    unzip \
    default-mysql-client \

# cleanup
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# php module required by laravel
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd zip curl intl

# system user for composer & artisan
# we use the arg for giving the same uid and name for avoiding problem w/ files permissions
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

# install composer from the latest docker image
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# set working dir
WORKDIR /var/www

# change to the new syst user
USER $user