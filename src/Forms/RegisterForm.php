<?php

namespace App\Forms;

use App\Exceptions\UserAlreadyExistsException;
use App\Repositories\Repository;

class RegisterForm extends Form
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
        $this->validateInput('email', 6);
        $this->validateInput('password', 6);

        $this->sanitizeForm();

        $this->encryptPassword();

        $user = $this->repository->getByAttribute('username', $this->data['username']);

        if (!empty($user)) {
            throw new UserAlreadyExistsException('User Already Exists');
        }

        return $this->repository->save($this->data);
    }


}