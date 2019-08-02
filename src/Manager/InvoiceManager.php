<?php
namespace App\Manager;

use App\DB\Connection;
use App\DB\QueryBuilder;
use App\Entity\Type\Customer;
use App\Entity\Type\Invoice;
use App\Entity\Type\Status;
use App\Hydration\StatusHydrator;
use App\Repository\Type\Status as Repository;

class InvoiceManager extends AbstractManager
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
     * @return Status
     */
    public function findOne(int $id): Status
    {
        $row = $this->repository->findOne($id);
        return StatusHydrator::hydrate($row);
    }

    /**
     * @param Invoice $entity
     * @return Invoice
     */
    public function save(Invoice $entity):Invoice
    {

        $data = [
            $entity->getReference(),
            $entity->getTotal(),
            $entity->getVat(),
        ];

        $sql = QueryBuilder::insertOrUpdate($data, 'invoice');

        




        if(null === $entity->getId()){


            $sql = "INSERT INTO `invoice` (`reference`, `total`, `vat`) VALUE (?,?,?);";
            $data = [
                $entity->getReference(),
                $entity->getTotal(),
                $entity->getVat(),
            ];

            if ($entity->getStatus() instanceof Status){
                $data[] = $entity->getStatus()->getId();
            }
        } else {
            $sql = "UPDATE `invoice` SET `reference` =?, `total` = ?, `vat` = ? WHERE `id` = ?;";
            $data = [
                $entity->getReference(),
                $entity->getTotal(),
                $entity->getVat(),
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