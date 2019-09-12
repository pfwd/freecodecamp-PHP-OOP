<?php namespace Hydrator;

use App\Entity \InvoiceItem;
use App\Hydration\InvoiceItemHydrator;
use DateTime;

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
     * @group hydrator
     * @group hydrator-invoice-item
     */
    public function testHydration()
    {
        $date = new DateTime();
        $data = [
            'id' => 1,
            'reference' => 'invoice-item-001',
            'description' => 'Development time',
            'unit_price' => 2.85,
            'units' => 7,
            'total' => 350,
            'date_created' => $date->format(DateTime::ISO8601),
            'date_updated' => $date->format(DateTime::ISO8601)
        ];
        $entity = InvoiceItemHydrator::hydrate($data);

        $this->assertInstanceOf(InvoiceItem::class, $entity);
        $this->assertSame(1, $entity->getId());
        $this->assertSame('invoice-item-001', $entity->getReference());
        $this->assertSame('Development time', $entity->getDescription());
        $this->assertSame(2.85, $entity->getUnitPrice());
        $this->assertSame(7, $entity->getUnits());
        $this->assertSame(350.0, $entity->getTotal());
        $this->assertInstanceOf(DateTime::class, $entity->getDateCreated());
        $this->assertInstanceOf(DateTime::class, $entity->getDateUpdated());
    }
}