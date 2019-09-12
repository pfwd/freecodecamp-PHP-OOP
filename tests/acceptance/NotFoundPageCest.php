<?php 

class NotFoundPageCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    /**
     * @param AcceptanceTester $I
     *
     * @group page-not-found
     */
    public function pageNotFoundTest(AcceptanceTester $I)
    {
        $I->wantTo('Test the response code for 404 page');
        $I->amOnPage('/not-found');
        $I->seeResponseCodeIs(404);
//        $I->canSee('Page Not Found');
//        $I->canSeeInTitle('Page Not Found');
    }
}
