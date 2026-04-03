<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace App\Tests\Doctrine;

use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * Verifies that user emails are transparently encrypted in the database:
 * stored as opaque ciphertext, returned as plain text by Doctrine, and
 * encrypted automatically when used in a query.
 */
final class EncryptedEmailStorageTest extends KernelTestCase
{
    private EntityManagerInterface $em;
    private UserRepository $repository;

    protected function setUp(): void
    {
        self::bootKernel();
        $container        = static::getContainer();
        $this->em         = $container->get(EntityManagerInterface::class);
        $this->repository = $container->get(UserRepository::class);
    }

    public function testEmailIsEncryptedInDatabase(): void
    {
        $user = $this->repository->findOneByUsername('jane_admin');
        $this->assertNotNull($user);

        $plainEmail = $user->getEmail();
        $this->assertNotNull($plainEmail);

        // Read the raw value stored in the database column
        $rawEmail = $this->em->getConnection()->fetchOne(
            'SELECT email FROM symfony_demo_user WHERE username = ?',
            ['jane_admin'],
        );

        self::assertIsString($rawEmail);
        self::assertNotSame($plainEmail, $rawEmail, 'Email must not be stored as plain text.');
        self::assertNotFalse(
            base64_decode($rawEmail, true),
            'Stored email must be base64-encoded ciphertext.',
        );
    }

    public function testEmailIsDecryptedOnRead(): void
    {
        $user = $this->repository->findOneByUsername('jane_admin');

        $this->assertNotNull($user);
        self::assertSame('jane_admin@symfony.com', $user->getEmail());
    }

    public function testQueryByEmailEncryptsTheParameter(): void
    {
        // findOneByEmail triggers a WHERE clause — Doctrine must encrypt the
        // parameter before comparison for the query to return a result.
        $user = $this->repository->findOneByEmail('jane_admin@symfony.com');

        $this->assertNotNull($user, 'findOneByEmail must find the user when email is encrypted in the database.');
        self::assertSame('jane_admin', $user->getUsername());
    }
}
