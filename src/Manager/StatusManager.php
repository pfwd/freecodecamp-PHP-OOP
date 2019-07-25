<?php
namespace App\Manager;

use App\DB\Connection;
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
     * @var Connection
     */
    private $connection;

    /**
     * StatusManager constructor.
     * @param Connection $connection
     */
    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

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

    public function save(Status $entity)
    {
        if(null === $entity->getId()){
            $sql = "INSERT INTO `status` (`name`, `internal_name`) VALUE (?,?);";
            $data = [
                $entity->getName(),
                $entity->getInternalName()
            ];
        } else {
            $sql = "UPDATE `status` SET `name` =?, `internal_name` = ? WHERE `id` = ?;";
            $data = [
                $entity->getName(),
                $entity->getInternalName(),
                $entity->getId()
            ];
        }
        $dbCon = $this->connection->open();

        $statement = $dbCon->prepare($sql);
        $statement->execute($data);


    }

}