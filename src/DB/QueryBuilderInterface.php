<?php
namespace App\DB;

interface QueryBuilderInterface
{
    public function select(string $tableName, array $fields = []): QueryBuilderInterface;
    public function andWhere(string $fieldName, $value): QueryBuilderInterface;
    public function getSQL():string;

}