<?php

namespace FormationBundle\Entity;

use FormationBundle\Entity\Behavior\VendableTrait;
use FormationBundle\Model\AbstractArticle;
use FormationBundle\Model\PerissableInterface;

/**
 * Class Article.
 */
class Article extends AbstractArticle
{
    use VendableTrait

    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $reference;

    /**
     * @var array
     */
    private $fournisseurs;

    /**
     * Article constructor.
     */
    public function __construct()
    {
        $this->fournisseurs = array();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     *
     * @return Article
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * @param string $reference
     *
     * @return Article
     */
    public function setReference($reference)
    {
        $this->reference = $reference;

        return $this;
    }

    /**
     * @return array
     */
    public function getFournisseurs()
    {
        return $this->fournisseurs;
    }

    /**
     * @param Fournisseur $fournisseur
     */
    public function addFournisseur(Fournisseur $fournisseur)
    {
        $this->fournisseurs[] = $fournisseur;
    }

    /**
     * @return bool
     */
    public function isPerissable()
    {
        return $this instanceof PerissableInterface;
    }
}
