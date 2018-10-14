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

use Doctrine\Common\Annotations\Annotation\Target;
use Doctrine\Common\Annotations\AnnotationException;

/**
 * This file defined an annotation to target a property on a class.
 *
 * @Annotation
 * @Target("PROPERTY")
 *
 * @author Romain Monteil <monteil.romain@gmail.com>
 */
class UploadableField
{
    private $filename;

    private $path;

    public function __construct(array $options)
    {
        if (!isset($options['filename'])) {
            throw new AnnotationException('Attribute "filename" is required for UploadableField annotation.');
        }

        if (!isset($options['path'])) {
            throw new AnnotationException('Attribute "path" is required for UploadableField annotation.');
        }

        $this->filename = $options['filename'];
        $this->path = $options['path'];
    }

    public function getFilename(): string
    {
        return $this->filename;
    }

    public function getPath(): string
    {
        return $this->path;
    }
}
