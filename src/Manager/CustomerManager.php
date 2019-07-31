<?php
namespace App\Manager;

use App\DB\Connection;
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
        if(null === $entity->getId()){
            $sql = "INSERT INTO `customer` (`first_name`, `last_name`, `company_name`) VALUE (?,?,?);";
            $data = [
                $entity->getFirstName(),
                $entity->getLastName(),
                $entity->getCompanyName()
            ];
        } else {
            $sql = "UPDATE `customer` SET `first_name` =?, `last_name` = ?, `company_name` = ? WHERE `id` = ?;";
            $data = [
                $entity->getFirstName(),
                $entity->getLastName(),
                $entity->getCompanyName(),
                $entity->getId()
            ];
        }
        $dbCon = $this->connection->open();

        $statement = $dbCon->prepare($sql);
        $statement->execute($data);

        if(null === $entity->getId()){
            $entity->setId($dbCon->lastInsertId());
        }

        return $entity;
    }

}