<?php

//use App\Exceptions\ServiceNotFoundException;

class App
{

    private $container;

    /**
     * App constructor.
     * 
     * @param $container
     */
    public function __construct($container = [])
    {
        $this->container = $container;
    }

    public function register($service)
    {
        $this->container[] = $service;
    }

    public function make($service)
    {
        if (in_array($service, $this->container)) {
            return $service;
        }

//        throw new \App\Exceptions\ServiceNotFoundException();
    }

}