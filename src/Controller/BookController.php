<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Book;
use App\Repository\BookRepository;
use App\Repository\AuthorRepository;
use App\Form\BookType;
use App\Form\RechercheType;
use Symfony\Component\HttpFoundation\Request;

class BookController extends AbstractController
{
   
    // #[Route('/book/add', name: 'app_add/Book')]
    // public function addBook (ManagerRegistry $manager, AuthorRepository $repository)
    // {
    //     $em= $manager->getManager();

    //     $Book1= new   Book();
    //     $Book1 -> settitle('God of Malice');
    //     $Book1 -> setPublicationDate(new \DateTime());
    //     $Book1 -> setenabled(true);

    //     $author = $repository -> find(7);
    //     $Book1 -> setauthor($author);

    //     $em-> persist($Book1);

    //     $Book2= new Book();
    //     $Book2 -> settitle('November 9');
    //     $Book2 -> setPublicationDate(new \DateTime());
    //     $Book2 -> setenabled(true);

    //     $author2 = $repository -> find(8);
    //     $Book2 -> setauthor($author2);

    //     $em-> persist($Book2);

    //     $Book3= new Book();
    //     $Book3 -> settitle('Bounded by Honer');
    //     $Book3 -> setPublicationDate( new \DateTime());
    //     $Book3 -> setenabled(true);

    //     $author3 = $repository -> find(9);
    //     $Book3 -> setauthor($author3);

    //     $em-> persist($Book3);

    //     $em-> flush();
    
    //     return new Response('Book added',200);
    // }

    #[Route('/Book/getall', name: 'app_getallBooks')]
    public function getallBook(BookRepository $repository)
    {
        $Books= $repository-> findAll();
        return $this->render('Book/index.html.twig', [
            'Books' => $Books 
        ]);  
    }

    

    // #[Route('/Book/update/{id}', name: 'app_updateBook')]
    // public function updateBook (ManagerRegistry $manager, BookRepository $repository, $id) {
    //     $em= $manager->getManager();

    //     $Book1 = $repository -> find($id);
    //     $Book1 -> settitle('zeynoubette');
    //     $em -> flush();

    //     return new Response ('Book updated');
    // }


    #[Route('/Book/delete/{id}', name: 'app_deleteBook')]
    public function deleteAuthor (ManagerRegistry $manager, BookRepository $repository, $id) {
        $em= $manager->getManager();
       
        $Book1 = $repository -> find($id);
        $em -> remove($Book1);

        $em -> flush();

        return $this-> redirectToRoute('app_getallBooks'); 
    }


    #[Route('/book/add', name: 'app_addbook')]
    public function addbook(ManagerRegistry $manager, Request $req)
    {
        $em= $manager->getManager();

        $book= new   book();
        $form = $this ->createForm(BookType::class, $book);
        $form->handleRequest($req);

        if($form->isSubmitted())
        {
            $em->persist($book);
            $em->flush();
            return $this->redirectToRoute('app_getallBooks');
        }

        return $this->render('book/formbook.html.twig',[

            'b'=>$form->createView()

        ]);

       
    }

    #[Route('/book/update/{id}',name:'app_updateBook')]

    public function updatebook(Request $req,ManagerRegistry $manager,Book $book

    ,AuthorRepository $repo){
        $em= $manager->getManager();

      $form = $this->createForm(BookType::class,$book);

      $form->handleRequest($req);

      if($form->isSubmitted())

      {

      $em->flush();

      return $this->redirectToRoute('app_getallBooks');

      }


      return $this->render('book/formbook.html.twig',[

        'b'=>$form->createView()

      ]);

    }

    #[Route('/BooksByDate', name: 'BooksBydate')]
    public function getBookByDate(BookRepository $repository,Request $req)
    {
        $form = $this->createForm(RechercheType::class);
        $form->handleRequest($req);
        
        if ($form->isSubmitted()) {
            $data = $form->getData();
            $startDate = $data['start_date'];
            $endDate = $data['end_date'];
    
            
            $Books = $repository->getBooksByDate($startDate, $endDate);
            return $this->render('book/recherche.html.twig', [
                'f' => $form->createView(),
                'books' => $Books,
            ]);
        }

        $Books= $repository-> findAll();
        return $this->render('book/recherche.html.twig',[

            'f'=>$form->createView(),'books' => $Books 
      
        ]);
    }



}
