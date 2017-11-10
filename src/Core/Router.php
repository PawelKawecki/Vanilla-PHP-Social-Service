<?php

namespace App\Core;

class Router
{
    
    protected static $routes = [
        'GET'   => [],
        'POST'  => []
    ];

    public static function get(string $url, string $action)
    {
        if (isset(self::$routes['GET'][$url])) {
            throw new \Exception('Route already defined for this URL');
        }

        self::$routes['GET'][$url] = $action;
    }

    public static function post(string $url, string $action)
    {
        if (isset(self::$routes['POST'][$url])) {
            throw new \Exception('Route already defined for this URL');
        }

        self::$routes['POST'][$url] = $action;
    }

    public static function resolveAction(string $requestType, string $url)
    {
        if (self::methodDontExist($requestType)) {
            throw new \Exception('Method not allowed');
        }

        if (self::routeDontExist($requestType, $url)) {
            throw new \Exception('Route does not exist for ' . $url);
        }

        return self::callAction(self::$routes[$requestType][$url]);
    }

    protected static function callAction(string $action)
    {
        list($controllerName, $method) = explode('@', $action);
        $controller = "App\\Controllers\\$controllerName";

        $controller = new $controller;

        if (!method_exists($controller, $method)) {
            throw new \Exception("Method $method does not exists in controller $controller");
        }

        return $controller->$method();
    }


    /**
     * @param string $requestType
     *
     * @return bool
     */
    protected static function methodDontExist(string $requestType): bool
    {
        return !array_key_exists($requestType, self::$routes);
    }

    /**
     * @param string $requestType
     * @param string $url
     *
     * @return bool
     */
    protected static function routeDontExist(string $requestType, string $url): bool
    {
        return !isset(self::$routes[$requestType][$url]);
    }

    public static function getAll()
    {
        return self::$routes;
    }
}