<?php

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/App.php';
require __DIR__ . '/Database.php';

$app = new App();

$pdo = new PDO('mysql:host=localhost;dbname=social_media;charset=utf8', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$app->register(new Database($pdo));


