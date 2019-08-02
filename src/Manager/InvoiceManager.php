<?php
namespace App\Manager;

use App\DB\Connection;
use App\DB\QueryBuilder;
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
        $where = [];
        if(null !== $entity->getId()) {
            $where['id'] = $entity->getId();
        }

        $table = 'invoice';

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