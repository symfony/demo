<?php
namespace AcmeBundle;

class AuthCest
{
    function _before(FunctionalTester $I)
    {
        // amOnPage replaced with custom implementation
        // to open /en/login instead of /login
        $I->amOnLocalizedPage('/login');
    }

    /**
     * @group user
     * @param FunctionalTester $I
     */
    public function authAsUser(FunctionalTester $I)
    {
        $I->fillField('Username', 'john_user');
        $I->fillField('Password', 'kitten');
        $I->click('Sign in');
        $I->amOnLocalizedPage('/blog');
        $I->seeLink('Logout');

        $I->expect("user can't access admin area");
        $I->amOnLocalizedPage('/admin/post/');
        $I->seeResponseCodeIs(403);

    }

    /**
     * @param FunctionalTester $I
     */
    public function authAsAdmin(FunctionalTester $I)
    {
        $I->fillField('Username', 'anna_admin');
        $I->fillField('Password', 'kitten');
        $I->click('Sign in');
        $I->amOnLocalizedPage('/admin/post/');
        $I->see('Post List', 'h1');
        $I->seeLink('Logout');
    }

    public function invalidAuth(FunctionalTester $I)
    {
        $I->fillField('Username', 'notauser');
        $I->fillField('Password', 'kitten');
        $I->click('Sign in');
        $I->see('Invalid credentials', '.alert');
        $I->seeInCurrentUrl('/login');
        $I->dontSeeLink('Logout');
    }
}