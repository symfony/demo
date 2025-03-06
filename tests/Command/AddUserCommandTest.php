<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Tests\Command;

use App\Command\AddUserCommand;
use App\Repository\UserRepository;
use PHPUnit\Framework\Attributes\DataProvider;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

final class AddUserCommandTest extends AbstractCommandTestCase
{
    /**
     * @var string[]
     */
    private array $userData = [
        'username' => 'chuck_norris',
        'password' => 'foobar',
        'email' => 'chuck@norris.com',
        'full-name' => 'Chuck Norris',
    ];

    protected function setUp(): void
    {
        if ('Windows' === \PHP_OS_FAMILY) {
            $this->markTestSkipped('`stty` is required to test this command.');
        }
    }

    /**
     * This test provides all the arguments required by the command, so the
     * command runs non-interactively and it won't ask for any argument.
     */
    #[DataProvider('isAdminDataProvider')]
    public function testCreateUserNonInteractive(bool $isAdmin): void
    {
        $input = $this->userData;
        if ($isAdmin) {
            $input['--admin'] = 1;
        }
        $this->executeCommand($input);

        $this->assertUserCreated($isAdmin);
    }

    /**
     * This test doesn't provide all the arguments required by the command, so
     * the command runs interactively and it will ask for the value of the missing
     * arguments.
     *
     * @see https://symfony.com/doc/current/components/console/helpers/questionhelper.html#testing-a-command-that-expects-input
     */
    #[DataProvider('isAdminDataProvider')]
    public function testCreateUserInteractive(bool $isAdmin): void
    {
        $this->executeCommand(
            // these are the arguments (only 1 is passed, the rest are missing)
            $isAdmin ? ['--admin' => 1] : [],
            // these are the responses given to the questions asked by the command
            // to get the value of the missing required arguments
            array_values($this->userData)
        );

        $this->assertUserCreated($isAdmin);
    }

    /**
     * This is used to execute the same test twice: first for normal users
     * (isAdmin = false) and then for admin users (isAdmin = true).
     */
    public static function isAdminDataProvider(): \Generator
    {
        yield [false];
        yield [true];
    }

    /**
     * This helper method checks that the user was correctly created and saved
     * in the database.
     */
    private function assertUserCreated(bool $isAdmin): void
    {
        /** @var UserRepository $repository */
        $repository = $this->getContainer()->get(UserRepository::class);

        /** @var UserPasswordHasherInterface $passwordHasher */
        $passwordHasher = $this->getContainer()->get(UserPasswordHasherInterface::class);

        $user = $repository->findOneByEmail($this->userData['email']);

        $this->assertNotNull($user);
        $this->assertSame($this->userData['full-name'], $user->getFullName());
        $this->assertSame($this->userData['username'], $user->getUsername());
        $this->assertTrue($passwordHasher->isPasswordValid($user, $this->userData['password']));
        $this->assertSame($isAdmin ? ['ROLE_ADMIN'] : ['ROLE_USER'], $user->getRoles());
    }

    protected function getCommandFqcn(): string
    {
        return AddUserCommand::class;
    }
}
