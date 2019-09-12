<?php

use App\DB\Connection;
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
        $connection = new Connection();
        $repository = new StatusRepository($connection);
        $manager = new StatusManager($repository);
        $manager->save($entity);

        $I->seeInDatabase('status', [
            'name' => $entity->getName(),
            'internal_name' => $entity->getInternalName()
        ]);
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
        $connection = new Connection();
        $repository = new StatusRepository($connection);
        $manager = new StatusManager($repository);
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
