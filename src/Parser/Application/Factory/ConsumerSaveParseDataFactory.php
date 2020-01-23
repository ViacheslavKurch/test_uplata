<?php

namespace App\Parser\Application\Factory;

use App\System\Config\Config;
use App\Parser\Library\RabbitMQ\RabbitMQAdapter;
use App\Parser\Infrastructure\Repository\ParseRepository;
use App\Parser\Infrastructure\Service\SaveParseDataService;
use App\Parser\Infrastructure\Service\ConsumerSaveParseDataService;
use App\Parser\Domain\Service\ConsumerSaveParseDataServiceInterface;

/**
 * Class ConsumerSaveParseDataFactory
 * @package App\Parser\Application\Factory
 */
class ConsumerSaveParseDataFactory
{
    /**
     * @return ConsumerSaveParseDataServiceInterface
     */
    public static function create(): ConsumerSaveParseDataServiceInterface
    {
        $configEnv = new Config('.env');
        $rabbitMQ = new RabbitMQAdapter($configEnv);

        $parseRepository = new ParseRepository($configEnv);

        $saveParseDataService = new SaveParseDataService($parseRepository);

        return new ConsumerSaveParseDataService($rabbitMQ, $saveParseDataService);
    }
}