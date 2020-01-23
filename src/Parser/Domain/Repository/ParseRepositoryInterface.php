<?php

namespace App\Parser\Domain\Repository;

use App\Parser\Domain\Entity\ParsedEntity;

/**
 * Interface ParseRepositoryInterface
 * @package App\Parser\Domain\Repository
 */
interface ParseRepositoryInterface
{
    /**
     * @param ParsedEntity $parseEntity
     */
    public function save(ParsedEntity $parseEntity): void;
}