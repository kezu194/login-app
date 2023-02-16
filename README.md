# Login Form Security Project

## Features:
- Login
- Create account
- Logout
- Reset form
- Limit to 6 try to connection before ban of 1 min
- Limit access to folder of web page
- b64 encoding of the logo image
- Apply a regex on password (lowercase, uppercase, symbol, number, size)
- Hash of all password in database

## Technologies

- PHP Version 7.2.34
- Apache Version 2.4.38 (Debian) 
- MYSQL 8.0.32 - MySQL Community Server - GPL 

## Prerequies

In order to execute this project and visualize the web site, you need to have **Docker** and **Docker-compose** installed on your device. This project consist of a *docker-compose.yml* that will diffuse the different service on certain ports like the database and the website that is working with apache.

## How to launch

- In a terminal located in the folder of the project, type: 
```
$ docker-compose up
```

- Then you need to add a specific package to the PHP-Apache docker. Open a new terminal and type the following command in the right order:
```
$ docker ps (read the Container ID of the 'php:7.2-apache')
$ docker exec -it {containerId} bash
$ docker-php-ext-install pdo pdo_mysql
Ctrl+d to leave the docker
$ docker restart {containerId}
```
That's it! To visualize the website, go to **http://localhost:4200** .<br>
To access the phpMyAdmin page, go to **http://localhost:8080/index.php** <br>

## Password and logins

phpMyAdmin:
- username: php_docker
- password: password

Web Page:
- accounts:
    - account1
        - username: robin
        - password: Pass-word93
    - account2
        - username: yann
        - password: Pass-word93
    - account3
        - username: patrice
        - password: New-password95

