<?php

namespace App\Manager;

use App\Entity\InvoiceItem;
use App\Hydration\InvoiceItemHydrator;
use App\Repository\InvoiceItemRepository;

class InvoiceItemManager extends AbstractManager
{
    /**
     * @var InvoiceItemRepository
     */
    private $repository;

    /**
     * InvoiceItemManager constructor.
     * @param InvoiceItemRepository $repository
     */
    public function __construct(InvoiceItemRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param int $id
     *
     * @return null|InvoiceItem
     */
    public function findOne(int $id): ?InvoiceItem
    {
        $entity = $this->repository->findOne($id);
        return $entity;
    }

    /**
     * @inheritDoc
     */
    public function findAll(): array
    {
        $results = [];
        $rows = $this->repository->findAll('invoice_item');

        if (is_array($rows)) {
            foreach ($rows as $row) {
                $results[] = InvoiceItemHydrator::hydrate($row);
            }
        }

        return $results;
    }

    /**
     * @param int $id
     * @return array
     */
    public function findAllByInvoiceID(int $id): array
    {
        return $this->repository->findAllByInvoiceID($id);
    }

    /**
     * @param InvoiceItem $entity
     * @return InvoiceItem
     */
    public function save(InvoiceItem $entity)
    {
        $savedEntity = $this->repository->save($entity);

        return $savedEntity;
    }

}