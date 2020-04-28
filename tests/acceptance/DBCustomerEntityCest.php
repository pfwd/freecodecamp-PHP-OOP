<?php

use App\DB\Builder\Builder;
use App\DB\Connection;
use App\DB\QueryBuilder;
use App\Entity\Customer;
use App\Manager\CustomerManager;
use App\Repository\CustomerRepository;

class DBCustomerEntityCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    /**
     * @return CustomerManager
     */
    public function getManager():CustomerManager
    {
        $connection = new App\DB\Connection();
        $queryBuilder = new QueryBuilder(new Builder());
        $repo = new CustomerRepository($connection, $queryBuilder);
        return new CustomerManager($repo);
    }

    /**
     * @param AcceptanceTester $I
     * @group db
     * @group db-customer-entity-insert
     */
    public function insertTest(AcceptanceTester $I)
    {
        $entity = new Customer();
        $entity->setFirstName('Test First Name')
            ->setLastName('Test Last Name')
            ->setCompanyName('Test Company Name');

        $this->getManager()->save($entity);

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
        $entity = new Customer();
        $entity->setFirstName('Test First Name')
            ->setLastName('Test Last Name')
            ->setCompanyName('Test Company Name');
        $savedEntity = $this->getManager()->save($entity);

        $I->seeInDatabase('customer', [
            'first_name' => $entity->getFirstName(),
            'last_name' => $entity->getLastName(),
            'company_name' => $entity->getCompanyName(),
            'id' => $savedEntity->getId()
        ]);

        $savedEntity->setCompanyName('Test Company Name 2');
        $savedEntity = $this->getManager()->save($savedEntity);

        $I->seeInDatabase('customer', [
            'company_name' => $savedEntity->getCompanyName(),
            'id' => $savedEntity->getId()
        ]);
    }
}
