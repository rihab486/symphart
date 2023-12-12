<?php
namespace App\Controller ;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\VarDumper\Cloner\AbstractCloner;

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
}