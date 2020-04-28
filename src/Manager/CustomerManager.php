<?php

namespace App\Manager;

use App\Entity\Customer;
use App\Hydration\CustomerHydrator;
use App\Repository\CustomerRepository;

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
        $results = [];
        $rows =  $this->repository->findAll('customer');

        if (is_array($rows)) {
            foreach ($rows as $row) {
                $results[] = CustomerHydrator::hydrate($row);
            }
        }

        return $results;
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