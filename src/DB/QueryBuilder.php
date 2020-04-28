<?php

namespace App\DB;

class QueryBuilder extends QueryCreate implements QueryBuilderInterface
{

    /**
     * @param array $data
     * @param string $table
     * @return string
     */
    public static function insert(array $data, string $table): string
    {
        $sql = 'INSERT INTO `'.$table.'` (' . self::fields($data) . ') VALUE (' . self::insertedPlaceHolders($data).');';
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
        $sql = 'UPDATE `'.$table.'` SET ' . self::updatePlaceholders($data) . "WHERE " . self::where($where).";";

        return $sql;
    }


    /**
     * @param array $data
     * @return string
     */
    public static function insertedPlaceHolders(array $data = []):string
    {
        $placeholders = array_keys($data);
        $sql = '';
        for ($i = 0; $i < count($placeholders); $i++) {
            if ($i > 0) {
                $sql .= ", ";
            }
            $sql .= ':'.$placeholders[$i];
        }

        return $sql;
    }

    /**
     * @param array $data
     * @return string
     */
    public static function fields(array $data = []):string
    {
        $placeholders = array_keys($data);
        $sql = '';
        for ($i = 0; $i < count($placeholders); $i++) {
            if ($i > 0) {
                $sql .= ", ";
            }
            $sql .= "`".$placeholders[$i]."`";
        }

        return $sql;
    }


    /**
     * @param array $data
     * @return string
     */
    public static function updatePlaceholders(array $data = []):string
    {
        $sql = '';
        $counter = 0;
        $total = count($data);
        foreach($data as $field => $value) {
            $counter ++;
            $sql.='`'.$field.'` =:'.$field;
            if($counter < $total) {
                $sql.= ', ';
            } else{
                $sql.= ' ';
            }
        }
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
            $sql.='`'.$field.'` =:'.$field;
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