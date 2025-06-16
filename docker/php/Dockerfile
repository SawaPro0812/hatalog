FROM php:8.3.7-apache

# ドキュメントルートを変更
ENV APACHE_DOCUMENT_ROOT /var/www/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# 必要パッケージインストール
RUN apt-get update && apt-get install -y \
    curl \
    gnupg \
    git \
    unzip \
    zlib1g-dev \
    libzip-dev \
    libicu-dev \
    libonig-dev \
    locales \
    vim \
    # Node.jsとnpmをインストール（v20）
    && curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Apache の rewrite_module を有効化
RUN a2enmod rewrite

# PHP の拡張をインストール
RUN docker-php-ext-install \
    intl \
    pdo_mysql \
    zip

# Xdebug をインストール
RUN pecl install xdebug && \
    docker-php-ext-enable xdebug

# Composer インストール（Composer公式イメージから）
COPY --from=composer /usr/bin/composer /usr/bin/composer

# 作業ディレクトリ
WORKDIR /var/www
