<?php

use App\Exceptions\ServiceAlreadyExistsException;
use App\Exceptions\ServiceNotFoundException;

class App
{

    private static $container = [];

    /**
     * Registers service into container and bind with given key
     *
     * @param string $key
     * @param $service
     *
     * @throws ServiceAlreadyExistsException
     */
    public static function bind(string $key, $service)
    {
        if (array_key_exists($key, self::$container)) {
            throw new ServiceAlreadyExistsException();
        }

        self::$container[$key] = $service;
    }

    /**
     * Gets instance of service by given key
     *
     * @param string $key
     *
     * @return mixed
     * @throws ServiceNotFoundException
     */
    public static function get(string $key)
    {
        if (array_key_exists($key, self::$container)) {
            return self::$container[$key];
        }

        throw new ServiceNotFoundException();
    }

}