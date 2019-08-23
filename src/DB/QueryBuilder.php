<?php

namespace App\DB;

class QueryBuilder
{
    /**
     * @param array $data
     * @param string $table
     * @return string
     */
    public static function insert(array $data, string $table): string
    {
        $sql = 'INSERT INTO `'.$table.'`';

        $values = 'VALUE (';
        for ($i = 0; $i < count($data); $i++) {
            if ($i > 0) {
                $values .= ",";
            }
            $values .= "?";
        }
        $values .= ')';

        $fields = implode('`, `', array_keys($data));

        $sql .= " (`" . $fields . "`)" . " " . $values . ";";

        return $sql;
    }

    /**
     * @param array $data
     * @param string $table
     * @param array $where
     * @return string
     */
    public static function update(array $data, string $table, array $where): string
    {
        $whereSQL = '';

        foreach($where as $key => $value) {
            $whereSQL.='`'.$key.'` =?';
        }

        $sql = 'UPDATE `'.$table.'` SET ';

        $fields = implode('` =?, `', array_keys($data));

        $sql.= "`".$fields."` =?" . " WHERE " . $whereSQL .";";

        return $sql;
    }

    /**
     * @param array $data
     * @param string $table
     * @param array $where
     * @return string
     */
    public static function insertOrUpdate(array $data, string $table, array $where = []): string
    {
        if(empty($where)) {
            $sql = self::insert($data, $table);
        } else {
            $sql = self::update($data, $table, $where);
        }

        return $sql;
    }

    /**
     * @param string $table
     * @return string
     */
    public static function findOneBy(string $table)
    {
        return "SELECT * FROM `".$table."` WHERE id=:id";
    }

    /**
     * @param string $table
     * @return string
     */
    public static function findAll(string $table)
    {
        return "SELECT * FROM `".$table."`";
    }

    /**
     * @param array $conditions
     * @return string
     */
    public static function where(array $conditions = []) {
        $sql ='';

        $total = count($conditions);
        $num = 0;
        foreach($conditions as $field => $value) {
            $num ++;
            $sql.='`'.$field.'` =:'.$value;
            if($num < $total) {
                $sql.=' AND ';
            }

        }

        return $sql;
    }

    /**
     * @param string $table
     * @param array $where
     * @return string
     */
    public static function findAllBy(string $table, array $where = [])
    {
        $sql = "SELECT * FROM `".$table."` WHERE " .self::where($where);

        return $sql;
    }
}