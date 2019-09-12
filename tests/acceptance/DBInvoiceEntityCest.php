<?php

use App\DB\Connection;
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
        $manager = $this->getManager();
        $manager->save($entity);

        $I->seeInDatabase('invoice', [
            'vat' => $entity->getVat(),
            'total' => $entity->getTotal(),
            'reference' => $entity->getReference()
        ]);
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
        $manager = $this->getManager();
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

        $connection = new Connection();
        $repository = new StatusRepository($connection);
        $manager = new StatusManager($repository);
        $savedStatus = $manager->save($status);

        $invoice = new Invoice();
        $invoice->setVAT(1)
            ->setTotal(1)
            ->setStatus($savedStatus)
            ->setReference('Test reference');

        $manager = $this->getManager();;
        $savedInvoice = $manager->save($invoice);

        $I->seeInDatabase('invoice', [
            'vat' => $invoice->getVat(),
            'total' => $invoice->getTotal(),
            'reference' => $invoice->getReference(),
            'status_id' => $savedStatus->getId(),
            'id' => $savedInvoice->getId()
        ]);


    }

    /**
     * @return InvoiceManager
     */
    protected function getManager():InvoiceManager
    {
        $connection = new App\DB\Connection();
        $repository = new InvoiceRepository($connection);
        return new InvoiceManager($repository);
    }
}
