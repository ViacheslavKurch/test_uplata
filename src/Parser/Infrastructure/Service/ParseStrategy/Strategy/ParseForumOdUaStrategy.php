<?php

namespace App\Parser\Infrastructure\Service\ParseStrategy\Strategy;

use DateTime;
use DOMXPath;
use DOMElement;
use DOMDocument;
use DOMNodeList;
use App\Parser\Domain\DTO\ParseParamsDTO;
use App\Parser\Domain\DTO\ParsedBlockDTO;
use App\Parser\Domain\Service\ParseStrategy\Strategy\ParseStrategyInterface;

/**
 * Class ParseForumOdUaStrategy
 * @package App\Parser\Infrastructure\Service\ParseStrategy\Strategy
 */
final class ParseForumOdUaStrategy extends AbstractStrategy implements ParseStrategyInterface
{
    private const FIRST_PAGE = 1;

    /**
     * @param ParseParamsDTO $parseDTO
     * @return array
     */
    public function parse(ParseParamsDTO $parseDTO): array
    {
        $result = [];
        $title = null;

        for ($page = self::FIRST_PAGE; $page <= $parseDTO->getCountPage(); $page++) {
            $url = $this->getParsedUrl($parseDTO, $page);
            $html = $this->getHtml($url);
            $xpath = $this->getXPath($html);

            if (null === $title) {
                $title = $this->getTitle($xpath);
            }

            foreach ($this->getItemsListByXPath($xpath) as $item) {
                $author = $this->getAuthor($xpath, $item);
                $text = $this->getText($xpath, $item);
                $date = $this->getDate($xpath, $item);

                if (null === $author || null === $text || null === $date) {
                    continue;
                }

                $result[] = new ParsedBlockDTO(
                    $title,
                    $author,
                    $text,
                    $this->getNormalizeDate($date)
                );
            }
        }

        return $result;
    }

    /**
     * @param string $html
     * @return DOMXPath
     */
    private function getXPath(string $html): DOMXPath
    {
        $document = new DOMDocument();
        $document->loadHTML($html);

        return new DOMXPath($document);
    }

    /**
     * @param DOMXPath $xpath
     * @return DOMNodeList
     */
    private function getItemsListByXPath(DOMXPath $xpath): DOMNodeList
    {
        return $xpath->query('//li[contains(@class,"postbitlegacy")]');
    }

    /**
     * @param DOMXPath $xpath
     * @return string
     */
    private function getTitle(DOMXPath $xpath): ?string
    {
        $result = $xpath->query('//h2[contains(@class,"title")]');

        return $this->getFormattedResult($result);
    }

    /**
     * @param DOMXPath $xpath
     * @param DOMElement $context
     * @return string
     */
    private function getAuthor(DOMXPath $xpath, DOMElement $context): ?string
    {
        $result = $xpath->query('div[@class="postdetails"]/div[@class="userinfo"]/div[@class="username_container"]/div/a', $context);

        return $this->getFormattedResult($result);
    }

    /**
     * @param DOMXPath $xpath
     * @param DOMElement $context
     * @return string|null
     */
    private function getText(DOMXPath $xpath, DOMElement $context): ?string
    {
        $result = $xpath->query('div[@class="postdetails"]/div[@class="postbody  "]/div[@class="postrow has_after_content"]/div/div/blockquote', $context);

        return $this->getFormattedResult($result);
    }

    /**
     * @param DOMXPath $xpath
     * @param DOMElement $context
     * @return string|null
     */
    private function getDate(DOMXPath $xpath, DOMElement $context): ?string
    {
        $result = $xpath->query('div[@class="posthead"]/span[@class="postdate old"]/span', $context);

        return $this->getFormattedResult($result);
    }

    /**
     * @param DOMNodeList $list
     * @return string|null
     */
    private function getFormattedResult(DOMNodeList $list): ?string
    {
        return ($list->count() >= 1) ? trim($list->item(0)->textContent) : null;
    }

    /**
     * @param string $date
     * @return DateTime
     */
    private function getNormalizeDate(string $date): DateTime
    {
        $date = utf8_encode($date);

        $date = str_replace('Â ', ' ', $date);

        return DateTime::createFromFormat('d.m.Y H:m', $date);
    }
}