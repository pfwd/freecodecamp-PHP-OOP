<?php

use App\DB\Connection;

class DBCustomerEntityCest
{
    public function _before(AcceptanceTester $I)
    {
    }


    /**
     * @param AcceptanceTester $I
     * @group db
     * @group db-customer-entity-insert
     */
    public function insertTest(AcceptanceTester $I)
    {
        $entity = new \App\Entity\Type\Customer();
        $entity->setFirstName('Test First Name')
            ->setLastName('Test Last Name')
            ->setCompanyName('Test Company Name')
            ;
        $connection = new App\DB\Connection();
        $manager = new \App\Manager\CustomerManager($connection);
        $manager->save($entity);

        $I->seeInDatabase('customer', [
            'first_name' => $entity->getFirstName(),
            'last_name' => $entity->getLastName(),
            'company_name' => $entity->getCompanyName()
        ]);
    }

    /**
     * @param AcceptanceTester $I
     * @group db
     * @group db-customer-entity-update
     */
    public function updateTest(AcceptanceTester $I)
    {
        $entity = new \App\Entity\Type\Customer();
        $entity->setFirstName('Test First Name')
            ->setLastName('Test Last Name')
            ->setCompanyName('Test Company Name')
        ;
        $connection = new App\DB\Connection();
        $manager = new \App\Manager\CustomerManager($connection);
        $savedEntity = $manager->save($entity);

        $I->seeInDatabase('customer', [
            'first_name' => $entity->getFirstName(),
            'last_name' => $entity->getLastName(),
            'company_name' => $entity->getCompanyName(),
            'id' => $savedEntity->getId()
        ]);

        $savedEntity->setCompanyName('Test Company Name 2');
        $savedEntity = $manager->save($savedEntity);

        $I->seeInDatabase('customer', [
            'company_name' => $savedEntity->getCompanyName(),
            'id' => $savedEntity->getId()
        ]);
    }
}
