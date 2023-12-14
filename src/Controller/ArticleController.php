<?php
namespace App\Controller ;

use App\Entity\Article;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;




class ArticleController extends AbstractController {
    /**
     * @Route("/")
     * @Method({"GET"})
     */

    public function  index() {
       // return new Response('<html><body>Hello Rihab with your first step of symfony v6 </body></html>');
        $articles = ['article 1' , 'article2' , 'article3'];

        return $this ->render('articles/index.html.twig', array('articles' => $articles));
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
}