<?php

namespace App\Repository;

use App\Entity\Author;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Author|null find($id, $lockMode = null, $lockVersion = null)
 * @method Author|null findOneBy(array $criteria, array $orderBy = null)
 * @method Author[]    findAll()
 * @method Author[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AuthorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Author::class);
    }

    public function getAllAuthorsWithBooks(){
        $dq = $this->createQueryBuilder('a')
                ->select('a.id, a.name, a.firstName, count(b.id) as nbBooks')
                ->innerJoin('a.books', 'b')
                ->groupBy('a.id');

        return $dq->getQuery();
    }

    public function getAuthorPublishers(){
        $dq = $this->createQueryBuilder('a')
                ->select('a.publisher')
                ->where("a");

        return $dq->getQuery();

    }

    public function getPublishersByAuthor(Author $author){
        $qb = $this->createQueryBuilder('a')
                ->innerJoin('a.books', 'b')
                ->innerJoin('b.publisher', 'p')
                ->select('p.name, p.id, count(b.id) as nbBooks')
                ->where('a.id=:authorId')
                ->groupBy('p.id')
                ->setParameter('authorId', $author->getId());

        return $qb->getQuery();
    }

    // /**
    //  * @return Author[] Returns an array of Author objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Author
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
