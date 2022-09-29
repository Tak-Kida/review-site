# どんな docker イメージを利用して構築をするか
# FROM : ここではPHPの公式イメージである「php:7.4-apache」というあらかじめPHPとApacheがインストールされているイメージを、Docker Hubというサイトからダウンロードしてくるようになっている。
FROM php:7.4-apache

# 設定ファイルをdockerコンテナ内のPHP、Apacheに読み込ませる
# ADD：ローカルのファイルをDockerコンテナ内にコピーする
# ADD php.ini /usr/local/etc/php/
RUN touch /usr/local/etc/php/php.ini
RUN echo "[Date] \n\
    date.timezone = "Asia/Tokyo" \n\
    [mbstring] \n\
    mbstring.internal_encoding = "UTF-8" \n\
    mbstring.language = "Japanese" \n\
    EOF" >> /usr/local/etc/php/php.ini

# ADD 000-default.conf /etc/apache2/sites-enabled/
RUN touch /etc/apache2/sites-enabled/000-default.conf
RUN echo "<VirtualHost *:443>\n\
    ServerAdmin webmaster@localhost\n\
    DocumentRoot /var/www/html\n\
    ErrorLog ${APACHE_LOG_DIR}/error.log\n\
    CustomLog ${APACHE_LOG_DIR}/access.log combined\n\
    <Directory /var/www/html/laravel/public>\n\
    AllowOverride All\n\
    </Directory>\n\
    </VirtualHost>" >> /etc/apache2/sites-enabled/000-default.conf

# Composerのインストール
# RUN：コンテナ内でコマンド実行する
RUN cd /usr/bin && curl -s http://getcomposer.org/installer | php && ln -s /usr/bin/composer.phar /usr/bin/composer

# ミドルウェアのインストール
RUN apt-get update \
    && apt-get install -y \
    git \
    zip \
    unzip \
    vim \
    libpng-dev \
    libpq-dev \
    nodejs npm \
    && docker-php-ext-install pdo_mysql

# Laravelで必要になるmodRewriteを有効化する
RUN mv /etc/apache2/mods-available/rewrite.load /etc/apache2/mods-enabled
RUN /bin/sh -c a2enmod rewrite

# 作業ディレクトリをlaravelへ移動
WORKDIR /var/www/html/laravel
