<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;

/**
 * This trait allow us to add methods needed by the TimestampableEntityInterface.
 * By doing son we don't have to redefine the methods necessary for the
 * TimestampableEntityInterface interface in each entity.
 *
 * @author Romain Monteil <monteil.romain@gmail.com>
 */
trait TimestampableEntityTrait
{
    /**
     * @var \DateTimeInterface|null
     *
     * @ORM\Column(
     *     name="created_at",
     *     type="datetime",
     *     nullable=true
     * )
     */
    private $createdAt;

    /**
     * @var \DateTimeInterface|null
     *
     * @ORM\Column(
     *     name="updated_at",
     *     type="datetime",
     *     nullable=true
     * )
     */
    private $updatedAt;

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    /**
     * @ORM\PrePersist
     */
    public function setCreatedAt(): self
    {
        $this->createdAt = new \DateTime();

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function setUpdatedAt(): self
    {
        $this->updatedAt = new \DateTime();

        return $this;
    }
}
