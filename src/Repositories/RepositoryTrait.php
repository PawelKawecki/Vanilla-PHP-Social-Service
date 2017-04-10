<?php

namespace App\Repositories;

trait RepositoryTrait
{

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
     * Gets all resources from database
     *
     * @return mixed
     */
    public function getAll()
    {
        return $this->queryBuilder->select($this->table);
    }

    /**
     * Get resource by given id
     *
     * @param int $id
     * @param array $columns
     *
     * @return mixed
     */
    public function getById(int $id, array $columns = [])
    {
        return $this->queryBuilder->select($this->table, $columns, "id = $id");
    }

    /**
     * Get resource by given attribute
     *
     * @param string $attribute
     * @param string $value
     * @param array $columns
     *
     * @return mixed
     */
    public function getByAttribute(string $attribute, string $value, array $columns = [])
    {
        return $this->queryBuilder->select($this->table, $columns, "$attribute = '$value'");
    }

    /**
     * Save resource to database
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