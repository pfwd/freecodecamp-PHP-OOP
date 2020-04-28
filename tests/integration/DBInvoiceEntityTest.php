<?php

use App\DB\Builder\Builder;
use App\DB\Connection;
use App\DB\QueryBuilder;
use App\Entity\Invoice;
use App\Manager\InvoiceManager;
use App\Repository\InvoiceRepository;
use Codeception\Test\Unit;

class DBInvoiceEntityTest extends Unit
{
    /**
     * @var Code
     */
    protected $tester;

    /**
     * @group db-invoice
     * @group db-invoice-entity-find-one-by-id
     */
    public function testSaveCustomerAndFindByID()
    {
        $entity = new Invoice();
        $entity->setVAT(3)
            ->setTotal(3)
            ->setReference('FooBar');
        $manager = $this->getManager();
        $savedEntity = $manager->save($entity);

        $foundEntity = $manager->findOne($savedEntity->getId());

        $this->assertSame($foundEntity->getVat(), $savedEntity->getVat());
        $this->assertSame($foundEntity->getTotal(), $savedEntity->getTotal());
        $this->assertSame($foundEntity->getReference(), $savedEntity->getReference());
    }

    /**
     * @return InvoiceManager
     */
    protected function getManager(): InvoiceManager
    {
        $connection = new Connection();
        $builder = new Builder();
        $queryBuilder = new QueryBuilder($builder);
        $repository = new InvoiceRepository($connection, $queryBuilder);
        return new InvoiceManager($repository);
    }

    /**
     * @group db-invoice
     * @group db-invoice-entity-find-one-by-id-not-exists
     */
    public function testFindCustomerThatDoesNotExist()
    {
        $entity = new Invoice();
        $entity->setId(5001);
        $manager = $this->getManager();

        $foundEntity = $manager->findOne($entity->getId());
        $this->assertNull($foundEntity);

    }

    /**
     * @group db-invoice
     * @group db-invoice-entity-find-all
     */
    public function testFindAll()
    {
        $entity1 = new Invoice();
        $entity1->setVAT(3)
            ->setTotal(3)
            ->setReference('Test 1');

        $entity2 = new Invoice();
        $entity2->setVAT(4)
            ->setTotal(4)
            ->setReference('Test 2');

        $manager = $this->getManager();

        $manager->save($entity1);
        $manager->save($entity2);
        $results = $manager->findAll();

        $this->assertIsArray($results);
        $this->assertGreaterThan(1, count($results));

        $foundEntity1 = $results[0];

        $this->assertInstanceOf(Invoice::class, $foundEntity1);
    }

    protected function _before()
    {
    }

    protected function _after()
    {
    }
}