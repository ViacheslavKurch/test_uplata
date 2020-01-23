<?php

namespace App\Parser\Application\Command;

use App\System\Config\ConfigInterface;
use App\Parser\Application\Factory\ConsumerSaveParseDataFactory;

/**
 * Class ConsumerSaveParseDataCommand
 * @package App\Parser\Application\Command
 */
class ConsumerSaveParseDataCommand
{
    /**
     * @var ConfigInterface
     */
    private ConfigInterface $config;

    /**
     * ParseCommand constructor.
     * @param ConfigInterface $config
     */
    public function __construct(ConfigInterface $config)
    {
        $this->config = $config;
    }

    public function consume(): void
    {
        $service = ConsumerSaveParseDataFactory::create();
        $service->execute();
    }
}