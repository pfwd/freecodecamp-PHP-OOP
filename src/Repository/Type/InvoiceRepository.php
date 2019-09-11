<?php

namespace App\Repository\Type;

use App\DB\Connection;
use App\DB\QueryBuilder;
use App\Entity\Type\Invoice;
use App\Entity\Type\Status;
use App\Hydration\InvoiceHydrator;
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
     * @return Invoice|null
     */
    public function findOne(int $id): ?Invoice
    {
        $entity = null;
        $sql = QueryBuilder::findOneBy('invoice');
        $dbCon = $this->connection->open();

        $statement = $dbCon->prepare($sql);
        $statement->execute([
            'id' => $id
        ]);
        $row = $statement->fetch();

        if ($row) {
            $entity = InvoiceHydrator::hydrate($row);
        }
        return $entity;
    }

    /**
     * @inheritDoc
     */
    public function findAll(): array
    {
        $results = [];
        $sql = QueryBuilder::findAll('invoice');

        $dbCon = $this->connection->open();
        $statement = $dbCon->prepare($sql);
        $statement->execute();
        $rows = $statement->fetchAll();

        if (is_array($rows)) {
            foreach ($rows as $row) {
                $results[] = InvoiceHydrator::hydrate($row);
            }
        }

        return $results;

    }

    /**
     * @param Invoice $entity
     * @return Invoice
     */
    public function save(Invoice $entity): Invoice
    {
        $data = [
            'reference' => $entity->getReference(),
            'total' => $entity->getTotal(),
            'vat' => $entity->getVat()
        ];
        if ($entity->getStatus() instanceof Status) {
            $data['status_id'] = $entity->getStatus()->getId();
        }
        $where = [];
        if (null !== $entity->getId()) {
            $where['id'] = $entity->getId();
        }

        $table = 'invoice';

        $sql = QueryBuilder::insertOrUpdate($data, $table, $where);

        if (null !== $entity->getId()) {
            $data['id'] = $entity->getId();
        }
        $dbCon = $this->connection->open();

        $statement = $dbCon->prepare($sql);
        $statement->execute($data);

        if (null === $entity->getId()) {
            $entity->setId($dbCon->lastInsertId());
        }

        return $entity;
    }

}