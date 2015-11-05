<?php

namespace FormationBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use FormationBundle\Entity\Behavior\VendableTrait;
use FormationBundle\Model\AbstractArticle;
use FormationBundle\Model\PerissableInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="FormationBundle\Repository\ArticleRepository")
 *
 * Class Article.
 */
class Article extends AbstractArticle
{
    use VendableTrait;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     *
     * @var int
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     *
     * @var string
     */
    private $reference;

    /**
     * @ORM\ManyToMany(targetEntity="Fournisseur")
     * @ORM\JoinTable(
     *   name="article_fournisseurs",
     *   joinColumns={@ORM\JoinColumn(name="article_id", referencedColumnName="id")},
     *   inverseJoinColumns={@ORM\JoinColumn(name="fournisseur_id", referencedColumnName="id")}
     * )
     *
     * @var ArrayCollection
     */
    private $fournisseurs;

    /**
     * Article constructor.
     */
    public function __construct()
    {
        $this->fournisseurs = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
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
