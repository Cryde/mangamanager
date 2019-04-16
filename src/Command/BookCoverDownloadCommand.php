<?php

namespace App\Command;

use App\Entity\Book;
use App\Repository\BookRepository;
use App\Service\BookCoverImageDownloader;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class BookCoverDownloadCommand extends Command
{
    protected static $defaultName = 'app:book:cover:download';
    /**
     * @var BookRepository
     */
    private $bookRepository;
    /**
     * @var BookCoverImageDownloader
     */
    private $bookCoverImageDownloader;
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(
        BookRepository $bookRepository,
        BookCoverImageDownloader $bookCoverImageDownloader,
        EntityManagerInterface $entityManager
    ) {
        parent::__construct(self::$defaultName);
        $this->bookRepository = $bookRepository;
        $this->bookCoverImageDownloader = $bookCoverImageDownloader;
        $this->entityManager = $entityManager;
    }

    protected function configure()
    {
        $this->setDescription('Download all the covers that doesn\'t have been downloaded yet');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $books = $this->bookRepository->findBy(['coverPath' => null]);
        foreach ($books as $book) {
            $this->processBook($book);
        }
    }

    protected function processBook(Book $book)
    {
        if ($coverUrl = $book->getCoverUrl()) {
            try {
                $file = $this->bookCoverImageDownloader->download($book->getCoverUrl());
                $book->setCoverPath($file->getFilename());
                $this->entityManager->flush();
            } catch (\Exception $e) {
                // todo alert
            }
        }
    }
}
