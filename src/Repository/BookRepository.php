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
        $results = $query->getResult(); return $results; 
    }


    public function searchBookByRef ($id){
        $qb = $this->createQueryBuilder('b')
            ->andWhere('b.id = :ref')
            ->setParameter('ref', $id)
            ;
        return $qb->getQuery()->getResult();

    }


    public function booksListByAuthors ()
    {
        $qb = $this->createQueryBuilder('b')
                   ->innerJoin('b.author','a')
                   ->orderBy('a.username', 'ASC');

        return $qb->getQuery()->getResult();
    }



    public function listeBookByNbBook (){
        $qb = $this->createQueryBuilder('b')
            ->andWhere('b.publicationDate <= :date')
            ->setParameter('date', '2023-01-01')
            ->innerJoin('b.author','a')
            ->andWhere('a.nb_book > 10')
            
            
            ;
        return $qb->getQuery()->getResult();

    }


    public function updatebookcategory(){
        $qb = $this->createQueryBuilder('b')
            ->update()
            ->set('b.category', ':newCategory')
            ->where('b.category = :oldCategory')
            ->setParameter('newCategory', 'Romance')
            ->setParameter('oldCategory', 'Science-Fiction');
            return $qb->getQuery()->execute();

    }

}