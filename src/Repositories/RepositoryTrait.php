<?php

namespace App\Repositories;

trait RepositoryTrait
{

    protected $table;

    protected $queryBuilder;

    /**
     * UserRepository constructor.
     *
     * @param \Database|null $queryBuilder
     */
    public function __construct(\Database $queryBuilder = null)
    {
        $this->queryBuilder = $queryBuilder ?? \App::get('db');
    }

    /**
     * Gets all users from repository
     *
     * @return mixed
     */
    public function getAll()
    {
        return $this->queryBuilder->select($this->table);
    }

    /**
     * Get user by given id
     *
     * @param int $id
     *
     * @return mixed
     */
    public function getById(int $id)
    {
        return $this->queryBuilder->select($this->table, [], "id = $id");
    }

    /**
     * Get user by given attribute
     *
     * @param string $attribute
     * @param string $value
     *
     * @return mixed
     */
    public function getByAttribute(string $attribute, string $value)
    {
        return $this->queryBuilder->select($this->table, [], "$attribute = '$value'");
    }

    /**
     * Save user to repository
     *
     * @param array $data
     *
     * @return bool
     */
    public function save(array $data)
    {
        return $this->queryBuilder->insert($this->table, $data);
    }


}