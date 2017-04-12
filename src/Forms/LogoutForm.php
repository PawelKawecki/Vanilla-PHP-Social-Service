<?php

namespace App\Forms;

use App\Models\Auth;
use App\Models\Message;

class LogoutForm extends Form
{

    /**
     * Form constructor.
     */
    public function __construct()
    {
        $this->message = new Message($this);
    }

    /**
     * Process Logout form.
     *
     * @param array $data
     *
     * @return bool
     */
    public function process(array $data)
    {
        $this->data = $data;

        $this->addToWhitelist('allDevices');

        $this->sanitizeForm();

        return Auth::logout($this->data);
    }


}