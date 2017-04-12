<?php

namespace App\Forms;

use App\Models\User;

class PasswordChangeForm extends Form
{

    /**
     * Process Form.
     *
     * @param array $data
     */
    public function process(array $data)
    {
        $this->data = $data;

        $this->validateInput('old_password', 6);
        $this->validateInput('password', 6);
        $this->validateInput('password_confirmation', 6, false);

        $this->checkPasswords($data['password'], $data['password_confirmation']);

        $this->sanitizeForm();

        $this->encryptPassword();

        User::update($this->data);
    }
}