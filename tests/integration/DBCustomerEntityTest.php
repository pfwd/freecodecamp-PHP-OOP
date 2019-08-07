<?php

use App\DB\Connection;
use App\Entity\Type\Customer;
use App\Manager\CustomerManager;
use App\Repository\Type\CustomerRepository;

class DBCustomerEntityTest extends \Codeception\Test\Unit
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
     * @group db-customer
     * @group db-customer-entity-find-one-by-id
     */
    public function testSaveCustomerAndFindByID()
    {
        $entity = new Customer();
        $entity->setFirstName('Foo')
            ->setLastName('Bar')
            ->setCompanyName('FooBar')
        ;
        $connection = new Connection();
        $repository = new CustomerRepository($connection);
        $manager = new CustomerManager($repository);
        $savedEntity = $manager->save($entity);

        $foundEntity = $manager->findOne($savedEntity->getId());

        $this->assertSame($foundEntity->getFirstName(), $savedEntity->getFirstName());
        $this->assertSame($foundEntity->getLastName(), $savedEntity->getLastName());
        $this->assertSame($foundEntity->getCompanyName(), $savedEntity->getCompanyName());
    }

    /**
     * @group db-customer
     * @group db-customer-entity-find-one-by-id-not-exists
     */
    public function testFindCustomerThatDoesNotExist()
    {
        $entity = new Customer();
        $entity->setId(5001);
        $connection = new Connection();
        $repository = new CustomerRepository($connection);
        $manager = new CustomerManager($repository);

        $foundEntity = $manager->findOne($entity->getId());
        $this->assertNull($foundEntity);

    }
}