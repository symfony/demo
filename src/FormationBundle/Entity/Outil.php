<?php

namespace FormationBundle\Entity;

/**
 * Class Outil.
 */
class Outil extends Article
{
    /**
     * @var string
     */
    private $manuel;

    /**
     * @return string
     */
    public function getManuel()
    {
        return $this->manuel;
    }

    /**
     * @param string $manuel
     *
     * @return Outil
     */
    public function setManuel($manuel)
    {
        $this->manuel = $manuel;

        return $this;
    }

}
