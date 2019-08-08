<?php

use App\DB\Connection;
use App\Entity\Type\Status;
use App\Manager\StatusManager;
use App\Repository\Type\StatusRepository;
use Codeception\Test\Unit;

class DBStatusEntityTest extends Unit
{
    /**
     * @var Code
     */
    protected $tester;

    /**
     * @group db-status
     * @group db-status-entity-find-one-by-id
     */
    public function testSaveStatusAndFindByID()
    {
        $entity = new Status();
        $entity->setName('Hello World2')
            ->setInternalName('HELLO_WORLD_2');

        $manager = $this->getManager();
        $savedEntity = $manager->save($entity);

        $foundEntity = $manager->findOne($savedEntity->getId());

        $this->assertSame($foundEntity->getName(), $savedEntity->getName());
        $this->assertSame($foundEntity->getInternalName(), $savedEntity->getInternalName());
    }

    /**
     * @return StatusManager
     */
    protected function getManager(): StatusManager
    {
        $connection = new Connection();
        $repository = new StatusRepository($connection);
        return new StatusManager($repository);
    }

    /**
     * @group db-status
     * @group db-status-entity-find-one-by-id-not-exists
     */
    public function testFindStatusThatDoesNotExist()
    {
        $entity = new Status();
        $entity->setId(5001);
        $manager = $this->getManager();

        $foundEntity = $manager->findOne($entity->getId());
        $this->assertNull($foundEntity);

    }

    /**
     * @group db-status
     * @group db-status-entity-find-all-statuses
     */
    public function testFindAllStatuses()
    {
        $entity1 = new Status();
        $entity1->setName('Test 1');
        $entity1->setInternalName('TEST_1');

        $entity2 = new Status();
        $entity2->setName('Test 2');
        $entity2->setInternalName('TEST_2');

        $manager = $this->getManager();

        $manager->save($entity1);
        $manager->save($entity2);

        $results = $manager->findAll();
        $this->assertIsArray($results);
        $this->assertGreaterThan(1, count($results));

    }

    protected function _before()
    {
    }

    protected function _after()
    {
    }
}