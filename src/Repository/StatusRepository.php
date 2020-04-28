<?php

namespace App\Repository;

use App\DB\QueryBuilder;
use App\Entity\Status;
use App\Hydration\StatusHydrator;

class StatusRepository extends AbstractRepository
{
    /**
     * @param int $id
     * @return null|Status
     */
    public function findOne(int $id): ?Status
    {
        $entity = null;
        $sql = QueryBuilder::findOneBy('status');
        $dbCon = $this->connection->open();

        $statement = $dbCon->prepare($sql);
        $statement->execute([
            'id' => $id
        ]);
        $row = $statement->fetch();

        if ($row) {
            $entity = StatusHydrator::hydrate($row);
        }
        return $entity;
    }

    /**
     * @param Status $entity
     * @return Status
     */
    public function saveBKP(Status $entity)
    {
        $data = [
            'name' => $entity->getName(),
            'internal_name' => $entity->getInternalName(),
        ];
        $table = 'status';
        $where = [];
        if (null !== $entity->getId()) {
            $where['id'] = $entity->getId();
        }
        $sql = QueryBuilder::insertOrUpdate($data, $table, $where);

        if (null !== $entity->getId()) {
            $data['id'] = $entity->getId();
        }

        $dbCon = $this->connection->open();

        $statement = $dbCon->prepare($sql);
        $statement->execute(array_values($data));

        if (null === $entity->getId()) {
            $entity->setId((int)$dbCon->lastInsertId());
        }

        return $entity;
    }


    /**
     * @param Status $entity
     * @return Status
     */
    public function save(Status $entity)
    {
        $values = [
            'name' => $entity->getName(),
            'internal_name' => $entity->getInternalName(),

        ];
        if (null !== $entity->getId()) {
            $values['id'] = $entity->getId();
        }

        $data = [
            'name' => 'name',
            'internal_name' => 'internal_name'
        ];
        $table = 'status';
        $where = [];
        if (null !== $entity->getId()) {
            $where['id'] = 'id';
        }
        $sql = QueryBuilder::insertOrUpdate($data, $table, $where);

        if (null !== $entity->getId()) {
            $data['id'] = $entity->getId();
        }

        $dbCon = $this->connection->open();

        $statement = $dbCon->prepare($sql);
        $statement->execute($values);

        if (null === $entity->getId()) {
            $entity->setId((int)$dbCon->lastInsertId());
        }

        return $entity;
    }

}