<?php

namespace App\Doctrine\Type;

use Doctrine\Bundle\DoctrineBundle\Attribute\AsDatabaseType;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

#[AsDatabaseType(name: Base64EmailType::NAME)]
final class Base64EmailType extends Type
{
    public const string NAME = 'base64_email';

    public function getSQLDeclaration(array $column, AbstractPlatform $platform): string
    {
        $column['length'] ??= 255;

        return $platform->getStringTypeDeclarationSQL($column);
    }

    public function convertToDatabaseValue(mixed $value, AbstractPlatform $platform): ?string
    {
        if ($value === null) {
            return null;
        }

        return base64_encode($value);
    }

    public function convertToPHPValue(mixed $value, AbstractPlatform $platform): ?string
    {
        if ($value === null) {
            return null;
        }

        return base64_decode($value) ?: null;
    }
}
