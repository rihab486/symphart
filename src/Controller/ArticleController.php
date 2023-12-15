<?php
namespace App\Controller ;

use App\Entity\Article;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;



class ArticleController extends AbstractController {
    /**
     * @Route("/")
     * @Method({"GET"})
     */

    public function  index(EntityManagerInterface $entityManager) :Response {
       // return new Response('<html><body>Hello Rihab with your first step of symfony v6 </body></html>');
        // $articles = $this->getDoctrine()->getRepository(Article::class) ->findAll();
        $articleRepository = $entityManager->getRepository(Article::class);
        $articles = $articleRepository->findAll();

        return $this ->render('articles/index.html.twig',
         array('articles' => $articles));
    }

     /**
      * @Route("/article/new")
      * @Method({"GET"} ,  {"POST"})
      */

      public function new(Request $request, EntityManagerInterface $entityManager): Response
      {
          $article = new Article();
      
          // Create the form using createFormBuilder
          $form = $this->createFormBuilder($article)
              ->add('title', TextType::class, [
                  'attr' => ['class' => 'form-control'],
              ])
              ->add('body', TextareaType::class, [
                  'required' => false,
                  'attr' => ['class' => 'form-control'],
              ])
              ->add('save', SubmitType::class, [
                  'label' => 'Create',
                  'attr' => ['class' => 'btn btn-primary mt-3'],
              ])
              ->getForm();
      
          // Handle form submission
          $form->handleRequest($request);
      
          if ($form->isSubmitted() && $form->isValid()) {
              // Persist the article to the database, e.g., using Doctrine
              $entityManager->persist($article);
              $entityManager->flush();
      
              // Redirect to a success page or do something else
              return $this->redirectToRoute('success_route');
          }
      
          // Render the form in your template
          return $this->render('articles/new.html.twig', [
              'form' => $form->createView(),
          ]);
      }
      
 

        /**
     * @Route("/article/save")
     */
    public function save(EntityManagerInterface $entityManager): Response
    {
        $article = new Article();
        $article->setTitle('it web');
        $article->setBody('body of article');

        $entityManager->persist($article);
        $entityManager->flush();

        return new Response('Saved new product with id ' . $article->getId());
    }

       /**
     * @Route("article/{id}")
     */

     public function show($id ,EntityManagerInterface $entityManager) :Response  {
      
        $articleRepository = $entityManager->getRepository(Article::class);
        $article = $articleRepository->find($id);

        return $this->render('articles/show.html.twig', ['article' => $article]);      
    }
}