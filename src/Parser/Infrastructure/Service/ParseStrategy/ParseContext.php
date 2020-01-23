<?php

namespace App\Parser\Infrastructure\Service\ParseStrategy;

use App\Parser\Domain\DTO\ParseParamsDTO;
use App\Parser\Library\RabbitMQ\RabbitMQAdapter;
use App\Parser\Library\RabbitMQ\RabbitMQAdapterInterface;
use App\Parser\Domain\Service\ParseStrategy\ParseContextInterface;
use App\Parser\Domain\Service\ParseStrategy\Strategy\ParseStrategyInterface;

/**
 * Class ParseContext
 * @package App\Parser\Infrastructure\Service\ParseStrategy
 */
final class ParseContext implements ParseContextInterface
{
    /**
     * @var ParseStrategyInterface
     */
    private ParseStrategyInterface $parseStrategy;

    /**
     * @var RabbitMQAdapter
     */
    private RabbitMQAdapterInterface $rabbitMQ;

    /**
     * ParseContext constructor.
     * @param ParseStrategyInterface $parseStrategy
     * @param RabbitMQAdapter $rabbitMQ
     */
    public function __construct(ParseStrategyInterface $parseStrategy, RabbitMQAdapterInterface $rabbitMQ)
    {
        $this->parseStrategy = $parseStrategy;
        $this->rabbitMQ = $rabbitMQ;
    }

    /**
     * @param ParseParamsDTO $dto
     * @throws \Exception
     */
    public function execute(ParseParamsDTO $dto): void
    {
        $channel = $this->rabbitMQ->queueDeclare()
            ->exchangeDeclare()
            ->queueBind();

        $parsedData = $this->parseStrategy->parse($dto);

        foreach ($parsedData as $parsedBlockDto) {
            $channel->publish(serialize($parsedBlockDto));
        }

        $channel->closeConnection();
    }
}