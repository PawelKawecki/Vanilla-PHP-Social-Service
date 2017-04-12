<?php

require __DIR__ . '/config.php';
require __DIR__ . '/functions.php';
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/App.php';
require __DIR__ . '/Database.php';

$pdo = new PDO('mysql:host=localhost;dbname=social_media;charset=utf8', 'root', 'root');

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

App::bind('db', new Database($pdo));

App::bind('userRepository', new \App\Repositories\UserRepository());
App::bind('userTokenRepository', new \App\Repositories\UserTokenRepository());

//App::bind('message', new \App\Models\Message());

//\App\Models\Auth::login(['username' => 'Mateuszku', 'password' => 'qweqwe']);
//\App\Models\Auth::logout([]);

//
//dump(\App\Models\Auth::check());
//dump(\App\Models\Auth::user());