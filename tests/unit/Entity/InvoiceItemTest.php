<?php
namespace Entity;

use App\Entity\InvoiceItem;

class InvoiceItemTest extends \Codeception\Test\Unit
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
     * @group invoice-item
     * @group invoice-item-default
     */
    public function testDefault()
    {
        $invoiceItem = new InvoiceItem();
        $this->assertEmpty($invoiceItem->getDescription());
        $this->assertIsString($invoiceItem->getDescription());
        $this->assertIsFloat($invoiceItem->getUnitPrice());
        $this->assertSame(0.0,$invoiceItem->getUnitPrice());
        $this->assertIsInt($invoiceItem->getUnits());
        $this->assertSame(0,$invoiceItem->getUnits());
        $this->assertEmpty($invoiceItem->getReference());
        $this->assertIsString($invoiceItem->getReference());
        $this->assertIsFloat($invoiceItem->getTotal());
        $this->assertSame(0.0,$invoiceItem->getTotal());

    }

    /**
     * @group entity
     * @group invoice-item
     * @group invoice-item-set-description
     */
    public function testDescription()
    {
        $invoiceItem = new InvoiceItem();
        $item = $invoiceItem->setDescription('Test invoice item');

        $this->assertInstanceOf(InvoiceItem::class, $item);
        $this->assertSame('Test invoice item', $invoiceItem->getDescription());
    }

    /**
     * @group entity
     * @group invoice-item
     * @group invoice-item-set-reference
     */
    public function testReference()
    {
        $invoiceItem = new InvoiceItem();
        $item = $invoiceItem->setReference('Test invoice item reference');

        $this->assertInstanceOf(InvoiceItem::class, $item);
        $this->assertSame('Test invoice item reference', $invoiceItem->getReference());
    }


    /**
     * @group entity
     * @group invoice-item
     * @group invoice-item-set-units
     */
    public function testUnits()
    {
        $invoiceItem = new InvoiceItem();
        $item = $invoiceItem->setUnits(4);

        $this->assertInstanceOf(InvoiceItem::class, $item);
        $this->assertSame(4, $invoiceItem->getUnits());
    }

    /**
 * @group entity
 * @group invoice-item
 * @group invoice-item-set-unit-price
 */
    public function testUnitPrice()
    {
        $invoiceItem = new InvoiceItem();
        $item = $invoiceItem->setUnitPrice(223423.53);

        $this->assertInstanceOf(InvoiceItem::class, $item);
        $this->assertSame(223423.53, $invoiceItem->getUnitPrice());
    }

    /**
     * @group entity
     * @group invoice-item
     * @group invoice-item-set-total
     */
    public function testTotal()
    {
        $invoiceItem = new InvoiceItem();
        $item = $invoiceItem->setTotal(124434235.53);

        $this->assertInstanceOf(InvoiceItem::class, $item);
        $this->assertSame(124434235.53, $invoiceItem->getTotal());
    }
}