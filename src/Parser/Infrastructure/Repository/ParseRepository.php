<?php

namespace App\Parser\Infrastructure\Repository;

use App\Parser\Domain\Entity\ParsedEntity;
use App\Parser\Domain\Repository\ParseRepositoryInterface;

/**
 * Class ParseRepository
 * @package App\Parser\Infrastructure\Repository
 */
final class ParseRepository extends AbstractRepository implements ParseRepositoryInterface
{
    /**
     * @param ParsedEntity $parseEntity
     */
    public function save(ParsedEntity $parseEntity): void
    {
        $id = $parseEntity->getId()->getId();
        $title = $parseEntity->getTitle();
        $author = $parseEntity->getAuthor();
        $text = $parseEntity->getText();
        $date = $parseEntity->getDate()->format('Y-m-d H:m');

        $this->getPDO()->query(
            sprintf("SELECT save_parse_data('%s', '%s', '%s', '%s', '%s')", $id, $title, $author, $text, $date)
        );
    }
}