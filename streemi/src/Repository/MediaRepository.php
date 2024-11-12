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

    /**
     * @return Media[] Returns an array of Media objects
     */
    public function findTrendingMedias(int $maximumElements = 9, Category $category = null): array
    {
        $query = $this->createQueryBuilder('m')
            ->setMaxResults($maximumElements)
            // find trending medias (criteria : mostly added to playlists)
            ->innerJoin('m.playlistMedia', 'p')
            ->groupBy('m.id')
            ->orderBy('COUNT(p.id)', 'DESC')
        ;

//        if ($category) {
//            $query->join('m.categories', 'c')
//                ->andWhere('c.id = :category')
//                ->setParameter('category', $category->getId());
//        }

        return $query->getQuery()
            ->getResult();
    }

//    public function findOneBySomeField($value): ?Media
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
