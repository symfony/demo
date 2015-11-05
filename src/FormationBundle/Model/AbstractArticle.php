<?php

namespace FormationBundle\Model;

/**
 * Class AbstractArticle.
 */
abstract class AbstractArticle implements ArticleInterface
{
    const TVA = 20;

    /**
     * @return float
     */
    public function getPriceTTC()
    {
        return $this->getPriceHT() * (1 + (self::TVA / 100));
    }
}
