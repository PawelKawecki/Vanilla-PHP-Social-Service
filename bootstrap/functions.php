<?php

function url(string $path = '')
{
    $url = explode('/', $_SERVER['REQUEST_URI']);

    $url = "/$url[1]/$path";

    return $url;
}