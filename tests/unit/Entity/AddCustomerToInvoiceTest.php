<?php
namespace Entity;

use App\Entity\Type\Customer;
use App\Entity\Type\Invoice;

class AddCustomerToInvoiceTest extends \Codeception\Test\Unit
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
     * @group invoice-set-customer
     */
    public function testSetCustomer()
    {
        $customer = new Customer();
        $invoice = new Invoice();
        $invoice->setCustomer($customer);
        $this->assertInstanceOf(Customer::class, $invoice->getCustomer());
    }

}