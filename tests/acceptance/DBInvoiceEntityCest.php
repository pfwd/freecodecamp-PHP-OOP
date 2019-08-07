<?php

use App\DB\Connection;
use App\Manager\StatusManager;
use App\Repository\Type\StatusRepository;

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
        $entity = new \App\Entity\Type\Invoice();
        $entity->setVAT(1)
            ->setTotal(1)
            ->setReference('Test reference')
            ;
        $connection = new App\DB\Connection();
        $manager = new \App\Manager\InvoiceManager($connection);
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
        $entity = new \App\Entity\Type\Invoice();
        $entity->setVAT(1)
            ->setTotal(1)
            ->setReference('Test reference')
        ;
        $connection = new App\DB\Connection();
        $manager = new \App\Manager\InvoiceManager($connection);
        $savedEntity = $manager->save($entity);

        $I->seeInDatabase('invoice', [
            'vat' => $entity->getVat(),
            'total' => $entity->getTotal(),
            'reference' => $entity->getReference(),
            'id' => $savedEntity->getId()
        ]);

        $savedEntity->setReference('Test updated reference');
        $savedEntity->setTotal(1)
            ->setVAT(1)
            ;
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
        $status = new \App\Entity\Type\Status();
        $status->setName('temp')
            ->setInternalName('TEMP')
        ;

        $connection = new Connection();
        $repository = new StatusRepository($connection);
        $manager = new StatusManager($repository);
        $savedStatus = $manager->save($status);

        $invoice = new \App\Entity\Type\Invoice();
        $invoice->setVAT(1)
            ->setTotal(1)
            ->setStatus($savedStatus)
            ->setReference('Test reference')
        ;

        $connection = new App\DB\Connection();
        $manager = new \App\Manager\InvoiceManager($connection);
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
