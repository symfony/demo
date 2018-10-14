<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Annotation;

use Doctrine\Common\Annotations\Reader;

/**
 * @author Romain Monteil <monteil.romain@gmail.com>
 */
class UploadableReader
{
    private $reader;

    public function __construct(Reader $reader)
    {
        $this->reader = $reader;
    }

    public function isUploadable($entity): bool
    {
        $reflection = new \ReflectionClass(\get_class($entity));

        return null !== $this->reader->getClassAnnotation($reflection, Uploadable::class);
    }

    public function getUploadableFields($entity): array
    {
        $reflection = new \ReflectionClass(\get_class($entity));

        $properties = [];
        if ($this->isUploadable($entity)) {
            foreach ($reflection->getProperties() as $property) {
                $propertyAnnotation = $this->reader->getPropertyAnnotation($property, UploadableField::class);
                if (null !== $propertyAnnotation) {
                    $properties[$property->getName()] = $propertyAnnotation;
                }
            }
        }

        return $properties;
    }
}
