<?php
namespace Entity;

use App\Entity\Invoice;

class InvoiceTest extends \Codeception\Test\Unit
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
     * @group invoice
     * @group invoice-default
     */
    public function testDefault()
    {
        $invoice = new Invoice();
        $this->assertNull($invoice->getCustomer());
        $this->assertIsArray($invoice->getItems());
        $this->assertEmpty($invoice->getItems());
        $this->assertIsString($invoice->getReference());
        $this->assertEmpty($invoice->getReference());
        $this->assertIsFloat($invoice->getTotal());
        $this->assertSame(0.0, $invoice->getTotal());
        $this->assertIsFloat($invoice->getVAT());
        $this->assertSame(0.0, $invoice->getVAT());
        $this->assertNull($invoice->getStatus());
        $this->assertNull($invoice->getId());
        $this->assertNull($invoice->getDateCreated());
        $this->assertNull($invoice->getDateUpdated());
    }

    /**
     * @group entity
     * @group invoice
     * @group invoice-set-reference
     */
    public function testSetReference()
    {
        $invoice = new Invoice();
        $invoice->setReference('abc123');
        $this->assertSame('abc123', $invoice->getReference());
    }

    /**
     * @group entity
     * @group invoice
     * @group invoice-set-total
     */
    public function testSetTotal()
    {
        $invoice = new Invoice();
        $invoice->setTotal(100.5);
        $this->assertSame( 100.5, $invoice->getTotal());
    }

    /**
     * @group entity
     * @group invoice
     * @group invoice-set-vat
     */
    public function testSetVAT()
    {
        $invoice = new Invoice();
        $invoice->setVAT(123.5);
        $this->assertSame( 123.5, $invoice->getVAT());
    }


}