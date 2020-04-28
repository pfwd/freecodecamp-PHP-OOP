<?php

namespace Entity;

use App\DB\Builder\WhereCollection;
use Codeception\Test\Unit;
use UnitTester;

class WhereCollectionTest extends Unit
{
    /**
     * @var UnitTester
     */
    protected $tester;
    
    /**
     * @group entity
     * @group db
     * @group db-where-collection
     * @group db-where-collection-add
     */
    public function testAdd()
    {
        $whereCollection = new WhereCollection();
        $whereCollection->add('id', 10);

        $this->assertSame('WHERE `id` =:id', $whereCollection->getSQL());
    }

    /**
     * @group entity
     * @group db
     * @group db-where-collection
     * @group db-where-collection-add-multiple
     */
    public function testAddMultiple()
    {
        $whereCollection = new WhereCollection();
        $whereCollection->add('id', 10);
        $whereCollection->add('total', 15);

        $this->assertSame('WHERE `id` =:id AND `total` =:total', $whereCollection->getSQL());
    }

    /**
     * @group entity
     * @group db
     * @group db-where-collection
     * @group db-where-collection-set
     */
    public function testSet()
    {
        $whereCollection = new WhereCollection();
        $whereCollection->set([
            'id' => 19,
            'total' => 3
        ]);

        $this->assertSame('WHERE `id` =:id AND `total` =:total', $whereCollection->getSQL());
    }

    /**
     * @group entity
     * @group db
     * @group db-where-collection
     * @group db-where-collection-blank
     */
    public function testBlank()
    {
        $whereCollection = new WhereCollection();

        $this->assertSame('', $whereCollection->getSQL());
    }

    protected function _before()
    {
    }

    protected function _after()
    {
    }

}