<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuestionController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function homepage()
    {
        return new Response('COOOLLLOS');
    }

    /**
     * @Route("/questions/{any}")
     */
    public function show($any)
    {
        $answers = [
            'un marron',
            'Alors là...',
            'un caca',
        ];

        return $this->render('question/show.html.twig', [
            'question' => ucwords(str_replace('-', ' ',  $any)),
            'answers' => $answers
        ]);
    }
}