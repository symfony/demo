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
use App\Repository\UserRepository;
use PHPUnit\Framework\Attributes\DataProvider;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

/**
 * Functional test for the controllers defined inside the UserController used
 * for managing the current logged user.
 *
 * See https://symfony.com/doc/current/testing.html#functional-tests
 *
 * Whenever you test resources protected by a firewall, consider using the
 * technique explained in:
 * https://symfony.com/doc/current/testing/http_authentication.html
 *
 * Execute the application tests using this command (requires PHPUnit to be installed):
 *
 *     $ cd your-symfony-project/
 *     $ ./vendor/bin/phpunit
 */
final class UserControllerTest extends WebTestCase
{
    #[DataProvider('getUrlsForAnonymousUsers')]
    public function testAccessDeniedForAnonymousUsers(string $httpMethod, string $url): void
    {
        $client = static::createClient();
        $client->request($httpMethod, $url);

        $this->assertResponseRedirects(
            'http://localhost/en/login',
            Response::HTTP_FOUND,
            \sprintf('The %s secure URL redirects to the login form.', $url)
        );
    }

    public static function getUrlsForAnonymousUsers(): \Generator
    {
        yield ['GET', '/en/profile/edit'];
        yield ['GET', '/en/profile/change-password'];
    }

    public function testEditUser(): void
    {
        $client = static::createClient();

        /** @var UserRepository $userRepository */
        $userRepository = $client->getContainer()->get(UserRepository::class);

        /** @var User $user */
        $user = $userRepository->findOneByUsername('jane_admin');

        $newUserEmail = 'admin_jane@symfony.com';

        $client->loginUser($user);

        $client->request('GET', '/en/profile/edit');
        $client->submitForm('Save changes', [
            'user[email]' => $newUserEmail,
        ]);

        $this->assertResponseRedirects('/en/profile/edit', Response::HTTP_SEE_OTHER);

        $user = $userRepository->findOneByEmail($newUserEmail);

        $this->assertNotNull($user);
        $this->assertSame($newUserEmail, $user->getEmail());
    }

    public function testChangePassword(): void
    {
        $client = static::createClient();

        /** @var UserRepository $userRepository */
        $userRepository = $client->getContainer()->get(UserRepository::class);

        /** @var User $user */
        $user = $userRepository->findOneByUsername('jane_admin');

        $newUserPassword = 'new-password';

        $client->loginUser($user);
        $client->request('GET', '/en/profile/change-password');
        $client->submitForm('Save changes', [
            'change_password[currentPassword]' => 'kitten',
            'change_password[newPassword][first]' => $newUserPassword,
            'change_password[newPassword][second]' => $newUserPassword,
        ]);

        $this->assertResponseRedirects();
        $this->assertResponseRedirects(
            '/',
            Response::HTTP_FOUND,
            'Changing password logout the user.'
        );
    }
}
