<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ResetPasswordControllerTest extends WebTestCase
{
    public function testResetPasswordEmailEmbeddedInResponse(): void
    {
        $client = static::createClient();
        $client->followRedirects();
        $client->request('GET', '/en/reset-password');

        $crawler = $client->submitForm('Send password reset email', [
            'reset_password_request_form[email]' => 'jane_admin@symfony.com',
        ]);

        $this->assertResponseIsSuccessful();

        $this->assertStringContainsString(
            'An email has been sent that contains a link that you can click to reset your password.',
            $crawler->filter('.row p')->text()
        );

        $this->assertStringContainsString(
            'Hi! To reset your password, please visit here',
            $crawler->filter('#reset-email-msg')->text()
        );
    }

    public function testEmailSentOnResetRequest(): void
    {
        $client = static::createClient();
        $client->request('GET', '/en/reset-password');

        $client->submitForm('Send password reset email', [
            'reset_password_request_form[email]' => 'jane_admin@symfony.com',
        ]);

        $this->assertEmailCount(1);
        $this->assertEmailHtmlBodyContains($this->getMailerMessage(), 'To reset your password, please visit');
    }

    public function testInvalidToken(): void
    {
        $client = static::createClient();
        $client->followRedirects();

        $crawler = $client->request('GET', '/en/reset-password/reset/badToken');

        $this->assertResponseIsSuccessful();

        $this->assertStringContainsString(
            'The reset password link is invalid.',
            $crawler->filter('.alert')->text()
        );
    }
}
