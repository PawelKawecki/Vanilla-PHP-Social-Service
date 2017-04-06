<?php


namespace App\Forms;


use App\Exceptions\UserNotFoundException;
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

        $this->encryptPassword();

        $userCollection = $this->repository->getByAttribute('username', $this->data['username']);

        if (empty($userCollection)) {
            throw new UserNotFoundException('User not found');
        }

        $user = $userCollection[0];

        dump($user);

        if (!$this->verifyPassword($this->data['password'], $user->password)) {
            throw new \Exception('Password does not match');
        }


    }

    private function verifyPassword($password, $password1)
    {
        dump($password, $password1, password_verify($password, $password1));
        return password_verify($password, $password1);
    }


}