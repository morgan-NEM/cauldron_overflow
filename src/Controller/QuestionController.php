<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuestionController extends AbstractController
{
    /**
     * @Route("/", name="app_accueil")
     */
    public function homepage()
    {
        return $this->render('question/homepage.html.twig');
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

        dump($answers);

//         Retourne obligatoirement un objet Response
        return $this->render('question/show.html.twig', [
            'question' => ucwords(str_replace('-', ' ',  $any)),
            'answers' => $answers
        ]);
    }
}