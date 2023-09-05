<?php

namespace App\Repository;

use App\Entity\Tag;
use App\Entity\Product;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Product>
 *
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
  public function __construct(ManagerRegistry $registry)
  {
    parent::__construct($registry, Product::class);
  }

  //    /**
  //     * @return Product[] Returns an array of Product objects
  //     */
  //    public function findByExampleField($value): array
  //    {
  //        return $this->createQueryBuilder('p')
  //            ->andWhere('p.exampleField = :val')
  //            ->setParameter('val', $value)
  //            ->orderBy('p.id', 'ASC')
  //            ->setMaxResults(10)
  //            ->getQuery()
  //            ->getResult()
  //        ;
  //    }

  //    public function findOneBySomeField($value): ?Product
  //    {
  //        return $this->createQueryBuilder('p')
  //            ->andWhere('p.exampleField = :val')
  //            ->setParameter('val', $value)
  //            ->getQuery()
  //            ->getOneOrNullResult()
  //        ;
  //    }
  public function findALlProductsWithCommentsAndTags(Tag $tag = null): array
  {
    $qb = $this->createQueryBuilder('p')
      ->addSelect('c', 't')
      ->leftJoin('p.comments', 'c')
      ->leftJoin('p.tags', 't')
      ->orderBy('p.id', 'DESC');
    if ($tag) {
      $qb->andWhere('t = :tag')
        ->setParameter('tag', $tag);
    }
    return $qb->getQuery()->getResult();
  }

  // public function findProductByTag(Tag $tag): array
  // {
  //   return $this->createQueryBuilder('p')
  //     ->addSelect('t', 'c')
  //     ->leftJoin('p.tags', 't')
  //     ->leftJoin('p.comments', 'c')
  //     ->where('t = :tag')
  //     ->setParameter('tag', $tag)
  //     ->orderBy('p.id', 'DESC')
  //     ->getQuery()
  //     ->getResult();
  // }
}
