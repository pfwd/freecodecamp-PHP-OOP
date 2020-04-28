<?php

namespace App\DB\Builder;

class WhereCollection implements CollectionInterface
{
    /**
     * @var array
     */
    private $whereClause = [];

    /**
     * @param string $field
     * @param $value
     * @return WhereCollection
     */
    public function add(string $field, $value): WhereCollection
    {
        $this->whereClause[$field] = $value;
        return $this;
    }

    /**
     * @param array $where
     * @return WhereCollection
     */
    public function set(array $where = []): CollectionInterface
    {
        $this->whereClause = $where;

        return $this;
    }

    /**
     * @return string
     */
    public function getSQL(): string
    {
        $sql = '';
        $counter = 0;
        $count = count($this->whereClause);

        if($count > 0) {
            $sql.='WHERE ';
        }
        foreach ($this->whereClause as $field => $value) {
            $counter++;
            $sql .= '`' . $field . '` =:' . $field;

            if ($counter < $count) {
                $sql .= ' AND ';
            }

        }
        return $sql;
    }

}
