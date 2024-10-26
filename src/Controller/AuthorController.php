<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Author;
use App\Repository\AuthorRepository;
use App\Form\AuthorType;
use Symfony\Component\HttpFoundation\Request;

class AuthorController extends AbstractController
{
   
    
   
        #[Route('/author/add', name: 'app_addAuthor')]
        public function addAuthor(ManagerRegistry $manager, Request $req)
        {
            $em= $manager->getManager();
    
            $author= new   Author();
            $form = $this ->createForm(AuthorType::class, $author);
            $form->handleRequest($req);

            if($form->isSubmitted())
            {
                $em->persist($author);
                $em->flush();
                return $this->redirectToRoute('app_getallAuthors');
            }
 
            return $this->render('author/formAuthor.html.twig',[

                'f'=>$form->createView()

            ]);

            //$author1= new   Author();
            // $author1 -> setusername('Rina Kent');
            // $author1 -> setemail('RinaKent@esprit.com');
            //$em-> persist($author1);
            //$em-> flush();
    
            // $author2= new Author();
            // $author2 -> setusername('Collen Hover');
            // $author2 -> setemail('Collen@esprit.com');
            // $em-> persist($author2);
    
            // $author3= new Author();
            // $author3 -> setusername('Cora Rilley');
            // $author3 -> setemail('CoraR@esprit.com');
            // $em-> persist($author3);
    
            //return new Response('Author added',200);
        
           
        }
    
        #[Route('/Author/getall', name: 'app_getallAuthors')]
        public function getallAuthor(AuthorRepository $repository)
        {
            $authors= $repository-> findAll();
            return $this->render('author/index.html.twig', [
                'authors' => $authors 
            ]);  
        }
    
        
    
        // #[Route('/author/update/{id}', name: 'app_updateAuthor')]
        // public function updateAthor (ManagerRegistry $manager, AuthorRepository $repository, $id) {
        //     $em= $manager->getManager();
    
        //     $author1 = $repository -> find($id);
        //     $author1 -> setusername('zeynoubette');
        //     $em -> flush();
    
        //     return new Response ('Author updated');
        // }
    

        #[Route('/author/update/{id}',name:'pp_updateAuthor')]

        public function updateAuthor(Request $req,ManagerRegistry $manager,Author $author

        ,AuthorRepository $repo){
            $em= $manager->getManager();
          //$author = $repo->find($id);

          $form = $this->createForm(AuthorType::class,$author);

          $form->handleRequest($req);

          if($form->isSubmitted())

          {

          $em->flush();

          return $this->redirectToRoute('app_getallAuthors');

          }

          // $author->setName("author 1");

          //$author->setEmail("author1@gmail.com");

      

          return $this->render('author/formAuthor.html.twig',[

            'f'=>$form->createView()

          ]);

        }


    
        #[Route('/author/delete/{id}', name: 'app_deleteAuthor')]
        public function deleteAuthor (ManagerRegistry $manager, AuthorRepository $repository, $id) {
            $em= $manager->getManager();
           
            $author1 = $repository -> find($id);
            $em -> remove($author1);
    
            $em -> flush();
    
            return $this-> redirectToRoute('app_getallAuthors'); 
        }
    
    
    
    
    
    
    
    
    
}
