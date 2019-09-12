<?php

namespace Entity;


use App\DB\QueryBuilder;
use App\Entity\Invoice;
use App\Entity\Status;

class QueryBuilderTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    /**
     * @group entity
     * @group db
     * @group db-query-builder
     * @group db-query-builder-insert-invoice
     */
    public function testInsertInvoice()
    {
        $data = [
            'reference' => 'foo',
            'total' => 1,
            'vat' => 1,
            'status_id' => 4,
            'id' => 5
        ];
        $table = 'invoice';
        $sql = QueryBuilder::insert($data, $table);
        $expected = "INSERT INTO `invoice` (`reference`, `total`, `vat`, `status_id`, `id`) VALUE (:reference, :total, :vat, :status_id, :id);";

        $this->assertSame($expected, $sql);
    }

    /**
     * @group entity
     * @group db
     * @group db-query-builder
     * @group db-query-builder-insert-customer
     */
    public function testInsertCustomer()
    {
        $data = [
            'first_name' => 'Peter',
            'last_name' => 'Fisher',
            'company_name' => 'How To Code Well',
        ];
        $table = 'customer';
        $sql = QueryBuilder::insert($data, $table);
        $expected = "INSERT INTO `customer` (`first_name`, `last_name`, `company_name`) VALUE (:first_name, :last_name, :company_name);";

        $this->assertSame($expected, $sql);
    }
    /**
     * @group entity
     * @group db
     * @group db-query-builder
     * @group db-query-builder-update
     */
    public function testUpdate()
    {
        $data = [
            'reference' => 'reference',
            'total' => 'total',
            'vat' => 'vat',
        ];

        $where = [
            'id' => 'id'
        ];

        $table = 'invoice';

        $sql = QueryBuilder::update($data, $table, $where);
        $expected = "UPDATE `invoice` SET `reference` =:reference, `total` =:total, `vat` =:vat WHERE `id` =:id;";

        $this->assertSame($expected, $sql);
    }

    /**
     * @group entity
     * @group db
     * @group db-query-builder
     * @group db-query-builder-insert-or-update-with-no-where-clause
     */
    public function testInsertOrUpdateWithNoWhereClause()
    {
        $data = [
            'first_name' => 'Peter',
            'last_name' => 'Fisher',
            'company_name' => 'How To Code Well',
        ];
        $table = 'customer';

        $sql = QueryBuilder::insertOrUpdate($data, $table);
        $expected = "INSERT INTO `customer` (`first_name`, `last_name`, `company_name`) VALUE (:first_name, :last_name, :company_name);";

        $this->assertSame($expected, $sql);
    }

    /**
     * @group entity
     * @group db
     * @group db-query-builder
     * @group db-query-builder-insert-or-update-with-where-clause
     */
    public function testInsertOrUpdateWithWhereClause()
    {
        $data = [
            'reference' => 'reference',
            'total' => 'total',
            'vat' => 'vat',
        ];

        $where = [
            'id' => 'id'
        ];

        $table = 'invoice';

        $sql = QueryBuilder::insertOrUpdate($data, $table, $where);

        $expected = "UPDATE `invoice` SET `reference` =:reference, `total` =:total, `vat` =:vat WHERE `id` =:id;";

        $this->assertSame($expected, $sql);
    }

    /**
     * @group entity
     * @group db
     * @group db-query-builder
     * @group db-query-builder-insert-or-update-invoice-with-status
     */
    public function testInsertOrUpdateInvoiceWithStatus()
    {
        $status = new Status();
        $status->setInternalName('test')
            ->setName('test')
            ->setId(2)
            ;
        $entity = new Invoice();
        $entity->setReference('foo')
            ->setTotal(1)
            ->setVAT(1)
            ->setStatus($status);
        ;
        $data = [
            'reference' => $entity->getReference(),
            'total' => $entity->getTotal(),
            'vat' => $entity->getVat()
        ];
        if ($entity->getStatus() instanceof Status){
            $data['status_id'] = $entity->getStatus()->getId();
        }

        $table = 'invoice';

        $sql = QueryBuilder::insertOrUpdate($data, $table);

        $expected = "INSERT INTO `invoice` (`reference`, `total`, `vat`, `status_id`) VALUE (:reference, :total, :vat, :status_id);";

        $this->assertSame($expected, $sql);
    }

    /**
     * @group entity
     * @group db
     * @group db-query-builder
     * @group db-query-builder-find-one-by-id
     */
    public function testFindOneByID()
    {
        $sql = QueryBuilder::findOneBy('status');
        $expected = "SELECT * FROM `status` WHERE id=:id";
        $this->assertSame($expected, $sql);
    }

    /**
     * @group entity
     * @group db
     * @group db-query-builder
     * @group db-query-builder-find-all
     */
    public function testFindAll()
    {
        $sql = QueryBuilder::findAll('status');
        $expected = "SELECT * FROM `status`";
        $this->assertSame($expected, $sql);
    }

    /**
     * @group entity
     * @group db
     * @group db-query-builder
     * @group db-query-builder-find-all-by
     */
    public function testFindAllBy()
    {
        $sql = QueryBuilder::findAllBy('status', [
            'name'  => 'name',
            'internal_name' => 'internal_name'
        ]);
        $expected = "SELECT * FROM `status` WHERE `name` =:name AND `internal_name` =:internal_name";
        $this->assertSame($expected, $sql);
    }

    protected function _before()
    {
    }

    protected function _after()
    {
    }

}