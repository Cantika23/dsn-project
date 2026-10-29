<?php

/**
 * PHPMaker 2022 configuration file (Production)
 */
 
 //14012025
 session_start();

 $menu = isset($_SESSION['menu']) ? $_SESSION['menu'] : 'head_office'; // Default ke head_office jika sesi tidak tersedia

 // Sesuaikan dbname berdasarkan pilihan menu
 if ($menu == 'kalimantan') {
     $dbname = "gs_prod_kalimantan"; // Pilihan untuk Kalimantan
 } else {
     $dbname = "gs_prod"; // Default untuk Head Office
 }

return [
    "Databases" => [
        "DB" => ["id" => "DB", "type" => "MYSQL", "qs" => "`", "qe" => "`", "host" => "localhost", "port" => "3306", "user" => $dbname, "password" => "3EC8pNKP8XWhL33J", "dbname" => $dbname]
        // "DB" => ["id" => "DB", "type" => "MYSQL", "qs" => "`", "qe" => "`", "host" => "localhost", "port" => "3306", "user" => "gun_gs_prod", "password" => "GunG\$Prod", "dbname" => "gun_gs_prod"]
    ],
    "SMTP" => [
        "PHPMAILER_MAILER" => "smtp", // PHPMailer mailer
        "SERVER" => " smtp-relay.gmail.com", // SMTP server
        "SERVER_PORT" => 587, // SMTP server port
        "SECURE_OPTION" => "tls",
        "SERVER_USERNAME" => "", // SMTP server user name
        "SERVER_PASSWORD" => "", // SMTP server password
    ],
    "JWT" => [
        "SECRET_KEY" => "sY89he5mXGlplL8l", // API Secret Key
        "ALGORITHM" => "HS512", // API Algorithm
        "AUTH_HEADER" => "X-Authorization", // API Auth Header (Note: The "Authorization" header is removed by IIS, use "X-Authorization" instead.)
        "NOT_BEFORE_TIME" => 0, // API access time before login
        "EXPIRE_TIME" => 600 // API expire time
    ]
];
