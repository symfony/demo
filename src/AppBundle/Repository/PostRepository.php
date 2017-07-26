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
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Pagerfanta;

/**
 * This custom Doctrine repository contains some methods which are useful when
 * querying for blog post information.
 *
 * See https://symfony.com/doc/current/book/doctrine.html#custom-repository-classes
 *
 * @author Ryan Weaver <weaverryan@gmail.com>
 * @author Javier Eguiluz <javier.eguiluz@gmail.com>
 * @author Yonel Ceruto <yonelceruto@gmail.com>
 */
class PostRepository extends EntityRepository
{
    /**
     * @param int $page
     *
     * @return Pagerfanta
     */
    public function findLatest($page = 1)
    {
        $query = $this->getEntityManager()
            ->createQuery('
                SELECT p, a, t
                FROM AppBundle:Post p
                JOIN p.author a
                LEFT JOIN p.tags t
                WHERE p.publishedAt <= :now
                ORDER BY p.publishedAt DESC
            ')
            ->setParameter('now', new \DateTime())
        ;

        return $this->createPaginator($query, $page);
    }

    private function createPaginator(Query $query, $page)
    {
        $paginator = new Pagerfanta(new DoctrineORMAdapter($query));
        $paginator->setMaxPerPage(Post::NUM_ITEMS);
        $paginator->setCurrentPage($page);

        return $paginator;
    }

    public function findBySearchQuery($rawQuery, $limit = Post::NUM_ITEMS)
    {
        $query = $this->sanitizeSearchQuery($rawQuery);
        $terms = $this->extractSearchTerms($query);

        if (empty($terms)) {
            return [];
        }

        $queryBuilder = $this->createQueryBuilder('p');

        foreach ($terms as $key => $term) {
            $queryBuilder
                ->orWhere('p.title LIKE :t_'.$key)
                ->setParameter('t_'.$key, '%'.$term.'%')
            ;
        }

        return $queryBuilder
            ->orderBy('p.publishedAt', 'DESC')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }

    private function sanitizeSearchQuery($query)
    {
        // remove all non-alphanumeric characters except whitespaces
        return preg_replace('/[^[:alnum:] ]/', '', trim(preg_replace('/[[:space:]]+/', ' ', $query)));
    }

    /**
     * Splits the query into terms and removes the ones which are too short.
     *
     * @param string $query
     *
     * @return array
     */
    private function extractSearchTerms($searchQuery)
    {
        $terms = array_unique(explode(' ', mb_strtolower($searchQuery)));

        return array_filter($terms, function ($term) {
            return 2 <= mb_strlen($term);
        });
    }
}
