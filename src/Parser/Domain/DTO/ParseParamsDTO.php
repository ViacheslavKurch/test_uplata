<?php

namespace App\Parser\Domain\DTO;

/**
 * Class ParseParamsDTO
 * @package App\Parser\Domain\DTO
 */
class ParseParamsDTO
{
    /**
     * @var string
     */
    private string $url;

    /**
     * @var string
     */
    private string $topic;

    /**
     * @var string
     */
    private string $pageParam;

    /**
     * @var int
     */
    private int $countPage;

    /**
     * ParseParamsDTO constructor.
     * @param string $url
     * @param string $topic
     * @param string $pageParam
     * @param int $countPage
     */
    public function __construct(
        string $url,
        string $topic,
        string $pageParam,
        int $countPage
    ) {
        $this->url = $url;
        $this->topic = $topic;
        $this->pageParam = $pageParam;
        $this->countPage = $countPage;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @return string
     */
    public function getTopic(): string
    {
        return $this->topic;
    }

    /**
     * @return string
     */
    public function getPageParam(): string
    {
        return $this->pageParam;
    }

    /**
     * @return int
     */
    public function getCountPage(): int
    {
        return $this->countPage;
    }

}