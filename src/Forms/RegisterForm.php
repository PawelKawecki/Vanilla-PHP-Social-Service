<?php

namespace App\Forms;

use App;

class RegisterForm extends Form
{
    private $database;

    private $table = 'users';

    public function __construct()
    {
        $this->database = App::get('db');
    }

    public function process($data)
    {
        if (!isset($data['username']) || strlen(trim($data['username'])) < 1 ) {
            throw new \InvalidArgumentException('username is not valid');
        }

        if (!isset($data['email']) || strlen(trim($data['email'])) < 1 ) {
            throw new \InvalidArgumentException('email is not valid');
        }

//        $this->validateInput($data['password']);

        $data = $this->sanitizeForm($data);

        $data = $this->encryptPassword($data);

        $this->database->insert($this->table, $data);
    }

    private function sanitizeForm($data)
    {
        unset($data['submit']);

        return $data;
    }

    private function encryptPassword($data)
    {
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

        return $data;
    }

    protected function validateInput($input, $length = 1)
    {
        if (!isset($data['password']) || strlen(trim($data['password'])) < $length) {
            throw new \InvalidArgumentException('password is not valid');
        }
    }


}