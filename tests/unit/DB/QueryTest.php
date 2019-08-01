<?php
namespace Entity;


class QueryTest extends \Codeception\Test\Unit
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
     * @group db-query
     */
    public function testDefault()
    {
        $data = [
            'reference' => 'foo',
            'total' => 1,
            'vat' => 1,
            'status_id' => 4,
            'id' => 5
        ];

        $values = 'VALUE (';
        for($i = 0; $i < count($data); $i++) {
            if($i > 0){
                $values.=",";
            }
            $values.="?";
        }
        $values.= ')';

        $sql = 'INSERT INTO `invoice`';

        $fields = implode('`, `', array_keys($data));

        $sql.= " (`".$fields."`)" . " " . $values .";";

        $expected = "INSERT INTO `invoice` (`reference`, `total`, `vat`, `status_id`, `id`) VALUE (?,?,?,?,?);";

        $this->assertSame($expected, $sql);



    }

}