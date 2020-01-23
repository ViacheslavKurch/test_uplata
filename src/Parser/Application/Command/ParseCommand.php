<?php

namespace App\Parser\Application\Command;

use App\Parser\Domain\DTO\ParseParamsDTO;
use App\System\Config\ConfigInterface;
use App\Parser\Application\Factory\ParseFactory;

/**
 * Class ParseCommand
 * @package App\Parser\Application\Command
 */
class ParseCommand
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

    public function parse(): void
    {
        $dto = new ParseParamsDTO(
            $this->config->get('url'),
            $this->config->get('topic'),
            $this->config->get('pageParam'),
            $this->config->get('countPage')
        );

        $service = ParseFactory::create();
        $service->execute($dto);
    }
}