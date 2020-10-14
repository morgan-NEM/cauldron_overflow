<?php


namespace App\Controller;


use Knp\Bundle\MarkdownBundle\MarkdownParserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Cache\CacheInterface;
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
    public function show($any, MarkdownParserInterface $markdownParser, CacheInterface $cache)
    {
        $answers = [
            'un marron',
            'Alors là...',
            'un `caca`',
        ];


        $questionText = "Qu'est-ce *qui* est **petit** et **marron**?";
        $parsedQuestionTest = $cache->get('markdown_'.md5($questionText), function () use ($questionText, $markdownParser
        ){
            return $markdownParser->transformMarkdown($questionText);
        });

        dump($cache);

//         Retourne obligatoirement un objet Response
        return $this->render('question/show.html.twig', [
            'question' => ucwords(str_replace('-', ' ',  $any)),
            'questionText' => $parsedQuestionTest,
            'answers' => $answers
        ]);

    }
}