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

    /**
     * Registers user into database.
     *
     * @param array $data
     *
     * @return mixed
     * @throws UserAlreadyExistsException
     */
    public static function register(array $data)
    {
        static::init();

        $user = static::$repository->getByAttribute('username', $data['username']);

        if (!empty($user)) {
            throw new UserAlreadyExistsException('User Already Exists');
        }

        return static::$repository->save($data);
    }

    /**
     * Login user into application.
     *
     * @param array $data
     *
     * @throws UserNotFoundException
     * @throws \Exception
     */
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

        static::createSession($user);

    }

    /**
     * Create database session with token and sets cookie.
     *
     * @param \stdClass $user
     */
    private static function createSession(\stdClass $user)
    {
        $cryptoStrong = true;

        $token = bin2hex(openssl_random_pseudo_bytes(64, $cryptoStrong));

        $userTokenRepository = \App::get('userTokenRepository');

        $userTokenRepository->save([
            'user_id'   => $user->id,
            'token'     => sha1($token)
        ]);

        self::setTokenCookie($token);
    }

    /**
     * Determines if two given passwords are equal
     *
     * @param string $password
     * @param string $password1
     *
     * @return bool
     */
    private static function verifyPassword(string $password, string $password1)
    {
        return password_verify($password, $password1);
    }

    /**
     * Creates cookie and sets a user token
     *
     * @param string $token
     */
    private static function setTokenCookie(string $token): void
    {
        setcookie('SNID', $token, time() + 60 * 60 * 24 * 7, '/', null, null, true);
    }

}