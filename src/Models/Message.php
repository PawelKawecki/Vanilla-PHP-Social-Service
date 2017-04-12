<?php

namespace App\Models;

use App\Forms\Form;
use App\Forms\LoginForm;
use App\Forms\LogoutForm;
use App\Forms\PasswordChangeForm;
use App\Forms\RegisterForm;

class Message
{

    protected $class;

    /**
     * Message constructor.
     *
     * @param Form $class
     */
    public function __construct(Form $class)
    {
        $this->class = $class;
    }

    /**
     * @throws \Exception
     *
     * @return string
     */
    function __toString()
    {
        $messages = [
            LogoutForm::class         => 'User has been successfully logged out.',
            LoginForm::class          => 'User has been successfully logged in.',
            RegisterForm::class       => 'User has been successfully registered',
            PasswordChangeForm::class => 'Users password has been changed successfully',
        ];

        $messageClass = get_class($this->class);

        if (!array_key_exists($messageClass, $messages)) {
//            throw new \Exception("Message for $messageClass class is not set");
            die("Message for $messageClass class is not set");
        }

        return $messages[$messageClass];

    }

}