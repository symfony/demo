<?php

declare(strict_types=1);

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Tests\Doctrine\Type;

use App\Doctrine\Type\EncryptedEmailType;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class EncryptedEmailTypeTest extends TestCase
{
    private EncryptedEmailType $type;
    private AbstractPlatform $platform;

    protected function setUp(): void
    {
        $this->type     = new EncryptedEmailType(bin2hex(random_bytes(32)));
        $this->platform = $this->createMock(AbstractPlatform::class);
    }

    public function testEncodeDecodeRoundtrip(): void
    {
        $email = 'user@example.com';

        $encoded = $this->type->convertToDatabaseValue($email, $this->platform);
        $decoded = $this->type->convertToPHPValue($encoded, $this->platform);

        self::assertSame($email, $decoded);
    }

    public function testNullRoundtrip(): void
    {
        self::assertNull($this->type->convertToDatabaseValue(null, $this->platform));
        self::assertNull($this->type->convertToPHPValue(null, $this->platform));
    }

    public function testEncryptionIsDeterministic(): void
    {
        $email = 'user@example.com';

        $first  = $this->type->convertToDatabaseValue($email, $this->platform);
        $second = $this->type->convertToDatabaseValue($email, $this->platform);

        self::assertSame($first, $second);
    }

    public function testDifferentEmailsProduceDifferentCiphertexts(): void
    {
        $first  = $this->type->convertToDatabaseValue('alice@example.com', $this->platform);
        $second = $this->type->convertToDatabaseValue('bob@example.com', $this->platform);

        self::assertNotSame($first, $second);
    }

    public function testDifferentKeysProduceDifferentCiphertexts(): void
    {
        $email = 'user@example.com';
        $other = new EncryptedEmailType(bin2hex(random_bytes(32)));

        $first  = $this->type->convertToDatabaseValue($email, $this->platform);
        $second = $other->convertToDatabaseValue($email, $this->platform);

        self::assertNotSame($first, $second);
    }

    /** @return iterable<array{string}> */
    public static function provideEmails(): iterable
    {
        yield ['user@example.com'];
        yield ['jane_admin@symfony.com'];
        yield ['very.long.email.address+tag@subdomain.example.co.uk'];
    }

    #[DataProvider('provideEmails')]
    public function testRoundtripForVariousEmails(string $email): void
    {
        $encoded = $this->type->convertToDatabaseValue($email, $this->platform);
        $decoded = $this->type->convertToPHPValue($encoded, $this->platform);

        self::assertSame($email, $decoded);
    }
}
