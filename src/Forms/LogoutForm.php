<?php

namespace App\Forms;

use App\Models\Auth;

class LogoutForm extends Form
{

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

        Auth::logout($this->data);

        redirect('index');
    }


}