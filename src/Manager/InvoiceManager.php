<?php
namespace App\Manager;

use App\DB\QueryBuilder;
use App\Entity\Type\Invoice;
use App\Entity\Type\Status;
use App\Hydration\StatusHydrator;
use App\Repository\Type\InvoiceRepository;

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
    public function findOne(int $id):? Invoice
    {
        $entity = $this->repository->findOne($id);
        return $entity;
    }

    /**
     * @param Invoice $entity
     * @return Invoice
     */
    public function save(Invoice $entity):Invoice
    {
        $savedEntity = $this->repository->save($entity);
        return $savedEntity;
    }
}