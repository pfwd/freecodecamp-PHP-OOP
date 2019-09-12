<?php namespace Hydrator;

use App\Entity\Customer;
use App\Hydration\CustomerHydrator;
use DateTime;

class CustomerTest extends \Codeception\Test\Unit
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
     * @group hydrator-customer
     */
    public function testHydration()
    {
        $date = new DateTime();
        $data = [
            'id' => 1,
            'company_name' => 'Acme Inc',
            'first_name' => 'Peter',
            'last_name' => 'Fisher',
            'date_created' => $date->format(DateTime::ISO8601),
            'date_updated' => $date->format(DateTime::ISO8601)
        ];
        $entity = CustomerHydrator::hydrate($data);

        $this->assertInstanceOf(Customer::class, $entity);
        $this->assertSame(1, $entity->getId());
        $this->assertSame('Acme Inc', $entity->getCompanyName());
        $this->assertSame('Peter', $entity->getFirstName());
        $this->assertSame('Fisher', $entity->getLastName());
        $this->assertInstanceOf(DateTime::class, $entity->getDateCreated());
        $this->assertInstanceOf(DateTime::class, $entity->getDateUpdated());

    }
}