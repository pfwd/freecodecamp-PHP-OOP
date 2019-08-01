<?php
namespace App\Manager;

use App\DB\Connection;
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
            'reference' => $entity->getReference(),
            'total' => $entity->getTotal(),
            'vat' => $entity->getVat()
        ];

        if ($entity->getStatus() instanceof Status){
            $data['status_id'] = $entity->getStatus()->getId();
        }

        if(null !== $entity->getId()){
            $data['id'] = $entity->getId();
        }

        $sql = 'INSERT INTO `invoice`';
        $values = '';

        $fields = implode(') , (', array_keys($data));



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