<?php

namespace App\Forms;

use App\Models\Auth;

class LogoutForm extends Form
{

    /**
     * Process Logout form.
     *
     * @param array $data
     */
    public function process(array $data)
    {
        $this->data = $data;

        $this->addToWhitelist('allDevices');

        $this->sanitizeForm();

        Auth::logout($this->data);
    }


}