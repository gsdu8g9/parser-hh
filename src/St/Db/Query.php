<?php

namespace St\Db;

/**
 * @package St\Query
 */
class Query
{
    /**
     * @var \PDO
     */
    private $connect;

    /**
     * @param $dsn
     * @param $user
     * @param $password
     * @param array $options
     */
    public function __construct($dsn, $user, $password, $options = [])
    {
        $this->connect = new \PDO($dsn, $user, $password, $options);
    }

    /**
     * @param $statement
     *
     * @return \PDOStatement
     */
    public function query($statement)
    {
        return $this->connect->query($statement);
    }
}