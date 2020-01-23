<?php

namespace App\Parser\Domain\ValueObject;

/**
 * Class ParsedId
 * @package App\Parser\Domain\ValueObject
 */
final class ParsedId
{
    /**
     * @var string
     */
    private string $id;

    /**
     * ParsedId constructor.
     * @param string|null $id
     */
    public function __construct(string $id = null)
    {
        $this->id = null !== $id ? $id : uniqid();
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }
}