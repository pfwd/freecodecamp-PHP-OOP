<?php

use App\DB\Builder\Builder;
use App\DB\Connection;
use App\DB\QueryBuilder;
use App\Entity\Invoice;
use App\Entity\Status;
use App\Manager\InvoiceManager;
use App\Manager\StatusManager;
use App\Repository\InvoiceRepository;
use App\Repository\StatusRepository;

class DBInvoiceEntityCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    /**
     * @param AcceptanceTester $I
     * @group db
     * @group db-invoice-entity-insert
     */
    public function insertTest(AcceptanceTester $I)
    {
        $entity = new Invoice();
        $entity->setVAT(1)
            ->setTotal(1)
            ->setReference('Test reference');
        $manager = $this->getInvoiceManager();
        $manager->save($entity);

        $I->seeInDatabase('invoice', [
            'vat' => $entity->getVat(),
            'total' => $entity->getTotal(),
            'reference' => $entity->getReference()
        ]);
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
     * @return StatusManager
     */
    protected function getStatusManager(): StatusManager
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
     * @group db-invoice-entity-update
     */
    public function updateTest(AcceptanceTester $I)
    {
        $entity = new Invoice();
        $entity->setVAT(1)
            ->setTotal(1)
            ->setReference('Test reference');
        $manager = $this->getInvoiceManager();
        $savedEntity = $manager->save($entity);

        $I->seeInDatabase('invoice', [
            'vat' => $entity->getVat(),
            'total' => $entity->getTotal(),
            'reference' => $entity->getReference(),
            'id' => $savedEntity->getId()
        ]);

        $savedEntity->setReference('Test updated reference');
        $savedEntity->setTotal(3)
            ->setVAT(2);
        $manager->save($savedEntity);

        $I->seeInDatabase('invoice', [
            'vat' => $savedEntity->getVat(),
            'total' => $savedEntity->getTotal(),
            'reference' => $savedEntity->getReference(),
            'id' => $savedEntity->getId()
        ]);

    }

    /**
     * @param AcceptanceTester $I
     * @group db
     * @group db-invoice-entity-insert-with-status
     */
    public function insertWithStatusTest(AcceptanceTester $I)
    {
        $status = new Status();
        $status->setName('temp')
            ->setInternalName('TEMP');

        $savedStatus = $this->getStatusManager()->save($status);

        $invoice = new Invoice();
        $invoice->setVAT(1)
            ->setTotal(1)
            ->setStatus($savedStatus)
            ->setReference('Test reference');

        $manager = $this->getInvoiceManager();;
        $savedInvoice = $manager->save($invoice);

        $I->seeInDatabase('invoice', [
            'vat' => $invoice->getVat(),
            'total' => $invoice->getTotal(),
            'reference' => $invoice->getReference(),
            'status_id' => $savedStatus->getId(),
            'id' => $savedInvoice->getId()
        ]);


    }

}
