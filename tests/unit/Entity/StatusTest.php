<?php
namespace Entity;

use App\Entity\Status;

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
     * @group entity
     * @group status
     * @group status-default
     */
    public function testDefault()
    {
        $status = new Status();
        $this->assertEmpty($status->getName());
        $this->assertIsString($status->getName());
        $this->assertEmpty($status->getInternalName());
        $this->assertIsString($status->getInternalName());
    }

    /**
     * @group entity
     * @group status
     * @group status-set-name
     */
    public function testSetName()
    {
        $status = new Status();
        $status->setName('draft');

        $this->assertSame('draft', $status->getName());
        $this->assertSame('DRAFT', $status->getInternalName());
        $this->assertInstanceOf(Status::class, $status);
    }

    /**
     * @group entity
     * @group status
     * @group status-set-internal-name
     */
    public function testSetInternalName()
    {
        $status = new Status();
        $status->setInternalName('draft');

        $this->assertSame('DRAFT', $status->getInternalName());
        $this->assertInstanceOf(Status::class, $status);
    }

    /**
     * @group entity
     * @group status
     * @group status-set-internal-name-with-spaces
     */
    public function testSetInternalNameWithSpaces()
    {
        $status = new Status();
        $status->setInternalName('Under Review');

        $this->assertSame('UNDER_REVIEW', $status->getInternalName());
        $this->assertInstanceOf(Status::class, $status);
    }


}