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
        $keys = implode(', ', array_keys($data));
        $binds = ':' . implode(', :', array_keys($data));

        $query = "INSERT INTO $table ($keys) VALUES ($binds);";

        $statement = $this->pdo->prepare($query);

        return $statement->execute($data);
    }

    /**
     * Select data from given table
     *
     * @param string $table
     * @param array $columns
     * @param string $where
     *
     * @return mixed
     */
    public function select(string $table, array $columns = [], string $where = '1 = 1')
    {
        $columnsNames = empty($columns) ? '*' : implode(', ', $columns);

        $query = "SELECT $columnsNames FROM $table WHERE $where";

        $statement = $this->pdo->prepare($query);

        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    /**
     * Joins two tables.
     *
     * @param string $table
     * @param string $table2
     * @param array $columns
     * @param string $on
     * @param string $where
     *
     * @return mixed
     */
    public function join(string $table, string $table2, string $on, array $columns = [], string $where = '1 = 1')
    {
        $columnsNames = empty($columns) ? '*' : implode(', ', $columns);

        $query = "SELECT $columnsNames FROM $table INNER JOIN $table2 ON $on WHERE $where";

        $statement = $this->pdo->prepare($query);

        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_CLASS);
    }


    /**
     * Deletes record from table.
     *
     * @param string $table
     * @param string $where
     *
     * @return bool
     */
    public function delete(string $table, string $where)
    {
        $query = "DELETE FROM $table WHERE $where;";

        $statement = $this->pdo->prepare($query);

        return $statement->execute();
    }

    /**
     * Updates record in table.
     *
     * @param string $table
     * @param array $data
     * @param string $where
     *
     * @return bool
     */
    public function update(string $table, array $data, string $where)
    {
        array_walk($data, function (&$v, $k) {
            $v = "$k = '$v'";
        });

        $values = implode(',', $data);

        $query = "UPDATE $table SET $values WHERE $where;";

        $statement = $this->pdo->prepare($query);

        return $statement->execute();
    }
}