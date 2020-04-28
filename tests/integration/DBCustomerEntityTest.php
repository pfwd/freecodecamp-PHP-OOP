<?php

use App\DB\Builder\Builder;
use App\DB\Builder\FieldCollection;
use App\DB\Builder\WhereCollection;
use App\DB\Connection;
use App\DB\QueryBuilder;
use App\Entity\Customer;
use App\Manager\CustomerManager;
use App\Repository\CustomerRepository;
use Codeception\Test\Unit;

class DBCustomerEntityTest extends Unit
{
    /**
     * @var Code
     */
    protected $tester;

    /**
     * @group db-customer
     * @group db-customer-entity-find-one-by-id
     */
    public function testSaveCustomerAndFindByID()
    {
        $entity = new Customer();
        $entity->setFirstName('Foo')
            ->setLastName('Bar')
            ->setCompanyName('FooBar');
        $manager = $this->getManager();
        $savedEntity = $manager->save($entity);

        $foundEntity = $manager->findOne($savedEntity->getId());

        $this->assertSame($foundEntity->getFirstName(), $savedEntity->getFirstName());
        $this->assertSame($foundEntity->getLastName(), $savedEntity->getLastName());
        $this->assertSame($foundEntity->getCompanyName(), $savedEntity->getCompanyName());
    }

    /**
     * @return CustomerManager
     */
    protected function getManager(): CustomerManager
    {
        $connection = new Connection();
        $builder = new Builder();
        $queryBuilder = new QueryBuilder($builder);
        $repository = new CustomerRepository($connection, $queryBuilder);
        return new CustomerManager($repository);
    }

    /**
     * @group db-customer
     * @group db-customer-entity-find-one-by-id-not-exists
     */
    public function testFindCustomerThatDoesNotExist()
    {
        $entity = new Customer();
        $entity->setId(5001);
        $manager = $this->getManager();

        $foundEntity = $manager->findOne($entity->getId());
        $this->assertNull($foundEntity);

    }

    /**
     * @group db-customer
     * @group db-customer-entity-find-all
     */
    public function testFindAll()
    {
        $entity1 = new Customer();
        $entity1->setFirstName("Peter");
        $entity1->setLastName("Fisher");
        $entity1->setCompanyName("How To Code Well");

        $entity2 = new Customer();
        $entity2->setFirstName("Foo");
        $entity2->setLastName("Bar");
        $entity2->setCompanyName("FooBar");

        $manager = $this->getManager();

        $manager->save($entity1);
        $manager->save($entity2);
        $results = $manager->findAll();

        $this->assertIsArray($results);
        $this->assertGreaterThan(1, count($results));

        $foundEntity1 = $results[0];

        $this->assertInstanceOf(Customer::class, $foundEntity1);
    }

    protected function _before()
    {
    }

    protected function _after()
    {
    }
}