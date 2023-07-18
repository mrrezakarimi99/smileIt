# SMILE IT

## requirements
- php 8.1
- composer
- mysql 8.0
- laravel 8.0
- docker (optional) 
  - for use docker just checkout to dockerize branch

# usage

#### clone and install
```bash
git clone https://github.com/mrrezakarimi99/smileIt
cd smileIt
```
#### config .env files
```bash
cp .env.example .env # and edit it for your database
```
#### install and run
```bash
composer install
php artisan key:generat
php artisan migrate
php artisan db:seed
php artisan serve
```

#### help for install composer

```bash
curl -sS https://getcomposer.org/installer | php
mv composer.phar /usr/local/bin/composer
```

#### help for install mysql

```bash
sudo apt install mysql-server
```

#### help for install php and some necessary extensions

```bash
sudo apt install php php-cli php-fpm php-json php-pdo php-mysql php-zip php-gd php-mbstring php-curl php-xml php-pear php-bcmath
```

#### if you want to run tests

```bash
php artisan test
```

