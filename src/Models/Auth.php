<?php

namespace App\Models;

use App\Exceptions\UserAlreadyExistsException;
use App\Exceptions\UserNotFoundException;
use App\Repositories\UserRepository;
use App\Repositories\UserTokenRepository;

class Auth
{

    /**
     * @var UserRepository $userRepository
     */
    private static $userRepository;

    /**
     * @var UserTokenRepository $userTokenRepository
     */
    private static $userTokenRepository;

    /**
     * Auth initial function.
     */
    public static function init()
    {
        static::$userRepository = \App::get('userRepository');
        static::$userTokenRepository = \App::get('userTokenRepository');
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

        $user = static::$userRepository->getByAttribute('username', $data['username']);

        if (!empty($user)) {
            throw new UserAlreadyExistsException('User Already Exists');
        }

        return static::$userRepository->save($data);
    }

    /**
     * Login user into application.
     *
     * @param array $data
     *
     * @throws UserNotFoundException
     * @throws \Exception
     *
     * @return bool
     */
    public static function login(array $data)
    {
        static::init();

        $userCollection = static::$userRepository->getByAttribute('username', $data['username']);

        if (empty($userCollection)) {
            throw new UserNotFoundException('User not found');
        }

        //Gets the first user from Collection returned by database
        $user = $userCollection[0];

        if (!static::verifyPassword($data['password'], $user->password)) {
            throw new \Exception('Password does not match');
        }

        if (Auth::check()) {
            throw new \Exception('User already logged in');
        }

        static::createSession($user);

        return true;
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

        static::$userTokenRepository->save([
            'user_id' => $user->id,
            'token'   => sha1($token),
        ]);

        self::setTokenCookie($token, time() + 60 * 60 * 24 * 7);
    }

    /**
     * Checks if user is logged in.
     *
     * @return bool
     */
    public static function check()
    {
        static::init();

        if (!isset($_COOKIE['SNID'])) {
            return false;
        }

        if (empty(static::$userTokenRepository->getByAttribute('token', sha1($_COOKIE['SNID'])))) {
            return false;
        }

        return true;
    }

    /**
     * Returns logged user or null if user is not logged in.
     *
     * @return null|\stdClass $user
     */
    public static function user()
    {
        static::init();

        if (!isset($_COOKIE['SNID'])) {
            return null;
        }

        $userCollection = static::$userRepository->join(static::$userTokenRepository->getTable(),
            'users.id = user_tokens.user_id', ['users.*', 'user_tokens.token']);

        if (empty($userCollection)) {
            return null;
        }

        return $userCollection[0];
    }

    /**
     * Logout user from one or every device.
     *
     * @param array $data
     *
     * @throws \Exception
     *
     * @return bool
     */
    public static function logout(array $data)
    {
        static::init();

        if (is_null($user = Auth::user())) {
            throw new \Exception('User already logged out');
        }

        if (isset($data['allDevices'])) {
            static::$userTokenRepository->deleteWhere("user_id = {$user->id}");
        } else {
            if (isset($_COOKIE['SNID'])) {
                static::$userTokenRepository->deleteWhere("token = '" . sha1($_COOKIE['SNID']) . "'");
            }
        }

        static::setTokenCookie('1', time() - 100);

        return true;
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
     * @param integer $time
     */
    private static function setTokenCookie(string $token, int $time)
    {
        setcookie('SNID', $token, $time, '/', null, null, true);
    }

}