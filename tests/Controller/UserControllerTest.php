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

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

/**
 * Functional test for the controllers defined inside the UserController used
 * for managing the current logged user.
 *
 * See https://symfony.com/doc/current/book/testing.html#functional-tests
 *
 * Whenever you test resources protected by a firewall, consider using the
 * technique explained in:
 * https://symfony.com/doc/current/cookbook/testing/http_authentication.html
 *
 * Execute the application tests using this command (requires PHPUnit to be installed):
 *
 *     $ cd your-symfony-project/
 *     $ ./vendor/bin/phpunit
 */
class UserControllerTest extends WebTestCase
{
    /**
     * @dataProvider getUrlsForAnonymousUsers
     */
    public function testAccessDeniedForAnonymousUsers(string $httpMethod, string $url)
    {
        $client = static::createClient();
        $client->request($httpMethod, $url);

        $response = $client->getResponse();
        $this->assertSame(Response::HTTP_FOUND, $response->getStatusCode());
        $this->assertSame(
            'http://localhost/en/login',
            $response->getTargetUrl(),
            sprintf('The %s secure URL redirects to the login form.', $url)
        );
    }

    public function getUrlsForAnonymousUsers()
    {
        yield ['GET', '/en/profile/edit'];
        yield ['GET', '/en/profile/change-password'];
    }

    public function testEditUser()
    {
        $newUserEmail = 'admin_jane@symfony.com';

        $client = static::createClient([], [
            'PHP_AUTH_USER' => 'jane_admin',
            'PHP_AUTH_PW' => 'kitten',
        ]);
        $crawler = $client->request('GET', '/en/profile/edit');
        $form = $crawler->selectButton('Save changes')->form([
            'user[email]' => $newUserEmail,
        ]);
        $client->submit($form);

        $this->assertSame(Response::HTTP_FOUND, $client->getResponse()->getStatusCode());

        /** @var User $user */
        $user = $client->getContainer()->get('doctrine')->getRepository(User::class)->findOneBy([
            'email' => $newUserEmail,
        ]);
        $this->assertNotNull($user);
        $this->assertSame($newUserEmail, $user->getEmail());
    }

    public function testChangePassword()
    {
        $newUserPassword = 'new-password';

        $client = static::createClient([], [
            'PHP_AUTH_USER' => 'jane_admin',
            'PHP_AUTH_PW' => 'kitten',
        ]);
        $crawler = $client->request('GET', '/en/profile/change-password');
        $form = $crawler->selectButton('Save changes')->form([
            'change_password[currentPassword]' => 'kitten',
            'change_password[newPassword][first]' => $newUserPassword,
            'change_password[newPassword][second]' => $newUserPassword,
        ]);
        $client->submit($form);

        $response = $client->getResponse();
        $this->assertSame(Response::HTTP_FOUND, $response->getStatusCode());
        $this->assertSame(
            '/en/logout',
            $response->getTargetUrl(),
            'Changing password logout the user.'
        );
    }
}
