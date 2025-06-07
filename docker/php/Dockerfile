FROM php:8.3.7-apache

# ドキュメントルートを変更
ENV APACHE_DOCUMENT_ROOT /var/www/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# パッケージインストール
RUN apt-get update && apt-get install -y \
    libicu-dev \
    libonig-dev \
    libzip-dev \
    zlib1g-dev \
    unzip \
    locales \
    vim \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Apache の rewrite_module を有効化
RUN a2enmod rewrite

# PHP のエクステンションをインストール 〜コメントアウトしているライブラリはお好みで〜
RUN docker-php-ext-install \
    # ctype \
    # curl \
    # dom \
    # fileinfo \
    # filter \
    # hash \
    intl \
    # json \
    # mbstring \
    # openssl \
    # pcre \
    # PDO \
    pdo_mysql \
    # pdo_sqlite \
    # session \
    # tokenizer \
    # xml \
    zip

RUN pecl install xdebug && \
    docker-php-ext-enable xdebug

# Composer インストール
COPY --from=composer /usr/bin/composer /usr/bin/composer

# コンテナログイン時のパス指定
WORKDIR /var/www
