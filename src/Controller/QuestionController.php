<?php


namespace App\Controller;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuestionController
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
        return new Response(sprintf(
            'Future page to show the question "%s" !',
        ucwords(str_replace('-', ' ',  $any))));
    }
}