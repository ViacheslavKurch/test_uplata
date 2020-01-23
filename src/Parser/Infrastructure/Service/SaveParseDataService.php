<?php

namespace App\Parser\Infrastructure\Service;

use App\Parser\Domain\DTO\ParsedBlockDTO;
use App\Parser\Domain\Entity\ParsedEntity;
use App\Parser\Domain\ValueObject\ParsedId;
use App\Parser\Domain\Repository\ParseRepositoryInterface;
use App\Parser\Domain\Service\SaveParseDataServiceInterface;

/**
 * Class SaveParseDataService
 * @package App\Parser\Infrastructure\Service
 */
final class SaveParseDataService implements SaveParseDataServiceInterface
{
    /**
     * @var ParseRepositoryInterface
     */
    private ParseRepositoryInterface $parseRepository;

    /**
     * SaveParseDataService constructor.
     * @param ParseRepositoryInterface $parseRepository
     */
    public function __construct(ParseRepositoryInterface $parseRepository)
    {
        $this->parseRepository = $parseRepository;
    }

    /**
     * @param ParsedBlockDTO $dto
     */
    public function execute(ParsedBlockDTO $dto): void
    {
        $entity = new ParsedEntity(
            new ParsedId(),
            $dto->getTitle(),
            $dto->getAuthor(),
            $dto->getText(),
            $dto->getDate()
        );

        $this->parseRepository->save($entity);
    }
}