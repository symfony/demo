<?php

namespace FormationBundle\Entity;

use FormationBundle\Entity\Behavior\PerissableTrait;
use FormationBundle\Model\PerissableInterface;

/**
 * Class Fleur.
 */
class Fleur extends Article implements PerissableInterface
{
    use PerissableTrait;

    /**
     * @var string
     */
    private $nomLatin;

    /**
     * @return string
     */
    public function getNomLatin()
    {
        return $this->nomLatin;
    }

    /**
     * @param string $nomLatin
     */
    public function setNomLatin($nomLatin)
    {
        $this->nomLatin = $nomLatin;
    }
}
