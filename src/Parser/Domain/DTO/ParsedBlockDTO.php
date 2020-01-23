<?php

namespace App\Parser\Domain\DTO;

use DateTime;

/**
 * Class ParseResultPageDTO
 * @package App\Parser\Domain\DTO
 */
class ParsedBlockDTO
{
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
     * ParseResultPageDTO constructor.
     * @param string $title
     * @param string $author
     * @param string $text
     * @param DateTime $date
     */
    public function __construct(
        string $title,
        string $author,
        string $text,
        DateTime $date
    ) {
        $this->title = $title;
        $this->author = $author;
        $this->text = $text;
        $this->date = $date;
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