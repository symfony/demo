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

use App\Command\ListUsersCommand;
use PHPUnit\Framework\Attributes\DataProvider;

final class ListUsersCommandTest extends AbstractCommandTestCase
{
    /**
     * This test verifies the amount of data is right according to the given parameter max results.
     */
    #[DataProvider('maxResultsProvider')]
    public function testListUsers(int $maxResults): void
    {
        $tester = $this->executeCommand(
            ['--max-results' => $maxResults]
        );

        $emptyDisplayLines = 5;
        $this->assertSame($emptyDisplayLines + $maxResults, mb_substr_count($tester->getDisplay(), "\n"));
    }

    public static function maxResultsProvider(): \Generator
    {
        yield [1];
        yield [2];
    }

    public function testItSendsNoEmailByDefault(): void
    {
        $this->executeCommand([]);

        $this->assertEmailCount(0);
    }

    public function testItSendsAnEmailIfOptionProvided(): void
    {
        $this->executeCommand(['--send-to' => 'john.doe@symfony.com']);

        $this->assertEmailCount(1);
    }

    protected function getCommandFqcn(): string
    {
        return ListUsersCommand::class;
    }
}
