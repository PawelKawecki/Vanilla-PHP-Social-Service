<?php

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/functions.php';
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/App.php';
require_once __DIR__ . '/Database.php';
require_once __DIR__ . '/../src/Core/routes.php';

$pdo = new PDO('mysql:host=' . getenv('DB_HOST') . ':' . getenv('DB_PORT') .';dbname=' . getenv('DB_NAME') . ';charset=utf8', getenv('DB_USER'), getenv('DB_PASS'));

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

App::bind('db', new Database($pdo));

App::bind('userRepository', new \App\Repositories\UserRepository());
App::bind('userTokenRepository', new \App\Repositories\UserTokenRepository());

\App\Core\Router::resolveAction($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
die;

//App::bind('message', new \App\Models\Message());

//\App\Models\Auth::login(['username' => 'Mateuszku', 'password' => 'qweqwe']);
//\App\Models\Auth::logout([]);

//
//dump(\App\Models\Auth::check());
//dump(\App\Models\Auth::user());