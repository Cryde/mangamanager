<?php

namespace App\Command;

use App\Repository\BookRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class BookTomeCountCommand extends Command
{
    protected static $defaultName = 'app:book:tome:count';
    /**
     * @var BookRepository
     */
    private $bookRepository;
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(BookRepository $bookRepository, EntityManagerInterface $entityManager)
    {
        parent::__construct(self::$defaultName);
        $this->bookRepository = $bookRepository;
        $this->entityManager = $entityManager;
    }

    protected function configure()
    {
        $this
            ->setDescription('Count and cache the tome number by book');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);

        $books = $this->bookRepository->findAll();

        foreach ($books as $book) {
            $count = count($book->getTomes());
            $book->setTomeNumber($count);

            $this->entityManager->flush();
        }

        $io->success('All tome number have been set !');
    }
}
