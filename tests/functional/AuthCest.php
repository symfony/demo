<?php
class AuthCest
{
    function _before(FunctionalTester $I)
    {
        $I->amOnPage('/login');
    }

    /**
     * @group user
     * @param FunctionalTester $I
     */
    public function authAsUser(FunctionalTester $I)
    {
        $I->fillField('Username', 'john_user');
        $I->fillField('Password:', 'kitten');
        $I->click('Sign in');
        $I->amOnPage('/blog');
        $I->seeLink('Logout','/logout');

        $I->expect("user can't access admin area");
        $I->amOnPage('/admin/post/');
        $I->seeResponseCodeIs(403);

    }

    /**
     * @param FunctionalTester $I
     */
    public function authAsAdmin(FunctionalTester $I)
    {
        $I->fillField('Username', 'anna_admin');
        $I->fillField('Password:', 'kitten');
        $I->click('Sign in');
        $I->amOnPage('/admin/post/');
        $I->see('Post List', 'h1');
        $I->seeLink('Logout','/logout');
    }

    public function invalidAuth(FunctionalTester $I)
    {
        $I->fillField('Username', 'notauser');
        $I->fillField('Password:', 'kitten');
        $I->click('Sign in');
        $I->see('Invalid credentials', '.alert');
        $I->seeCurrentUrlEquals('/login');
        $I->dontSeeLink('Logout','/logout');
    }
}