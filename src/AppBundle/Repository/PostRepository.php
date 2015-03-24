<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use AppBundle\Entity\Post;

/**
 * This custom Doctrine repository contains some methods which are useful when
 * querying for blog post information.
 * See http://symfony.com/doc/current/book/doctrine.html#custom-repository-classes
 *
 * @author Ryan Weaver <weaverryan@gmail.com>
 * @author Javier Eguiluz <javier.eguiluz@gmail.com>
 */
class PostRepository extends EntityRepository
{
    public function findLatest($limit = Post::NUM_ITEMS)
    {
        return $this
            ->createQueryBuilder('p')
            ->select('p')
            ->where('p.publishedAt <= :now')->setParameter('now', new \DateTime())
            ->orderBy('p.publishedAt', 'DESC')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult()
        ;
    }
}
