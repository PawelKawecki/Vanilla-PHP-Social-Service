<?php

class Database
{

    public $pdo;

    /**
     * Database constructor.
     *
     * @param PDO $pdo
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo ;
    }

    /**
     * Insert data into given table
     *
     * @param string $table
     * @param array $data
     *
     * @return bool
     */
    public function insert(string $table, array $data)
    {
        $keys = "null, :" . implode(', :', array_keys($data));

        $query = "INSERT INTO $table VALUES ($keys);";

        $statement = $this->pdo->prepare($query);

        $statement->execute($data);

        return true;
    }
}