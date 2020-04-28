<?php

namespace App\DB\Builder;

class FieldCollection implements CollectionInterface
{
    /**
     * @var array
     */
    private $fields = [];

    /**
     * @param string $name
     * @return FieldCollection
     */
    public function add(string $name): FieldCollection
    {
        $this->fields[] = $name;
        return $this;
    }

    /**
     * @param array $fields
     * @return FieldCollection
     */
    public function set(array $fields = []):CollectionInterface
    {
        $this->fields = [];
        for ($i = 0; $i < count($fields); $i++) {
            $this->add($fields[$i]);
        }
        return $this;
    }

    /**
     * @return string
     */
    public function getSQL(): string
    {
        $sql = '*';
        if(count($this->fields) > 0) {
            $sql = '';
            for ($i = 0; $i < count($this->fields); $i++) {
                if ($i > 0) {
                    $sql .= ", ";
                }
                $sql .= "`" . $this->fields[$i] . "`";
            }
        }
        return $sql;
    }

}
