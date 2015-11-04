<?php

namespace FormationBundle\Entity;

use FormationBundle\Entity\Behavior\PerissableTrait;
use FormationBundle\Model\PerissableInterface;

/**
 * Class Aliment.
 */
class Aliment extends Article implements PerissableInterface
{
    use PerissableTrait

    /**
     * @var string
     */
    private $origine;

    /**
     * @return string
     */
    public function getOrigine()
    {
        return $this->origine;
    }

    /**
     * @param string $origine
     *
     * @return $this
     */
    public function setOrigine($origine)
    {
        $this->origine = $origine;

        return $this;
    }
}
