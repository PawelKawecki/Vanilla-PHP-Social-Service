<?php

namespace App\Repositories;

class UserTokenRepository implements Repository
{
    protected $table = 'user_tokens';

    use RepositoryTrait;
}