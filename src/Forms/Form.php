<?php

namespace App\Forms;

abstract class Form
{

    abstract public function process($data);

    abstract protected function validateInput($input, $length = 1);

}