<?php

namespace App\Forms;

class RegisterForm implements Forms
{
    private $database;

    private $table = 'users';

    public function __construct(\Database $database)
    {
        $this->database = $database;
    }

    public function process($data)
    {
        if (!isset($data['username']) || strlen(trim($data['username'])) < 1 ) {
            throw new \InvalidArgumentException('username');
        }

        if (!isset($data['email']) || strlen(trim($data['email'])) < 1 ) {
            throw new \InvalidArgumentException('email');
        }

        if (!isset($data['password']) || strlen(trim($data['password'])) < 6 ) {
            throw new \InvalidArgumentException('password');
        }

        unset($data['submit']);

        $this->database->insert($this->table, $data);
    }

}