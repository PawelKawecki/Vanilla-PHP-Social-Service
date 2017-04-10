<?php

namespace App\Forms;

use App\Models\Auth;

class RegisterForm extends Form
{

    public function process($data)
    {
        $this->data = $data;

        $this->validateInput('username', 2);
        $this->validateInput('email', 6);
        $this->validateInput('password', 6);

        $this->sanitizeForm();

        $this->encryptPassword();

        Auth::register($this->data);
    }


}