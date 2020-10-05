<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class QuestionController extends AbstractController
{
    /**
     * @Route("/", name="app_accueil")
     */
    public function homepage(Environment $twigEnvironment)
    {
        return $this->render('question/homepage.html.twig');

        /*
        Décorticage de la fonction render via les services Twig

        $html = $twigEnvironment->render('question/homepage.html.twig');
        return new Response($html);
        */
    }

    /**
     * @Route("/questions/{any}", name="app_question_show")
     */
    public function show($any)
    {
        $answers = [
            'un marron',
            'Alors là...',
            'un caca',
        ];


//         Retourne obligatoirement un objet Response
        return $this->render('question/show.html.twig', [
            'question' => ucwords(str_replace('-', ' ',  $any)),
            'answers' => $answers
        ]);
    }
}