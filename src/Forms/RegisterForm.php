<?php

namespace App\Forms;

use App\Models\Auth;

class RegisterForm extends Form
{

    /**
     * Process Register form.
     *
     * @param array $data
     */
    public function process(array $data)
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