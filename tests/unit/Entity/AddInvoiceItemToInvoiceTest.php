<?php
namespace Entity;

use App\Entity\Invoice;
use App\Entity\InvoiceItem;

class AddInvoiceItemToInvoiceTest extends \Codeception\Test\Unit
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
     * @group invoice-add-item
     */
    public function testAddItem()
    {
        $invoiceItem = new InvoiceItem();
        $invoice = new Invoice();
        $invoice->addItem($invoiceItem);
        $this->assertInstanceOf(Invoice::class, $invoice);
    }

    /**
     * @group entity
     * @group invoice-add-item
     * @group invoice-add-item-set-items
     */
    public function testSetItems()
    {
        $invoiceItem1 = new InvoiceItem();
        $invoiceItem2 = new InvoiceItem();
        $invoice = new Invoice();
        $invoice->setItems([$invoiceItem1]);
        $invoice->setItems([$invoiceItem2]);
        $this->assertContains($invoiceItem2, $invoice->getItems());
        $this->assertCount(1, $invoice->getItems());
        $this->assertInstanceOf(Invoice::class, $invoice);
    }

    /**
     * @group entity
     * @group invoice-add-item
     * @group invoice-add-item-reset-items
     */
    public function testResetItems()
    {
        $invoiceItem = new InvoiceItem();
        $invoice = new Invoice();
        $invoice->setItems([$invoiceItem]);
        $invoice->resetItems();
        $this->assertEmpty($invoice->getItems());
        $this->assertInstanceOf(Invoice::class, $invoice);
    }

    /**
     * @group entity
     * @group invoice-add-item
     * @group invoice-add-item-does-contain-item
     */
    public function testDoesContainItem()
    {
        $invoiceItem = new InvoiceItem();
        $invoice = new Invoice();
        $invoice->addItem($invoiceItem);
        $doesItemsContain =  $invoice->doesItemsContain($invoiceItem);

        $this->assertTrue($doesItemsContain);
        $this->assertInstanceOf(Invoice::class, $invoice);
    }

    /**
     * @group entity
     * @group invoice-add-item
     * @group invoice-add-item-does-not-contain-item
     */
    public function testDoesNotContainItem()
    {
        $invoiceItem = new InvoiceItem();
        $invoice = new Invoice();
        $doesItemsContain =  $invoice->doesItemsContain($invoiceItem);

        $this->assertFalse($doesItemsContain);
        $this->assertInstanceOf(Invoice::class, $invoice);
    }

    /**
     * @group entity
     * @group invoice-add-item
     * @group invoice-add-item-does-not-contain-item
     */
    public function testSetTheSameItem()
    {
        $invoiceItem = new InvoiceItem();
        $invoice = new Invoice();
        $invoice->setItems([$invoiceItem, $invoiceItem]);
        $this->assertCount(1, $invoice->getItems());
        $this->assertInstanceOf(Invoice::class, $invoice);
    }
}