<?php

namespace App\Service;

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

abstract class ImageDownloader
{
    /**
     * @var string
     */
    protected $path;
    /**
     * @var Filesystem
     */
    private $filesystem;

    /**
     * ImageDownloader constructor.
     *
     * @param string     $path
     * @param Filesystem $filesystem
     */
    public function __construct(string $path, Filesystem $filesystem)
    {
        $this->path = $path;
        $this->filesystem = $filesystem;
    }

    /**
     * @param $path
     *
     * @return UploadedFile
     * @throws CorruptedFileException|\Exception
     */
    public function download($path)
    {
        $tmpFilePath = $this->path . sha1(uniqid('file', true));
        $this->filesystem->dumpFile($tmpFilePath, null);

        if ($tmpFilePath === false) {
            throw new \Exception('can not create tmp file for download: ' . $path);
        }

        try {
            $this->filesystem->copy($path, $tmpFilePath);
        } catch (\Exception $e) {
            $this->filesystem->remove($tmpFilePath);
            throw $e;
        }

        $newFilename = $tmpFilePath . '.' . (new File($tmpFilePath))->guessExtension();
        $this->filesystem->rename($tmpFilePath, $newFilename);
        $tmpFilePath = $newFilename;

        if (md5_file($path) !== md5_file($tmpFilePath)) {
            $this->filesystem->remove($tmpFilePath);
            throw new CorruptedFileException(sprintf('file corrupted after download: %s', $tmpFilePath));
        }

        return new UploadedFile($tmpFilePath, $path);
    }
}
