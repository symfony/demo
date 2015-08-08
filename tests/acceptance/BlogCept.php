<?php 
$I = new AcceptanceTester($scenario);
$I->wantTo('open blog page and see article there');
$I->amOnPage('/');
$I->click('Browse application');
$I->seeInCurrentUrl('blog');
$I->seeElement('article.post');
