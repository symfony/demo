<?php

namespace FormationBundle\Entity\Behavior;

/**
 * Trait PerissableTrait.
 */
trait PerissableTrait
{
    /**
     * @var \Datetime
     */
    private $dateLimite;

    /**
     * @return \Datetime
     */
    public function getDateLimite()
    {
        return $this->dateLimite;
    }
}
