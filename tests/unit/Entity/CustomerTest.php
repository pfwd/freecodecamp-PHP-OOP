<?php
namespace Entity;

use App\Entity\Customer;

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
     * @group entity
     * @group customer
     * @group customer-default
     */
    public function testDefault()
    {
        $customer = new Customer();
        $this->assertEmpty($customer->getCompanyName());
        $this->assertIsString($customer->getCompanyName());
        $this->assertEmpty($customer->getFirstName());
        $this->assertIsString($customer->getFirstName());
        $this->assertEmpty($customer->getLastName());
        $this->assertIsString($customer->getLastName());
        $this->assertEmpty((string) $customer);
    }

    /**
     * @group entity
     * @group customer
     * @group customer-set-company-name
     */
    public function testSetCompanyName()
    {
        $customer = new Customer();
        $customer->setCompanyName('How To Code Well');
        $this->assertSame('How To Code Well', $customer->getCompanyName());
    }

    /**
     * @group entity
     * @group customer
     * @group customer-set-first-name
     */
    public function testSetFirstName()
    {
        $customer = new Customer();
        $customer->setFirstName('Peter');
        $this->assertSame('Peter', $customer->getFirstName());
        $this->assertSame('Peter', (string) $customer);
    }

    /**
     * @group entity
     * @group customer
     * @group customer-set-last-name
     */
    public function testSetLastName()
    {
        $customer = new Customer();
        $customer->setLastName('Fisher');
        $this->assertSame('Fisher', $customer->getLastName());
        $this->assertSame('Fisher', (string) $customer);
    }

    /**
     * @group entity
     * @group customer
     * @group customer-to-string
     */
    public function testFullName()
    {
        $customer = new Customer();
        $customer->setFirstName('Peter');
        $customer->setLastName('Fisher');
        $this->assertSame('Peter Fisher', (string) $customer);
    }

}