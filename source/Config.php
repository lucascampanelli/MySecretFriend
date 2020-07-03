<?php

    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__."\..");
    $dotenv->load();

    define("URL", "http://localhost/mysecretfriend");
    
    define("SITE", "MySecretFriend");

    define("DATA_LAYER_CONFIG", [
        "driver" => $_ENV['DRIVER_DB'],
        "host" => $_ENV['HOST_DB'],
        "port" => $_ENV['PORT_DB'],
        "dbname" => $_ENV['NAME_DB'],
        "username" => $_ENV['USERNAME_DB'],
        "passwd" => $_ENV['PASSWD_DB'],
        "options" => [
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
            PDO::ATTR_CASE => PDO::CASE_NATURAL
        ]
    ]);
    
    define("SMTP_MAIL_CONFIG", [
        "host" => $_ENV['HOST_SMTP'],
        "port" => $_ENV['PORT_SMTP'],
        "user" => $_ENV['USER_SMTP'],
        "passwd" => $_ENV['PASSWD_SMTP'],
        "from_name" => $_ENV['FROM_NAME_SMTP'],
        "from_email" => $_ENV['FROM_EMAIL_SMTP']
    ]);

    function url(string $uri = null):string{
        if($uri){
            return URL."/{$uri}";
        }
        return URL;
    }
