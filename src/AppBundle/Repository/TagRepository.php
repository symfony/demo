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

use AppBundle\Entity\Tag;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Pagerfanta;

/**
 * This custom Doctrine repository contains some methods which are useful when
 * querying for blog post information.
 *
 * See http://symfony.com/doc/current/book/doctrine.html#custom-repository-classes
 *
 * @author Ryan Weaver <weaverryan@gmail.com>
 * @author Javier Eguiluz <javier.eguiluz@gmail.com>
 * @author Yonel Ceruto <yonelceruto@gmail.com>
 */
class TagRepository extends EntityRepository
{
    /**
     * @param int $page
     *
     * @return Pagerfanta
     */
    public function cleanUnusedTags()
    {
        $unused_tags = $this->getEntityManager()
            ->createQuery('
                SELECT t.id
                FROM AppBundle:Tag t
                LEFT JOIN t.posts p
                WHERE p.id IS NULL 
            ')->getResult();
        if (!empty($unused_tags)) {
            $tag_ids = array_map(function ($tag) {
                return $tag['id'];
            }, $unused_tags);
            $this->getEntityManager()
                ->createQuery('DELETE FROM AppBundle:Tag t WHERE t.id IN (:tags)')
                ->setParameter('tags', $tag_ids)
                ->execute();
        }
    }
}
