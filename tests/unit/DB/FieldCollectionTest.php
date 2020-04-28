<?php

namespace Entity;


use App\DB\Builder\FieldCollection;
use Codeception\Test\Unit;
use UnitTester;

class FieldCollectionTest extends Unit
{
    /**
     * @var UnitTester
     */
    protected $tester;


    /**
     * @group entity
     * @group db
     * @group db-field-collection
     * @group db-field-collection-add
     */
    public function testAdd()
    {
        $fieldCollection = new FieldCollection();
        $fieldCollection->add('id');

        $this->assertSame('`id`', $fieldCollection->getSQL());
    }

    /**
     * @group entity
     * @group db
     * @group db-field-collection
     * @group db-field-collection-add-multiple
     */
    public function testAddMultiple()
    {
        $fieldCollection = new FieldCollection();
        $fieldCollection->add('id');
        $fieldCollection->add('total');

        $this->assertSame('`id`, `total`', $fieldCollection->getSQL());
    }

    /**
     * @group entity
     * @group db
     * @group db-field-collection
     * @group db-field-collection-set
     */
    public function testSet()
    {
        $fieldCollection = new FieldCollection();
        $fieldCollection->set(['id', 'total']);

        $this->assertSame('`id`, `total`', $fieldCollection->getSQL());
    }

    /**
     * @group entity
     * @group db
     * @group db-field-collection
     * @group db-field-collection-all
     */
    public function testAll()
    {
        $fieldCollection = new FieldCollection();

        $this->assertSame('*', $fieldCollection->getSQL());
    }

    protected function _before()
    {
    }

    protected function _after()
    {
    }

}