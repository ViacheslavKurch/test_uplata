<?php

namespace App\Parser\Application\Factory;

use App\System\Config\Config;
use App\Parser\Library\RabbitMQ\RabbitMQAdapter;
use App\Parser\Library\FileGetContents\FileGetContents;
use App\Parser\Infrastructure\Service\ParseStrategy\ParseContext;
use App\Parser\Domain\Service\ParseStrategy\ParseContextInterface;
use App\Parser\Infrastructure\Service\ParseStrategy\Strategy\ParseForumOdUaStrategy;

/**
 * Class ParseFactory
 * @package App\Parser\Application\Factory
 */
class ParseFactory
{
    /**
     * @return ParseContextInterface
     */
    public static function create(): ParseContextInterface
    {
        $configEnv = new Config('.env');
        $rabbitMQ = new RabbitMQAdapter($configEnv);

        $fileGetContentsService = new FileGetContents();

        $strategy = new ParseForumOdUaStrategy($fileGetContentsService);

        return new ParseContext($strategy, $rabbitMQ);
    }
}