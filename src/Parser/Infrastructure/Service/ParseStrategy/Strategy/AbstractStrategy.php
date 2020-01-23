<?php

namespace App\Parser\Infrastructure\Service\ParseStrategy\Strategy;

use App\Parser\Domain\DTO\ParseParamsDTO;
use App\Parser\Library\FileGetContents\FileGetContentsInterface;

/**
 * Class AbstractStrategy
 * @package App\Parser\Infrastructure\Service\ParseStrategy\Strategy
 */
abstract class AbstractStrategy
{
    /**
     * @var FileGetContentsInterface
     */
    private FileGetContentsInterface $fileGetContents;

    /**
     * AbstractStrategy constructor.
     * @param FileGetContentsInterface $fileGetContents
     */
    public function __construct(FileGetContentsInterface $fileGetContents)
    {
        $this->fileGetContents = $fileGetContents;
    }

    /**
     * @param ParseParamsDTO $dto
     * @param int $currentPage
     * @return string
     */
    protected function getParsedUrl(ParseParamsDTO $dto, int $currentPage): string
    {
        return $dto->getUrl() . $dto->getTopic() . $dto->getPageParam() . $currentPage;
    }

    /**
     * @param string $url
     * @return string
     */
    protected function getHtml(string $url): string
    {
        return $this->fileGetContents->execute($url);
    }
}