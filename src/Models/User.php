<?php

namespace App\Models;

use App\Repositories\UserRepository;

class User
{

    /**
     * @var UserRepository $userRepository
     */
    private static $userRepository;

    /**
     * Auth initial function.
     */
    public static function init()
    {
        static::$userRepository = \App::get('userRepository');
    }

    /**
     * Updates users data.
     *
     * @param array $data
     *
     * @return bool
     * @throws \Exception
     */
    public static function update(array $data)
    {
        static::init();

        $user = Auth::user();

        if (empty($user)) {
            throw new \Exception('User Not Found');
        }

        if (!static::verifyPassword($data['old_password'], $user->password)) {
            throw new \Exception('Old password is not correct');
        }

        unset($data['old_password']);

        return static::$userRepository->update($data, "id = $user->id");
    }


    /**
     * Determines if two given passwords are equal
     *
     * @param string $password
     * @param string $password1
     *
     * @return bool
     */
    public static function verifyPassword(string $password, string $password1)
    {
        return password_verify($password, $password1);
    }

}