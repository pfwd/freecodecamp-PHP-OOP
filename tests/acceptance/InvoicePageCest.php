<?php 

class InvoicePageCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    /**
     * @param AcceptanceTester $I
     *
     * @group invoice
     */
    public function invoiceDashboardTest(AcceptanceTester $I)
    {
        $I->wantTo('Test the response code for the invoice dashboard page');
        $I->amOnPage('/invoice');
        $I->canSee('This is the invoice dashboard');
        $I->seeResponseCodeIs(200);
    }

    /**
     * @param AcceptanceTester $I
     *
     * @group invoice
     * @group invoice-get-by-id
     */
    public function invoiceTest(AcceptanceTester $I)
    {
        $I->wantTo('Test the response code for the invoice');
        $I->amOnPage('/invoice/123');
        $I->canSee('This is the invoice page for invoice 123    ');
        $I->seeResponseCodeIs(200);
    }

    /**
     * @param AcceptanceTester $I
     *
     * @group invoice
     * @group invoice-not-found
     */
    public function pageNotFoundTest(AcceptanceTester $I)
    {
        $I->wantTo('Test the response code for the invoice');
        $I->amOnPage('/invoice/rrr/edit/aaa');
        $I->seeResponseCodeIs(404);
    }
}
