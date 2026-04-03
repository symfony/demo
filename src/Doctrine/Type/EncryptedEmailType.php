<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Doctrine\Type;

use Doctrine\Bundle\DoctrineBundle\Attribute\AsDatabaseType;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;
use Symfony\Component\DependencyInjection\Attribute\Autowire;

#[AsDatabaseType(name: EncryptedEmailType::NAME)]
final class EncryptedEmailType extends Type
{
    public const string NAME = 'encrypted_email';

    private string $key;

    public function __construct(
        #[Autowire(env: 'APP_EMAIL_ENCRYPTION_KEY')]
        string $emailEncryptionKey,
    ) {
        $this->key = hex2bin($emailEncryptionKey);
    }

    public function getSQLDeclaration(array $column, AbstractPlatform $platform): string
    {
        $column['length'] ??= 255;

        return $platform->getStringTypeDeclarationSQL($column);
    }

    public function convertToDatabaseValue(mixed $value, AbstractPlatform $platform): ?string
    {
        if (null === $value) {
            return null;
        }

        $nonce = substr(hash_hmac('sha256', $value, $this->key, true), 0, 12);
        $tag = '';
        $ciphertext = openssl_encrypt($value, 'aes-256-gcm', $this->key, OPENSSL_RAW_DATA, $nonce, $tag, '', 16);

        return base64_encode($nonce.$tag.$ciphertext);
    }

    public function convertToPHPValue(mixed $value, AbstractPlatform $platform): ?string
    {
        if (null === $value) {
            return null;
        }

        $raw = base64_decode($value, true);
        if (false === $raw || \strlen($raw) < 28) {
            return null;
        }

        $nonce = substr($raw, 0, 12);
        $tag = substr($raw, 12, 16);
        $ciphertext = substr($raw, 28);

        $plaintext = openssl_decrypt($ciphertext, 'aes-256-gcm', $this->key, OPENSSL_RAW_DATA, $nonce, $tag);

        return false !== $plaintext ? $plaintext : null;
    }
}
