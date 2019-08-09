<?php

namespace App\Repository\Type;

use App\DB\Connection;
use App\DB\QueryBuilder;
use App\Entity\Type\Invoice;
use App\Entity\Type\Status;
use App\Repository\AbstractRepository;

class InvoiceRepository extends AbstractRepository
{
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function findOne(int $id)
    {

    }

    /**
     * @param array $options
     * @return mixed
     */
    public function findOneBy(array $options)
    {
        // TODO: Implement findOneBy() method.
    }

    /**
     * @param array $options
     * @return mixed
     */
    public function findAllBy(array $options)
    {
        // TODO: Implement findAllBy() method.
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