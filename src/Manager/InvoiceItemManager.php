<?php

namespace App\Manager;

use App\Entity\Type\InvoiceItem;
use App\Repository\Type\InvoiceItemRepository;

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
        return $this->repository->findAll();
    }

    /**
     * @param int $id
     * @return array
     */
    public function findAllByInvoiceID(int $id):array
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