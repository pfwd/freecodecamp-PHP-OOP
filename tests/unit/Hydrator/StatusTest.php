<?php namespace Hydrator;

use App\Entity\Status;
use App\Hydration\StatusHydrator;
use DateTime;

class StatusTest extends \Codeception\Test\Unit
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
     * @group hydrator
     * @group hydrator-status
     */
    public function testHydration()
    {
        $date = new DateTime();
        $data = [
            'id' => 1,
            'name' => 'test',
            'internal_name' => 'TEST',
            'date_created' => $date->format(DateTime::ISO8601),
            'date_updated' => $date->format(DateTime::ISO8601)
        ];
        $entity = StatusHydrator::hydrate($data);

        $this->assertInstanceOf(Status::class, $entity);
        $this->assertSame(1, $entity->getId());
        $this->assertSame('test', $entity->getName());
        $this->assertSame('TEST', $entity->getInternalName());
        $this->assertInstanceOf(DateTime::class, $entity->getDateCreated());
        $this->assertInstanceOf(DateTime::class, $entity->getDateUpdated());
    }
}