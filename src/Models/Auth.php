<?php

namespace App\Models;

use App\Exceptions\UserAlreadyExistsException;
use App\Exceptions\UserNotFoundException;

class Auth
{

    private static $repository;

    /**
     * Auth initial function.
     */
    public static function init()
    {
        static::$repository = \App::get('userRepository');
    }

    public static function register(array $data)
    {
        static::init();

        $user = static::$repository->getByAttribute('username', $data['username']);

        if (!empty($user)) {
            throw new UserAlreadyExistsException('User Already Exists');
        }

        return static::$repository->save($data);
    }

    public static function login(array $data)
    {
        static::init();

        $userCollection = static::$repository->getByAttribute('username', $data['username']);

        if (empty($userCollection)) {
            throw new UserNotFoundException('User not found');
        }

        //Gets the first user from Collection returned by database
        $user = $userCollection[0];

        if (!static::verifyPassword($data['password'], $user->password)) {
            throw new \Exception('Password does not match');
        }

        static::createSession($user, $data);

    }

    private static function createSession($user, array $data)
    {
        $cryptoStrong = true;

        $token = bin2hex(openssl_random_pseudo_bytes(64, $cryptoStrong));

        $userTokenRepository = \App::get('userTokenRepository');

        $userTokenRepository->save([
            'user_id'   => $user->id,
            'token'     => sha1($token)
        ]);

        setcookie('SNID', $token, time() + 60 * 60 * 24 * 7, '/', null, null, true);
    }

    private static function verifyPassword($password, $password1)
    {
        return password_verify($password, $password1);
    }

}