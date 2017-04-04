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

    public function insert(string $table, array $data)
    {
        $values = implode(', ', $data);

        $query = "INSERT INTO $table VALUES (username, password, email)";
        dump($query);

        $statement = $this->pdo->prepare($query);
        dump($statement);

        $statement->execute();

        $result = $statement->fetchAll();
        dump($result);

        return $result;
    }
}