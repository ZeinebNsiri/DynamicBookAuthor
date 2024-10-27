<?php

namespace App\Repository;

use App\Entity\Author;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Author>
 */
class AuthorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Author::class);
    }

//    /**
//     * @return Author[] Returns an array of Author objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Author
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

//DQL

public function getAuthorsOrderByName(){
    $em = $this->getEntityManager();
    $query= $em->createQuery('SELECT a FROM App\Entity\Author a ORDER BY a.username ASC');
    $results = $query->getResult(); return $results;
}

public function getAuthorsByName($name){
    $em = $this->getEntityManager();
    $query= $em->createQuery('SELECT a FROM App\Entity\Author a WHERE a.email =:em ASC');
    $query->setParameter('em', $name);
    $results = $query->getResult(); 
    return $results;
}





public function getAuthorssOrderByName(){
    $req = $this-> createQueryBuilder('p')
                -> orderBy('a.username', 'ASC')
                -> getQuery()
                ->getResult();
}


//atelier queryBuilder 1)
public function getAuthorByEmail()
{
    $qb = $this->createQueryBuilder('a')
               ->orderBy('a.email', 'ASC');
    return $qb->getQuery()->getResult();
}




}

