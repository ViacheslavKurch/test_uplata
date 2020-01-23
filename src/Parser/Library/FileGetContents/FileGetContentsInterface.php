<?php

namespace App\Parser\Library\FileGetContents;

/**
 * Interface FileGetContentsInterface
 * @package App\Parser\Library\FileGetContents
 */
interface FileGetContentsInterface
{
    /**
     * @param string $url
     * @return string
     */
    public function execute(string $url): string;
}