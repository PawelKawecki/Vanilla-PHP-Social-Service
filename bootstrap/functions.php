<?php

function url(string $path = '')
{
    $url = explode('/', $_SERVER['REQUEST_URI']);

    $url = "/$url[1]/$path";

    return $url;
}

function redirect(string $path = '')
{
    header("Location: http://{$_SERVER['SERVER_NAME']}:{$_SERVER['SERVER_PORT']}" . url($path));
}