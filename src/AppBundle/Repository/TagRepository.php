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

use AppBundle\Entity\Post;
use AppBundle\Entity\Tag;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;

/**
 * This custom Doctrine repository contains some methods which are useful when
 * querying tags and
 *
 * See http://symfony.com/doc/current/book/doctrine.html#custom-repository-classes
 *
 */
class TagRepository extends EntityRepository
{
    /**
     * Remove unused Tag from the Database
     */
    public function cleanUnusedTags()
    {
        $joinTable = $this->getEntityManager()->getClassMetadata(Post::class)->getAssociationMapping('tags')['joinTable']['name'];
        $tagTable = $this->getClassMetadata()->getTableName();
        $unused_tags = $this->getEntityManager()->createNativeQuery("
            DELETE FROM `$tagTable` WHERE id IN 
            (
                SELECT t.id FROM `$tagTable` t
                LEFT JOIN `$joinTable` j ON j.tag_id = t.id
                WHERE j.tag_id IS NULL
            )
        ", new ResultSetMapping())->execute();
    }
}