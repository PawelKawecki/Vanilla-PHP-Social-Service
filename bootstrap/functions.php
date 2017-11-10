<?php

function url(string $path = '')
{
    $url = explode('/', $_SERVER['REQUEST_URI']);

//    $url = "/$url[1]/$path";
    $url = "/$path";

    return $url;
}

function redirect(string $path = '')
{
    //TODO
    //FIXME BORKEN SHIET
    if (getenv('ENV') == 'docker') {
        header("Location: {$_SERVER['HTTP_HOST']}" . url($path));
    } else {
        header("Location: http://{$_SERVER['SERVER_NAME']}:{$_SERVER['SERVER_PORT']}" . url($path));
    }
}

function view(string $view, array $data = [])
{
    extract($data);

    return require_once __DIR__ . "/../public/views/$view.php";
}