<?php

namespace App\Repository;

use App\Entity\Category;
use App\Entity\Media;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Media>
 */
class MediaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Media::class);
    }

    /** @return Media[] */
    public function findByCategoryWithPagination(Category $category, int $currentPage, int $maxPerPage): array
    {
        // categories ManyToMany relation
        return $this->createQueryBuilder('c')
            ->join('c.categories', 'cat')
            ->where('cat = :category')
            ->setParameter('category', $category)
            ->orderBy('c.id', 'ASC')
            ->setFirstResult(($currentPage - 1) * $maxPerPage)
            ->setMaxResults($maxPerPage)
            ->getQuery()
            ->getResult();

    }
}
