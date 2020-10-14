<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Pagination;

use Doctrine\ORM\QueryBuilder as DoctrineQueryBuilder;
use Doctrine\ORM\Tools\Pagination\CountWalker;
use Doctrine\ORM\Tools\Pagination\Paginator as DoctrinePaginator;

/**
 * @author Javier Eguiluz <javier.eguiluz@gmail.com>
 */
class Paginator
{
    /**
     * Use constants to define configuration options that rarely change instead
     * of specifying them under parameters section in config/services.yaml file.
     *
     * See https://symfony.com/doc/current/best_practices.html#use-constants-to-define-options-that-rarely-change
     */
    public const PAGE_SIZE = 3;

    private $queryBuilder;
    private $currentPage;
    private $pageSize;
    private $results;
    private $numResults;


    public function __construct(DoctrineQueryBuilder $queryBuilder, int $pageSize = self::PAGE_SIZE)
    {
        $this->queryBuilder = $queryBuilder;
        $this->pageSize = $pageSize;
    }

    public function paginate(int $page = 1): self
    {
        $this->currentPage = max(1, $page);
        $firstResult = ($this->currentPage - 1) * $this->pageSize;

        $query = $this->queryBuilder
            ->setFirstResult($firstResult)
            ->setMaxResults($this->pageSize)
            ->getQuery();

        if (0 === \count($this->queryBuilder->getDQLPart('join'))) {
            $query->setHint(CountWalker::HINT_DISTINCT, false);
        }

        $paginator = new DoctrinePaginator($query, true);

        $useOutputWalkers = \count($this->queryBuilder->getDQLPart('having') ?: []) > 0;
        $paginator->setUseOutputWalkers($useOutputWalkers);

        $this->results = $paginator->getIterator();
        $this->numResults = $paginator->count();

        return $this;
    }

    public function getPages(): array
    {
        $pages = [];
        $i = 1;
        while ($i<=$this->getLastPage()) {
            foreach ($this->getRequiredPages() as $page) {
                if ($i == $page && !in_array($page, $pages)) {
                    array_push($pages, $i);
                }
            }
            $i++;
        }
        return $pages;
    }

    public function getRequiredPages(): array
    {
        return [
            $this->getFirstPage(),
            $this->getSecondPage(),
            $this->getSecondLastPage(),
            $this->getLastPage(),
            $this->getMiddlePage(),
            $this->getLeftPage(),
            $this->getRightPage(),
            $this->getCurrentPage(),
        ];
    }

    public function getFirstPage(): int
    {
        return 1;
    }

    public function getSecondPage(): int
    {
        return 2;
    }

    public function getSecondLastPage(): int
    {
        return $this->getLastPage() - 1;
    }

    public function getMiddlePage(): int
    {
        return (int) ceil(($this->numResults / $this->pageSize) / 2);
    }

    public function getLeftPage(): int
    {
        return $this->currentPage - 1;
    }

    public function getRightPage(): int
    {
        return $this->currentPage + 1;
    }

    public function getCurrentPage(): int
    {
        return $this->currentPage;
    }

    public function getLastPage(): int
    {
        return (int)ceil($this->numResults / $this->pageSize);
    }

    public function getPageSize(): int
    {
        return $this->pageSize;
    }

    public function hasPreviousPage(): bool
    {
        return $this->currentPage > 1;
    }

    public function getPreviousPage(): int
    {
        return max(1, $this->currentPage - 1);
    }

    public function hasNextPage(): bool
    {
        return $this->currentPage < $this->getLastPage();
    }

    public function getNextPage(): int
    {
        return min($this->getLastPage(), $this->currentPage + 1);
    }

    public function hasToPaginate(): bool
    {
        return $this->numResults > $this->pageSize;
    }

    public function getNumResults(): int
    {
        return $this->numResults;
    }

    public function getResults(): \Traversable
    {
        return $this->results;
    }

}
