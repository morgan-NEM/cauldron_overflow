<?php


namespace App\Controller;


use App\Entity\Question;
use App\Repository\QuestionRepository;
use App\Service\MarkdownHelper;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Sentry\State\HubInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class QuestionController extends AbstractController
{
    private $logger;
    private $isDebug;

    public function __construct(LoggerInterface $logger, bool $isDebug)
    {

        $this->logger = $logger;
        $this->isDebug = $isDebug;
    }

    /**
     * @Route("/", name="app_accueil")
     */
    public function homepage(QuestionRepository $repository)
    {
        $questions = $repository->findAllAskedOrderedByNewest();
        return $this->render('question/homepage.html.twig', [
            'questions' => $questions,
        ]);

        /*
        Décorticage de la fonction render via les services Twig

        $html = $twigEnvironment->render('question/homepage.html.twig');
        return new Response($html);
        */
    }

    /**
     * @Route ("/questions/new")
     */
    public function new(EntityManagerInterface $entityManager)
    {
        return new Response(sprintf(
            'Well hallo! The shiny new question is slug: test'));
    }

    /**
     * @Route("/questions/{slug}", name="app_question_show")
     */
    public function show(Question $question)
    {
        $answers = [
            'un marron',
            'Alors là...',
            'un `caca`',
        ];

//         Retourne obligatoirement un objet Response
        return $this->render('question/show.html.twig', [
            'question' => $question,
            'answers' => $answers
        ]);

    }

    /**
     * @Route("/questions/{slug}/vote", name="app_question_vote", methods="POST")
     */
    public function questionVote(Question $question, Request $request, EntityManagerInterface $entityManager)
    {
        $direction = $request->request->get('direction');

        if ($direction === 'up'){
            $question->upVote();
        }
        elseif ($direction === 'down'){
            $question->downVote();
        }
        $entityManager->flush();
        return $this->redirectToRoute("app_question_show", [
            'slug' => $question->getSlug(),
        ]);
    }
}