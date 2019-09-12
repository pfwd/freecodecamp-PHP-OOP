<?php namespace Hydrator;

use App\Entity\Invoice;
use App\Hydration\InvoiceHydrator;
use DateTime;

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
     * @group hydrator
     * @group hydrator-invoice
     */
    public function testHydration()
    {

        $date = new DateTime();
        $data = [
            'id' => 1,
            'reference' => 'invoice-001',
            'total' => 2.99,
            'vat' => 1.25,
            'date_created' => $date->format(DateTime::ISO8601),
            'date_updated' => $date->format(DateTime::ISO8601)
        ];
        $entity = InvoiceHydrator::hydrate($data);

        $this->assertInstanceOf(Invoice::class, $entity);
        $this->assertSame(1, $entity->getId());
        $this->assertSame('invoice-001', $entity->getReference());
        $this->assertSame(2.99, $entity->getTotal());
        $this->assertSame(1.25, $entity->getVAT());
        $this->assertInstanceOf(DateTime::class, $entity->getDateCreated());
        $this->assertInstanceOf(DateTime::class, $entity->getDateUpdated());
    }
}