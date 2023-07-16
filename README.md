<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>



## How to run on docker

## What we have ?

 Nginx,
 PHP 8.1,
 mariadb

### You need install docker and docker compose for working with docker 

- git clone repository
- run command docker-compose build and docker-compose up -d 
- or if in your locale machine can work with Makefile run command  make init

### How to run composer and artisan command

- For run artisan or composer command before command you need write docker container name.  
- Example - docker exec devstart-app php artisan key:generate or
- Example - docker exec devstart-app composer install

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

[Code Style](./docs/CodeStyle.md)


# devstart-api
