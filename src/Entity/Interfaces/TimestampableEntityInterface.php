<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Entity\Interfaces;

/**
 * This interface allow us to mark an Entity as Timestampable.
 *
 * @author Romain Monteil <monteil.romain@gmail.com>
 */
interface TimestampableEntityInterface
{
    public function getCreatedAt(): ?\DateTimeInterface;

    public function setCreatedAt();

    public function getUpdatedAt(): ?\DateTimeInterface;

    public function setUpdatedAt();
}
