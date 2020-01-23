<?php

namespace App\Parser\Domain\Service\ParseStrategy\Strategy;

use App\Parser\Domain\DTO\ParseParamsDTO;

/**
 * Interface ParseStrategyInterface
 * @package App\Parser\Domain\Service\ParseStrategy
 */
interface ParseStrategyInterface
{
    /**
     * @param ParseParamsDTO $parseDTO
     * @return array
     */
    public function parse(ParseParamsDTO $parseDTO): array;
}