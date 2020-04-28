<?php

namespace App\DB;

use App\DB\Builder\Builder;

class QueryCreate implements QueryBuilderInterface
{
    private $builder;

    public function __construct(Builder $builder)
    {
        $this->builder = $builder;
    }

    private $sql = '';

    /**
     * @param string $tableName
     * @param array $fields
     * @return QueryBuilderInterface
     */
    public function select(string $tableName, array $fields = []): QueryBuilderInterface
    {
        $fieldCollection = $this->builder->fields()->set($fields);

        $this->sql.= "SELECT " . $fieldCollection->getSQL() . " FROM `" . $tableName . "` ";

        return $this;
    }



    /**
     * @param string $field
     * @param $value
     * @return QueryBuilderInterface
     */
    public function andWhere(string $field, $value): QueryBuilderInterface
    {
        $this->builder->where()->add($field, $value);

        $this->sql.=$this->builder->where()->getSQL();

        return $this;
    }

    /**
     * @return string
     */
    public function getSQL(): string
    {
        return trim($this->sql);
    }


}