<?php
namespace App\DB\Builder;

class Builder
{
    private $collections = [];

    /**
     * @param string $className
     * @return CollectionInterface
     */
    public function make(string $className):CollectionInterface
    {
        $found = null;
        foreach($this->collections as $collection) {
            if($collection instanceof $className) {
                $found =  $collection;
                break;
            }
        }

        if(FALSE === $found instanceof CollectionInterface) {
            $found = new $className();
            $this->collections[] = $found;
        }

        return $found;
    }

    /**
     * @return WhereCollection
     */
    public function where(): WhereCollection
    {

        return $this->make(WhereCollection::class);
    }

    /**
     * @return FieldCollection
     */
    public function fields(): FieldCollection
    {
        return $this->make(FieldCollection::class);
    }
}