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

    public function findPopular(int $limit)
    {
        return $this->createQueryBuilder('m')
            ->select('m, COUNT(p) as HIDDEN count')
            ->leftJoin('m.playlistMedia', 'p')
            ->groupBy('m')
            ->orderBy('count', 'DESC')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }

    public function findMediasByCategory(Category $currentCategory, int $limit = 10)
    {
        return $this->createQueryBuilder('m')
            ->select('m')
            ->leftJoin('m.categories', 'c')
            ->where('c.id = :id')
            ->setParameter('id', $currentCategory->getId())
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }
}
