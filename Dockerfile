FROM php:8.1-fpm

RUN apt-get update && apt-get install -y \
    libonig-dev \
    libpng-dev \
    libpq-dev \
    libxml2-dev \
    libzip-dev \
    nginx \
    unzip \
    wget \
    zip
# Add a user with sudo privileges (optional)
ARG user=brawl
ARG uid=1000
RUN useradd -m -s /bin/bash --uid $uid $user && \
    echo "$user ALL=(ALL) NOPASSWD:ALL" >> /etc/sudoers.d/$user

# Install PHP extensions
RUN docker-php-ext-install opcache pdo pdo_pgsql pgsql pdo_mysql mbstring zip exif pcntl bcmath gd simplexml xml xmlwriter
RUN pecl install redis && docker-php-ext-enable redis
RUN pecl install xdebug && docker-php-ext-enable xdebug

RUN apt-get update && \
    apt-get install -y software-properties-common && \
    rm -rf /var/lib/apt/lists/*

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Create system user to run Composer and Artisan Commands
RUN chown -R $user:$user /var/www
RUN useradd -G www-data -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

# Copy Laravel application files
COPY . /var/www
# Set permissions for Laravel storage and bootstrap cache directories
RUN chown -R $user:$user /var/www/storage /var/www/bootstrap/cache
# Expose port 9000
EXPOSE 9000
# Set working directory
WORKDIR /var/www

CMD [ "php-fpm" ]