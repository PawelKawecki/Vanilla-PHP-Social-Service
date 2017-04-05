<?php

require __DIR__ . '/config.php';
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/App.php';
require __DIR__ . '/Database.php';

$pdo = new PDO('mysql:host=localhost;dbname=social_media;charset=utf8', 'root', 'root');

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

App::bind('db', new Database($pdo));




