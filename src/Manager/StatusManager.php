<?php

namespace App\Manager;

use App\Entity\Type\Status;
use App\Repository\Type\StatusRepository;

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
        return $this->repository->findAll();
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

    /**
     * @param Status $entity
     * @return Status
     */
    public function update(Status $entity)
    {
        $savedEntity = $this->repository->update($entity);

        return $savedEntity;
    }
}