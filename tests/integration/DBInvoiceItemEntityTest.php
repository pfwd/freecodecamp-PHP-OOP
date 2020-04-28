<?php

use App\DB\Builder\Builder;
use App\DB\Connection;
use App\DB\QueryBuilder;
use App\Entity\Invoice;
use App\Entity\InvoiceItem;
use App\Manager\InvoiceItemManager;
use App\Manager\InvoiceManager;
use App\Repository\InvoiceItemRepository;
use App\Repository\InvoiceRepository;
use Codeception\Test\Unit;

class DBInvoiceItemEntityTest extends Unit
{
    /**
     * @var Code
     */
    protected $tester;

    /**
     * @group db-invoice-item
     * @group db-invoice-item-entity-find-one-by-id
     */
    public function testSaveStatusAndFindByID()
    {
        $invoice = new Invoice();
        $invoice->setReference('Test Invoice');

        $invoiceManager = $this->getInvoiceManager();
        $savedInvoice = $invoiceManager->save($invoice);

        $foundInvoice = $invoiceManager->findOne($savedInvoice->getId());

        $this->assertSame($foundInvoice->getReference(), $savedInvoice->getReference());

        $entity = new InvoiceItem();
        $entity->setReference('Devtime')
            ->setTotal(150)
            ->setUnits(7)
            ->setUnitPrice(100)
            ->setDescription('Development time')
            ->setInvoice($invoice);

        $invoiceItemManager = $this->getManager();
        $savedEntity = $invoiceItemManager->save($entity);

        $this->assertInstanceOf(InvoiceItem::class, $savedEntity);

        $foundEntity = $invoiceItemManager->findOne($savedEntity->getId());

        $this->assertInstanceOf(InvoiceItem::class, $foundEntity);

        $this->assertSame($foundEntity->getReference(), $savedEntity->getReference());
        $this->assertSame($foundEntity->getTotal(), $savedEntity->getTotal());
        $this->assertSame($foundEntity->getUnits(), $savedEntity->getUnits());
        $this->assertSame($foundEntity->getUnitPrice(), $savedEntity->getUnitPrice());
        $this->assertSame($foundEntity->getDescription(), $savedEntity->getDescription());
    }

    /**
     * @return InvoiceManager
     */
    protected function getInvoiceManager(): InvoiceManager
    {
        $connection = new Connection();
        $builder = new Builder();
        $queryBuilder = new QueryBuilder($builder);
        $repository = new InvoiceRepository($connection, $queryBuilder);
        return new InvoiceManager($repository);
    }

    /**
     * @return InvoiceItemManager
     */
    protected function getManager(): InvoiceItemManager
    {
        $connection = new Connection();
        $builder = new Builder();
        $queryBuilder = new QueryBuilder($builder);
        $repository = new InvoiceItemRepository($connection, $queryBuilder);
        return new InvoiceItemManager($repository);
    }

    /**
     * @group db-invoice-item
     * @group db-invoice-item-entity-find-one-by-id-not-exists
     */
    public function testFindInvoiceItemThatDoesNotExist()
    {
        $entity = new InvoiceItem();
        $entity->setId(5001);
        $manager = $this->getManager();

        $foundEntity = $manager->findOne($entity->getId());
        $this->assertNull($foundEntity);

    }

    /**
     * @group db-invoice-item
     * @group db-invoice-item-entity-find-all
     */
    public function testFindAllInvoiceItems()
    {
        $invoice = new Invoice();
        $invoice->setReference('Test Invoice');

        $invoiceManager = $this->getInvoiceManager();
        $savedInvoice = $invoiceManager->save($invoice);

        $foundInvoice = $invoiceManager->findOne($savedInvoice->getId());

        $this->assertSame($foundInvoice->getReference(), $savedInvoice->getReference());

        $entity1 = new InvoiceItem();
        $entity1->setReference('Devtime')
            ->setTotal(150)
            ->setUnits(7)
            ->setUnitPrice(100)
            ->setDescription('Development time')
            ->setInvoice($invoice);

        $entity2 = new InvoiceItem();
        $entity2->setReference('Devtime')
            ->setTotal(150)
            ->setUnits(7)
            ->setUnitPrice(100)
            ->setDescription('Development time')
            ->setInvoice($invoice);

        $manager = $this->getManager();

        $manager->save($entity1);
        $manager->save($entity2);

        $results = $manager->findAll();
        $this->assertIsArray($results);
        $this->assertGreaterThan(1, count($results));

        $foundEntity1 = $results[0];
        $this->assertInstanceOf(InvoiceItem::class, $foundEntity1);

    }


    /**
     * @group db-invoice-item
     * @group db-invoice-item-entity-find-all-by-invoice-id
     */
    public function testFindAllInvoiceItemsByInvoiceID()
    {
        $invoice = new Invoice();
        $invoice->setReference('Test Invoice');

        $invoiceManager = $this->getInvoiceManager();
        $savedInvoice = $invoiceManager->save($invoice);

        $foundInvoice = $invoiceManager->findOne($savedInvoice->getId());

        $this->assertSame($foundInvoice->getReference(), $savedInvoice->getReference());

        $entity1 = new InvoiceItem();
        $entity1->setReference('Devtime')
            ->setTotal(150)
            ->setUnits(7)
            ->setUnitPrice(100)
            ->setDescription('Development time')
            ->setInvoice($invoice);

        $entity2 = new InvoiceItem();
        $entity2->setReference('Devtime')
            ->setTotal(150)
            ->setUnits(7)
            ->setUnitPrice(100)
            ->setDescription('Development time')
            ->setInvoice($invoice);

        $manager = $this->getManager();

        $manager->save($entity1);
        $manager->save($entity2);


        $results = $manager->findAllByInvoiceID($foundInvoice->getId());
        $this->assertIsArray($results);
        $this->assertGreaterThan(1, count($results));

        $foundEntity1 = $results[0];
        $this->assertInstanceOf(InvoiceItem::class, $foundEntity1);

    }

    protected function _before()
    {
    }

    protected function _after()
    {
    }
}