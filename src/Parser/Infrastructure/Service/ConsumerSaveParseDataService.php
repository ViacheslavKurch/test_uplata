<?php

namespace App\Parser\Infrastructure\Service;

use App\Parser\Library\RabbitMQ\RabbitMQAdapter;
use App\Parser\Library\RabbitMQ\RabbitMQAdapterInterface;
use App\Parser\Domain\Service\SaveParseDataServiceInterface;
use App\Parser\Domain\Service\ConsumerSaveParseDataServiceInterface;

/**
 * Class ConsumerSaveParseDataService
 * @package App\Parser\Infrastructure\Service
 */
final class ConsumerSaveParseDataService implements ConsumerSaveParseDataServiceInterface
{
    /**
     * @var RabbitMQAdapter
     */
    private RabbitMQAdapterInterface $rabbitMQ;

    /**
     * @var SaveParseDataServiceInterface
     */
    private  SaveParseDataServiceInterface $saveParseDataService;

    /**
     * ConsumerSaveParseDataService constructor.
     * @param RabbitMQAdapterInterface $rabbitMQ
     * @param SaveParseDataServiceInterface $saveParseDataService
     */
    public function __construct(
        RabbitMQAdapterInterface $rabbitMQ,
        SaveParseDataServiceInterface $saveParseDataService
    ) {
        $this->rabbitMQ = $rabbitMQ;
        $this->saveParseDataService = $saveParseDataService;
    }

    /**
     * @throws \ErrorException
     */
    public function execute(): void
    {
        $this->rabbitMQ->queueDeclare()
            ->exchangeDeclare()
            ->queueBind()
            ->consume(function ($message) {
                $this->saveParseDataService->execute(unserialize($message->body));
            })
            ->isConsuming();

        $this->rabbitMQ->closeConnection();
    }
}