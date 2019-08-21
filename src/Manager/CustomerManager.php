<?php

namespace App\Manager;

use App\Entity\Type\Customer;
use App\Repository\Type\CustomerRepository;

class CustomerManager extends AbstractManager
{
    /**
     * @var CustomerRepository
     */
    private $repository;

    /**
     * CustomerManager constructor.
     * @param CustomerRepository $repository
     */
    public function __construct(CustomerRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param int $id
     *
     * @return null|Customer
     */
    public function findOne(int $id): ?Customer
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
     * @param Customer $entity
     * @return Customer
     */
    public function save(Customer $entity)
    {
        $savedEntity = $this->repository->save($entity);

        return $savedEntity;
    }

}