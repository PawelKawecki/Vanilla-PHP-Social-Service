<?php

namespace App\Repositories;

interface Repository
{
    public function getAll();

    public function getById(int $id);

    public function save(array $data);

    public function getByAttribute(string $attribute, string $value);
}