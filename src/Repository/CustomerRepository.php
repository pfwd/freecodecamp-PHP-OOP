<?php

namespace App\Repository;

use App\DB\Connection;
use App\DB\QueryBuilder;
use App\Entity\Customer;
use App\Hydration\CustomerHydrator;

class CustomerRepository extends AbstractRepository
{

    /**
     * @param Customer $entity
     * @return Customer
     */
    public function save(Customer $entity)
    {
        $data = [
            'first_name' => $entity->getFirstName(),
            'last_name' => $entity->getLastName(),
            'company_name' => $entity->getCompanyName(),
        ];
        $table = 'customer';
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
        $statement->execute($data);

        if (null === $entity->getId()) {
            $entity->setId((int)$dbCon->lastInsertId());
        }

        return $entity;
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function findOne(int $id)
    {
        $entity = null;
        $sql = QueryBuilder::findOneBy('customer');
        $dbCon = $this->connection->open();

        $statement = $dbCon->prepare($sql);
        $statement->execute([
            'id' => $id
        ]);
        $row = $statement->fetch();

        if ($row) {
            $entity = CustomerHydrator::hydrate($row);
        }
        return $entity;
    }

}