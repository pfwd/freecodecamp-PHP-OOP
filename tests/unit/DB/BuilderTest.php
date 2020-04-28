<?php

namespace Entity;


use App\DB\Builder\Builder;
use App\DB\Builder\FieldCollection;
use App\DB\Builder\WhereCollection;
use App\DB\QueryBuilder;
use App\Entity\Invoice;
use App\Entity\Status;
use Codeception\Test\Unit;
use UnitTester;

class BuilderTest extends Unit
{
    /**
     * @var UnitTester
     */
    protected $tester;

    /**
     * @var Builder
     */
    protected $builder;

    public function _inject(Builder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * @group entity
     * @group db
     * @group db-query-builder
     * @group db-query-builder-where
     */
    public function testWhere()
    {
        $where = $this->builder->make(WhereCollection::class);

        $this->assertInstanceOf(WhereCollection::class, $where);
    }

    /**
     * @group entity
     * @group db
     * @group db-query-builder
     * @group db-query-builder-fields
     */
    public function testFields()
    {
        $where = $this->builder->make(FieldCollection::class);

        $this->assertInstanceOf(FieldCollection::class, $where);
    }

    protected function _before()
    {
    }

    protected function _after()
    {
    }

}