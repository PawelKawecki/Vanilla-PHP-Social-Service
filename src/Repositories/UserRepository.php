<?php

namespace App\Repositories;

class UserRepository implements Repository
{
    protected $table = 'users';

    use RepositoryTrait;
}