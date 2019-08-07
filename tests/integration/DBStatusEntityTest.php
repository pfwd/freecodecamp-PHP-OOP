<?php

use App\DB\Connection;
use App\Entity\Type\Status;
use App\Manager\StatusManager;
use App\Repository\Type\StatusRepository;

class DBStatusEntityTest extends \Codeception\Test\Unit
{
    /**
     * @var \Code
     */
    protected $tester;
    
    protected function _before()
    {
    }

    protected function _after()
    {
    }

    /**
     * @group db-status
     * @group db-status-entity-find-one-by-id
     */
    public function testFindOneByID()
    {
        $entity = new Status();
        $entity->setName('Hello World2')
            ->setInternalName('HELLO_WORLD_2');
        $connection = new Connection();
        $repository = new StatusRepository($connection);
        $manager = new StatusManager($repository);
        $savedEntity = $manager->save($entity);

        $foundEntity = $manager->findOne($savedEntity->getId());

        $this->assertSame($foundEntity->getName(), $savedEntity->getName());
        $this->assertSame($foundEntity->getInternalName(), $savedEntity->getInternalName());
    }

    /**
     * @group db-status
     * @group db-status-entity-find-one-by-id-not-exists
     */
    public function testFindOneByIDThatDoesNotExist()
    {
        $entity = new Status();
        $entity->setId(5001);
        $connection = new Connection();
        $repository = new StatusRepository($connection);
        $manager = new StatusManager($repository);

        $foundEntity = $manager->findOne($entity->getId());
        $this->assertNull($foundEntity);

    }
}