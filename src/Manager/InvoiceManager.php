<?php

namespace App\Manager;

use App\Entity\Invoice;
use App\Hydration\InvoiceHydrator;
use App\Repository\InvoiceRepository;

class InvoiceManager extends AbstractManager
{
    /**
     * @var InvoiceRepository
     */
    private $repository;

    /**
     * InvoiceManager constructor.
     * @param InvoiceRepository $repository
     */
    public function __construct(InvoiceRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * @param int $id
     *
     * @return Invoice|null
     */
    public function findOne(int $id): ?Invoice
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
        $rows =  $this->repository->findAll('invoice');
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
        $savedEntity = $this->repository->save($entity);
        return $savedEntity;
    }
}