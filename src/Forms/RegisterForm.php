<?php

namespace App\Forms;

use App\Models\Auth;
use App\Models\Message;

class RegisterForm extends Form
{

    /**
     * Form constructor.
     */
    public function __construct()
    {
        $this->message = new Message($this);
    }

    /**
     * Process Register form.
     *
     * @param array $data
     *
     * @return bool
     */
    public function process(array $data)
    {
        $this->data = $data;

        $this->validateInput('username', 2);
        $this->validateInput('email', 6);
        $this->validateInput('password', 6);
        $this->validateInput('password_confirmation', 6, false);

        $this->checkPasswords($data['password'], $data['password_confirmation']);

        $this->sanitizeForm();

        $this->encryptPassword();

        return Auth::register($this->data);
    }


}