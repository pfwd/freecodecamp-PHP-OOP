<?php

use App\DB\Connection;
use App\Entity\Type\Invoice;
use App\Manager\InvoiceManager;
use App\Repository\Type\InvoiceRepository;
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
        $repository = new InvoiceRepository($connection);
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


    protected function _before()
    {
    }

    protected function _after()
    {
    }
}