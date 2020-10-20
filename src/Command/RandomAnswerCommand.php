<?php

namespace App\Command;

use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class RandomAnswerCommand extends Command
{
    protected static $defaultName = 'app:random-answer';
    private $logger;

    public function __construct(LoggerInterface $logger)
    {

        $this->logger = $logger;
        parent::__construct();
    }
    protected function configure()
    {
        $this
            ->setDescription('Donne une réponse au hasard')
            ->addArgument('your-name', InputArgument::OPTIONAL, 'Your name')
            ->addOption('yell', null, InputOption::VALUE_NONE, 'Yell?')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $yourName = $input->getArgument('your-name');

        if ($yourName) {
            $io->note(sprintf('Salut: %s', $yourName));
        }

        $answers = [
            'Aucune idée',
            'un caca',
            'un chocolat',
            'une truc recyclé'
        ];
        $answer = $answers[array_rand($answers)];

        if ($input->getOption('yell')) {
            $answer = strtoupper($answer);
        }
        $this->logger->info($answer);
        $io->success($answer);

        return Command::SUCCESS;
    }
}
