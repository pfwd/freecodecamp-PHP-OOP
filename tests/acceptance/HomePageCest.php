<?php 

class HomePageCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    /**
     * @param AcceptanceTester $I
     *
     * @group homepage
     */
    public function defaultResponseTest(AcceptanceTester $I)
    {
        $I->wantTo('Test the response code for the homepage');
        $I->amOnPage('/');
        $I->seeResponseCodeIs(200);
        $I->canSee('Hello from the homepage');

    }
}
