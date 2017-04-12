<?php


namespace App\Forms;

use App\Models\Auth;
use App\Models\Message;

class LoginForm extends Form
{

    /**
     * Form constructor.
     */
    public function __construct()
    {
        $this->message = new Message($this);
    }

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

        return Auth::login($this->data);
    }

}