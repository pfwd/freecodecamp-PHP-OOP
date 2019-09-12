<?php
namespace Entity;

use App\Entity\Invoice;
use App\Entity\Status;

class SetStatusToInvoiceTest extends \Codeception\Test\Unit
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
     * @group invoice-set-status
     */
    public function testSetStatus()
    {
        $status = new Status();
        $status->setName('draft');
        $invoice = new Invoice();
        $invoice->setStatus($status);
        $this->assertInstanceOf(Status::class, $invoice->getStatus());
        $this->assertSame('draft', $invoice->getStatus()->getName());
    }

}