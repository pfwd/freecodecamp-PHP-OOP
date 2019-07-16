<?php 

class DBStatusCest
{
    public function _before(AcceptanceTester $I)
    {
    }


    /**
     * @param AcceptanceTester $I
     * @group db
     * @group db-status-draft
     */
    public function StatusDraftTest(AcceptanceTester $I)
    {
        $I->seeInDatabase('status', [
            'name' => 'draft',
            'internal_name' => 'DRAFT'
        ]);
    }

    /**
     * @param AcceptanceTester $I
     * @group db
     * @group db-status-sent
     */
    public function StatusSentTest(AcceptanceTester $I)
    {
        $I->seeInDatabase('status', [
            'name' => 'sent',
            'internal_name' => 'SENT'
        ]);
    }

    /**
     * @param AcceptanceTester $I
     * @group db
     * @group db-status-overdue
     */
    public function OverdueSentTest(AcceptanceTester $I)
    {
        $I->seeInDatabase('status', [
            'name' => 'overdue',
            'internal_name' => 'OVERDUE'
        ]);
    }
}
