<?php

namespace App\Manager;

use App\DB\Connection;
use App\DB\QueryBuilder;
use App\Entity\Type\Status;
use App\Hydration\StatusHydrator;
use App\Repository\Type\Status as Repository;
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
    public function findOne(int $id):? Status
    {
        $entity = $this->repository->findOne($id);
        return $entity;
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