<?php

namespace App\Repository;

use App\DB\Connection;
use App\DB\QueryBuilder;
use App\Entity\InvoiceItem;
use App\Hydration\InvoiceItemHydrator;

class InvoiceItemRepository extends AbstractRepository
{
    /**
     * @param int $id
     * @return null|InvoiceItem
     */
    public function findOne(int $id): ?InvoiceItem
    {
        $entity = null;
        $sql = QueryBuilder::findOneBy('invoice_item');
        $dbCon = $this->connection->open();

        $statement = $dbCon->prepare($sql);
        $statement->execute([
            'id' => $id
        ]);
        $row = $statement->fetch();

        if ($row) {
            $entity = InvoiceItemHydrator::hydrate($row);
        }
        return $entity;
    }

    /**
     * @param int $id
     * @return array
     */
    public function findAllByInvoiceID(int $id):array
    {
        $results = [];
        $data = [
            'invoice_id' => $id
        ];
        $sql = QueryBuilder::findAllBy('invoice_item', $data);

        $dbCon = $this->connection->open();
        $statement = $dbCon->prepare($sql);
        $statement->execute($data);
        $rows = $statement->fetchAll();

        if (is_array($rows)) {
            foreach ($rows as $row) {
                $results[] = InvoiceItemHydrator::hydrate($row);
            }
        }
        return $results;
    }

    /**
     * @param InvoiceItem $entity
     * @return InvoiceItem
     */
    public function save(InvoiceItem $entity)
    {

        $data = [
            'reference' => $entity->getReference(),
            'total' => $entity->getTotal(),
            'unit_price' => $entity->getUnitPrice(),
            'units' => $entity->getUnits(),
            'description' => $entity->getDescription(),
            'invoice_id' => $entity->getInvoice()->getId()
        ];
        $table = 'invoice_item';
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

}