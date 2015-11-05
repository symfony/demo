<?php

namespace FormationBundle\Entity\Behavior;

/**
 * Class VendableTrait.
 */
trait VendableTrait
{
    /**
     * @var float
     */
    private $priceHT;

    /**
     * @return float
     */
    public function getPriceHT()
    {
        return $this->priceHT;
    }
}
