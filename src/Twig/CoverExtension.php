<?php

namespace App\Twig;

use App\Entity\Book;
use App\Service\CoverPublicPathConverter;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class CoverExtension extends AbstractExtension
{
    /**
     * @var CoverPublicPathConverter
     */
    private $coverPublicPathConverter;

    public function __construct(CoverPublicPathConverter $coverPublicPathConverter)
    {
        $this->coverPublicPathConverter = $coverPublicPathConverter;
    }

    public function getFilters(): array
    {
        return [
            new TwigFilter('cover_public_path', [$this, 'getCoverPath']),
        ];
    }

    public function getCoverPath($value)
    {
        if ($value instanceof Book) {
            return $this->coverPublicPathConverter->getCoverPathFromBook($value);
        }

        throw new \InvalidArgumentException('Object not supported');
    }
}
