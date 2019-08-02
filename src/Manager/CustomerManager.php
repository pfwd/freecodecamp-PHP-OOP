<?php
namespace App\Manager;

use App\DB\Connection;
use App\DB\QueryBuilder;
use App\Entity\Type\Customer;
use App\Hydration\CustomerHydrator;
use App\Repository\Type\Status as Repository;

class CustomerManager extends AbstractManager
{
    /**
     * @var Repository
     */
    private $repository;

    /**
     * @var Connection
     */
    private $connection;

    /**
     * CustomerManager constructor.
     * @param Connection $connection
     */
    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @param int $id
     *
     * @return Customer
     */
    public function findOne(int $id): Customer
    {
        $row = $this->repository->findOne($id);
        return CustomerHydrator::hydrate($row);
    }

    /**
     * @param Customer $entity
     * @return Customer
     */
    public function save(Customer $entity):Customer
    {
        $data = [
            'first_name' => $entity->getFirstName(),
            'last_name' => $entity->getLastName(),
            'company_name' => $entity->getCompanyName(),
        ];

        $where = [];
        if(null !== $entity->getId()) {
            $where['id'] = $entity->getId();
        }

        $table = 'customer';

        $sql = QueryBuilder::insertOrUpdate($data, $table, $where);

        if (null !== $entity->getId()) {
            $data['id'] = $entity->getId();
        }
        $dbCon = $this->connection->open();

        $statement = $dbCon->prepare($sql);
        $statement->execute(array_values($data));

        if(null === $entity->getId()){
            $entity->setId($dbCon->lastInsertId());
        }

        return $entity;
    }

}