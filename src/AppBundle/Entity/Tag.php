<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="symfony_demo_tag")
 *
 * Defines the properties of the Tag entity to represent the post tags.
 *
 * See http://symfony.com/doc/current/book/doctrine.html#creating-an-entity-class
 *
 * @author Yonel Ceruto <yonelceruto@gmail.com>
 */
class Tag implements \JsonSerializable
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", unique=true)
     */
    private $name;

    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        // This method is called when a Tag instance needs be serialized to JSON
        // See usage in app/Resources/views/form/fields.html.twig: tags|json_encode

        return $this->name;
    }

    public function __toString()
    {
        return $this->name;
    }
}
