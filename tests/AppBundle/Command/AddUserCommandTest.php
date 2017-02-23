<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\Command;

use AppBundle\Command\AddUserCommand;
use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Tester\CommandTester;

class AddUserCommandTest extends KernelTestCase
{
    private function executeCommand(array $inputArgs, array $interactiveInputs = [])
    {
        self::bootKernel();

        $command = new AddUserCommand();
        $command->setApplication(new Application(self::$kernel));

        $commandTester = new CommandTester($command);
        $commandTester->setInputs($interactiveInputs);
        $commandTester->execute($inputArgs);
    }

    /**
     * @param bool $isAdmin
     */
    private function assertUserCreated($isAdmin)
    {
        $container = self::$kernel->getContainer();

        /** @var User $user */
        $user = $container->get('doctrine')->getRepository(User::class)->findOneByEmail('chuck@norris.com');
        $this->assertNotNull($user);

        $this->assertSame('Chuck Norris', $user->getFullName());
        $this->assertSame('chuck_norris', $user->getUsername());
        $this->assertTrue($container->get('security.password_encoder')->isPasswordValid($user, 'foobar'));
        $this->assertSame($isAdmin ? ['ROLE_ADMIN'] : ['ROLE_USER'], $user->getRoles());
    }

    /**
     * @dataProvider isAdminDataProvider
     *
     * @param bool $isAdmin
     */
    public function testCreateUserNonInteractive($isAdmin)
    {
        $input = [
            'username' => 'chuck_norris',
            'password' => 'foobar',
            'email' => 'chuck@norris.com',
            'full-name' => 'Chuck Norris',
        ];

        if ($isAdmin) {
            $input['--admin'] = 1;
        }

        $this->executeCommand($input);
        $this->assertUserCreated($isAdmin);
    }

    /**
     * @dataProvider isAdminDataProvider
     *
     * @param bool $isAdmin
     */
    public function testCreateUserInteractive($isAdmin)
    {
        // see https://symfony.com/doc/current/components/console/helpers/questionhelper.html#testing-a-command-that-expects-input
        $this->executeCommand($isAdmin ? ['--admin' => 1] : [], [
            'chuck_norris',
            'foobar',
            'chuck@norris.com',
            'Chuck Norris',
        ]);
        $this->assertUserCreated($isAdmin);
    }

    public function isAdminDataProvider()
    {
        yield [true];
        yield [false];
    }
}
