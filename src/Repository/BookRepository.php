<?php

namespace App\Repository;

use App\Entity\Book;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Book>
 */
class BookRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Book::class);
    }

//    /**
//     * @return Book[] Returns an array of Book objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('b.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Book
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }


public function getBooksByDate ($dateDebut , $dateFin ){
    // 1. Accéder à l'EntityManager
        $em = $this->getEntityManager();
    // 2. Créer une Requête DQL avec createQuery
    $query= $em->createQuery('SELECT b FROM App\Entity\Book b WHERE b.publicationDate >= :date1 and b.publicationDate <= :date2 ');
    $query->setParameter('date1', $dateDebut);
    $query->setParameter('date2', $dateFin);
    $results = $query->getResult(); return $results; }

}

