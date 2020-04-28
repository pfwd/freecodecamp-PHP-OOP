<?php

namespace Entity;


use App\DB\Builder\Builder;
use App\DB\QueryBuilder;
use App\Entity\Invoice;
use App\Entity\Status;
use Codeception\Test\Unit;
use UnitTester;

class StatusQueryBuilderTest extends Unit
{
    /**
     * @var UnitTester
     */
    protected $tester;

    protected $builder;

    public function _inject(Builder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * @group entity
     * @group db
     * @group db-query-builder-status
     * @group db-query-builder-status-select-all
     */
    public function testSelectAll()
    {
        $queryBuilder = new QueryBuilder($this->builder);
        $queryBuilder->select('status');

        $this->assertSame('SELECT * FROM `status`', $queryBuilder->getSQL());
    }

    /**
     * @group entity
     * @group db
     * @group db-query-builder-status
     * @group db-query-builder-status-select-by-id
     */
    public function testSelectByID()
    {
        $queryBuilder = new QueryBuilder($this->builder);
        $queryBuilder->select('status');
        $queryBuilder->andWhere('id', 4);

        $this->assertSame("SELECT * FROM `status` WHERE `id` =:id", $queryBuilder->getSQL());
    }


    protected function _before()
    {
    }

    protected function _after()
    {
    }

}