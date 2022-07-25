#! /bin/bash

composer install
composer dump-autoload

$DB_HOST
$DB_PORT
$DB_NAME
$DB_USERNAME
$DB_PASSWORD
if [[ -f "config/config.php" ]]; then
    echo "Starting server at port 5000"
    cd public
    php -S localhost:5000


else

    touch config/config.php
    cd config
    echo "<?php" >>config.php
    echo "" >>config.php
    echo "Enter the following variables"
    echo "Enter IP of the Host"
    read DB_HOST
    echo '$DB_HOST= "'$DB_HOST'";' >>config.php
    echo "Enter a Port value"
    read DB_PORT
    echo '$DB_PORT= "'$DB_PORT'";' >>config.php
    echo "Enter the name of the database: "
    read DB_NAME
    echo '$DB_NAME= "'$DB_NAME'";' >>config.php
    echo "Enter the username for the mysql server"
    read DB_USERNAME
    echo '$DB_USERNAME= "'$DB_USERNAME'";' >>config.php
    echo "Enter the password"
    read -s DB_PASSWORD
    echo '$DB_PASSWORD= "'$DB_PASSWORD'";' >>config.php
    echo "?>" >>config.php

    cd ..
    mysql -u $DB_USERNAME -p$DB_PASSWORD -e "create database $DB_NAME"

    if [ $? -eq 0 ]; then
        mysql -u $DB_USERNAME -p$DB_PASSWORD $DB_NAME <schema/schema.sql
        if [ $? -eq 0 ]; then
            echo "Starting server at port 5000"
            cd public
            php -S localhost:5000
        else
            echo "Invalid username or password for the database connection"
            rm config/config.php
        fi

    else
        echo "Invalid username or password for the database connection or the database already exists on your mysql server"
        rm config/config.php
    fi
fi
