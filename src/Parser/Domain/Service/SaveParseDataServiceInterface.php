<?php

namespace App\Parser\Domain\Service;

use App\Parser\Domain\DTO\ParsedBlockDTO;

/**
 * Interface SaveParseDataServiceInterface
 * @package App\Parser\Domain\Service
 */
interface SaveParseDataServiceInterface
{
    /**
     * @param ParsedBlockDTO $dto
     */
    public function execute(ParsedBlockDTO $dto): void;
}