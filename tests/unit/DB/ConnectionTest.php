<?php
namespace Entity;

use App\DB\Connection;
use App\Entity\Type\Customer;

class ConnectionTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    /**
     * @group entity
     * @group db
     * @group db-default
     */
    public function testDefault()
    {
        $connection = new Connection();
        $creds = $connection->getCreds();

        $this->assertSame('db_test', getenv('TEST_MYSQL_HOST'));
        $this->assertSame('db_test', $creds['host']);


    }

}