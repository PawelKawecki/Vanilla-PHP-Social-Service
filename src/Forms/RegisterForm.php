<?php

namespace App\Forms;

class RegisterForm extends Form
{

    private $table = 'users';

    public function process($data)
    {
        $this->data = $data;

        $this->validateInput('username', 2);
        $this->validateInput('email', 6);
        $this->validateInput('password', 6);

        $this->sanitizeForm();

        $this->encryptPassword();

        $this->queryBuilder->insert($this->table, $this->data);
    }


}