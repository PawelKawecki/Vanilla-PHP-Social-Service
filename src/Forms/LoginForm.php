<?php


namespace App\Forms;


use App\Exceptions\UserNotFoundException;
use App\Models\Auth;
use App\Repositories\Repository;

class LoginForm extends Form
{

    private $repository;

    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }

    public function process($data)
    {
        $this->data = $data;

        $this->validateInput('username', 2);
        $this->validateInput('password', 6);

        $this->sanitizeForm();

        Auth::login($this->data);


    }

}