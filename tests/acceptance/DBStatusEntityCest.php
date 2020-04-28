<?php

use App\DB\Builder\Builder;
use App\DB\Connection;
use App\DB\QueryBuilder;
use App\Entity\Status;
use App\Manager\StatusManager;
use App\Repository\StatusRepository;

class DBStatusEntityCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    /**
     * @param AcceptanceTester $I
     * @group db
     * @group db-status-entity-insert
     */
    public function insertTest(AcceptanceTester $I)
    {
        $entity = new Status();
        $entity->setName('Hello World2')
            ->setInternalName('HELLO_WORLD_2');

        $manager = $this->getManager();
        $manager->save($entity);

        $I->seeInDatabase('status', [
            'name' => $entity->getName(),
            'internal_name' => $entity->getInternalName()
        ]);
    }

    /**
     * @return StatusManager
     */
    public function getManager(): StatusManager
    {
        $connection = new Connection();
        $builder = new Builder();
        $queryBuilder = new QueryBuilder($builder);
        $repository = new StatusRepository($connection, $queryBuilder);
        return new StatusManager($repository);
    }

    /**
     * @param AcceptanceTester $I
     * @group db
     * @group db-status-entity-update
     */
    public function updateTest(AcceptanceTester $I)
    {
        $entity = new Status();
        $entity->setName('Test Status')
            ->setInternalName('TEST_STATUS');
        $manager = $this->getManager();
        $savedEntity = $manager->save($entity);

        $I->seeInDatabase('status', [
            'name' => $entity->getName(),
            'internal_name' => $entity->getInternalName(),
            'id' => $savedEntity->getId()
        ]);

        $savedEntity->setName('Test Status 2');
        $savedEntity->setInternalName('TEST');
        $manager->save($savedEntity);

        $I->seeInDatabase('status', [
            'name' => $savedEntity->getName(),
            'id' => $savedEntity->getId()
        ]);
    }

}
