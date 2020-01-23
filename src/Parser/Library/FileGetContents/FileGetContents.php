<?php


namespace App\Parser\Library\FileGetContents;

use App\Parser\Library\Exception\NotOpenFileException;

/**
 * Class FileGetContents
 * @package App\Parser\Library\FileGetContents
 */
final class FileGetContents implements FileGetContentsInterface
{
    private const DEFAULT_USER_AGENT = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36';

    /**
     * @param string $url
     * @return string
     * @throws NotOpenFileException
     */
    public function execute(string $url): string
    {
        $context = stream_context_create([
            'http' => [
                'header' => self::DEFAULT_USER_AGENT,
            ],
        ]);

        $result = @file_get_contents($url, false, $context);

        if (false === $result) {
            throw new NotOpenFileException('Not open file');
        }

        return $result;
    }
}