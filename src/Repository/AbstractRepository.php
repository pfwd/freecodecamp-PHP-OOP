<?php

namespace App\Repository;

use App\DB\Connection;
use App\DB\QueryBuilder;

abstract class AbstractRepository
{
    /**
     * @var Connection
     */
    protected $connection;

    /**
     * @var QueryBuilder
     */
    protected $queryBuilder;

    /**
     * @param Connection $connection
     * @param QueryBuilder $queryBuilder
     */
    public function __construct(Connection $connection, QueryBuilder $queryBuilder)
    {
        $this->connection = $connection;
        $this->queryBuilder = $queryBuilder;
    }

    /**
     * Find one entity by ID
     *
     * @param int $id
     * @return mixed
     */
    abstract public function findOne(int $id);


    /**
     * @param string $tableName
     * @return array
     */
    public function findAll(string $tableName): array
    {
        $this->queryBuilder->select($tableName);
        $sql = $this->queryBuilder->getSQL();

        $dbCon = $this->connection->open();
        $statement = $dbCon->prepare($sql);
        $statement->execute();

        return $statement->fetchAll();
    }
}