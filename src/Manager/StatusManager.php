<?php
namespace App\Manager;

use App\Entity\Type\Status;
use App\Hydration\StatusHydrator;
use App\Repository\Type\Status as Repository;

class StatusManager extends AbstractManager
{
    /**
     * @var Repository
     */
    private $repository;

    /**
     * @param int $id
     *
     * @return Status
     */
    public function findOne(int $id): Status
    {
        $row = $this->repository->findOne($id);
        return StatusHydrator::hydrate($row);
    }

}