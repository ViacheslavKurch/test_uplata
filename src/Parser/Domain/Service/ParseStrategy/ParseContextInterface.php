<?php

namespace App\Parser\Domain\Service\ParseStrategy;

use App\Parser\Domain\DTO\ParseParamsDTO;

/**
 * Interface ParseContextInterface
 * @package App\Parser\Domain\Service\ParseStrategy
 */
interface ParseContextInterface
{
    /**
     * @param ParseParamsDTO $dto
     */
    public function execute(ParseParamsDTO $dto): void;
}