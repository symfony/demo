<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\EventSubscriber;

use App\Annotation\UploadableReader;
use App\Utils\FileUploader;
use Doctrine\Common\EventSubscriber;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;

/**
 * Class UploadSubscriber.
 *
 * @author Romain Monteil <monteil.romain@gmail.com>
 */
class UploadSubscriber implements EventSubscriber
{
    private $reader;

    private $uploader;

    public function __construct(UploadableReader $reader, FileUploader $uploader)
    {
        $this->reader = $reader;
        $this->uploader = $uploader;
    }

    /**
     * Returns an array of events this subscriber wants to listen to.
     *
     * @return string[]
     */
    public function getSubscribedEvents(): array
    {
        return [
            'prePersist',
            'preUpdate',
            'postLoad',
            'postRemove',
        ];
    }

    public function prePersist(LifecycleEventArgs $args): void
    {
        $this->preEvent($args);
    }

    public function preUpdate(LifecycleEventArgs $args): void
    {
        $this->preEvent($args);
    }

    public function postLoad(LifecycleEventArgs $args): void
    {
        $entity = $args->getObject();
        foreach ($this->reader->getUploadableFields($entity) as $property => $annotation) {
            $this->uploader->setFileFromFilename($entity, $property, $annotation);
        }
    }

    public function postRemove(LifecycleEventArgs $args): void
    {
        $entity = $args->getObject();
        foreach ($this->reader->getUploadableFields($entity) as $property => $annotation) {
            $this->uploader->removeFile($entity, $annotation);
        }
    }

    private function preEvent(LifecycleEventArgs $args): void
    {
        $entity = $args->getObject();
        foreach ($this->reader->getUploadableFields($entity) as $property => $annotation) {
            $this->uploader->uploadFile($entity, $property, $annotation);
        }
    }
}
