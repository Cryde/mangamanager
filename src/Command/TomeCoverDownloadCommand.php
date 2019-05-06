<?php

namespace App\Command;

use App\Entity\Tome;
use App\Repository\TomeRepository;
use App\Service\TomeCoverImageDownloader;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class TomeCoverDownloadCommand extends Command
{
    protected static $defaultName = 'app:tome:cover:download';
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var TomeRepository
     */
    private $tomeRepository;
    /**
     * @var TomeCoverImageDownloader
     */
    private $tomeCoverImageDownloader;

    public function __construct(
        TomeRepository $tomeRepository,
        TomeCoverImageDownloader $tomeCoverImageDownloader,
        EntityManagerInterface $entityManager
    ) {
        parent::__construct(self::$defaultName);
        $this->entityManager = $entityManager;
        $this->tomeRepository = $tomeRepository;
        $this->tomeCoverImageDownloader = $tomeCoverImageDownloader;
    }

    protected function configure()
    {
        $this->setDescription('Download all the tome covers that doesn\'t have been downloaded yet');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $tomes = $this->tomeRepository->findBy(['coverPath' => null]);
        foreach ($tomes as $tome) {
            $this->processTome($tome);
        }
    }

    protected function processTome(Tome $tome)
    {
        if ($coverUrl = $tome->getCoverUrl()) {
            try {
                $file = $this->tomeCoverImageDownloader->download($tome->getCoverUrl());
                $tome->setCoverPath($file->getFilename());
                $this->entityManager->flush();
                sleep(2);
            } catch (\Exception $e) {
                // todo alert
            }
        }
    }
}
