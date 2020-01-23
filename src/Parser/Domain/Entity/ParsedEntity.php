<?php

namespace App\Parser\Domain\Entity;

use DateTime;
use App\Parser\Domain\ValueObject\ParsedId;

/**
 * Class ParseEntity
 * @package App\Parser\Domain\Entity
 */
class ParsedEntity
{
    /**
     * @var ParsedId
     */
    private ParsedId $id;

    /**
     * @var string
     */
    private string $title;

    /**
     * @var string
     */
    private string $author;

    /**
     * @var string
     */
    private string $text;

    /**
     * @var DateTime
     */
    private DateTime $date;

    /**
     * ParseEntity constructor.
     * @param ParsedId $id
     * @param string $title
     * @param string $author
     * @param string $text
     * @param DateTime $date
     */
    public function __construct(
        ParsedId $id,
        string $title,
        string $author,
        string $text,
        DateTime $date
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->author = $author;
        $this->text = $text;
        $this->date = $date;
    }

    /**
     * @return ParsedId
     */
    public function getId(): ParsedId
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getAuthor(): string
    {
        return $this->author;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @return DateTime
     */
    public function getDate(): DateTime
    {
        return $this->date;
    }
}