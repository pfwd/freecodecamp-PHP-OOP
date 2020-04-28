<?php

namespace App\Manager;

use App\Entity\Status;
use App\Hydration\StatusHydrator;
use App\Repository\StatusRepository;

class StatusManager extends AbstractManager
{
    /**
     * @var StatusRepository
     */
    private $repository;

    /**
     * StatusManager constructor.
     * @param StatusRepository $repository
     */
    public function __construct(StatusRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param int $id
     *
     * @return null|Status
     */
    public function findOne(int $id): ?Status
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
        $rows = $this->repository->findAll('status');

        if (is_array($rows)) {
            foreach ($rows as $row) {
                $results[] = StatusHydrator::hydrate($row);
            }
        }

        return $results;
    }

    /**
     * @param Status $entity
     * @return Status
     */
    public function save(Status $entity)
    {
        $savedEntity = $this->repository->save($entity);

        return $savedEntity;
    }
}