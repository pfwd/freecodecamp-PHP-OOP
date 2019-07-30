<?php 

class DBStatusEntityCest
{
    public function _before(AcceptanceTester $I)
    {
    }


    /**
     * @param AcceptanceTester $I
     * @group db
     * @group db-status-entity-insert
     */
    public function insertTest(AcceptanceTester $I)
    {
        $entity = new \App\Entity\Type\Status();
        $entity->setName('Hello World2')
            ->setInternalName('HELLO_WORLD_2')
            ;
        $connection = new App\DB\Connection();
        $manager = new \App\Manager\StatusManager($connection);
        $manager->save($entity);

        $I->seeInDatabase('status', [
            'name' => $entity->getName(),
            'internal_name' => $entity->getInternalName()
        ]);
    }

}
