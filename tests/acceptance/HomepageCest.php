<?php 

class HomepageCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    // tests
    public function tryToResponse(AcceptanceTester $I)
    {
        $I->wantTo('Test the response code of the home page');
        $I->amOnPage('/');
        $I->seeResponseCodeIs(200);
    }
}
