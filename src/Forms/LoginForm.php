<?php


namespace App\Forms;

use App\Models\Auth;

class LoginForm extends Form
{

    /**
     * Process Login form.
     *
     * @param array $data
     *
     * @return bool
     */
    public function process(array $data)
    {
        $this->data = $data;

        $this->validateInput('username', 2);
        $this->validateInput('password', 6);

        $this->sanitizeForm();

        Auth::login($this->data);

        redirect('index');
    }

}