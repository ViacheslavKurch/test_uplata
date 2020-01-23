<?php

namespace App\Parser\Library\RabbitMQ;

use PhpAmqpLib\Message\AMQPMessage;

/**
 * Interface RabbitMQInterface
 * @package App\Parser\Library\RabbitMQ
 */
interface RabbitMQAdapterInterface
{
    /**
     * @param string $queue
     * @param bool $passive
     * @param bool $durable
     * @param bool $exclusive
     * @param bool $autoDelete
     * @return $this
     */
    public function queueDeclare(string $queue, bool $passive, bool $durable, bool $exclusive, bool $autoDelete): self;

    /**
     * @param string $exchange
     * @param string $type
     * @param bool $passive
     * @param bool $durable
     * @param bool $autoDelete
     * @return $this
     */
    public function exchangeDeclare(string $exchange, string $type, bool $passive, bool $durable, bool $autoDelete): self;

    /**
     * @param string $queue
     * @param string $exchange
     * @return $this
     */
    public function queueBind(string $queue, string $exchange): self;

    /**
     * @param string $message
     * @param string $exchange
     * @return $this
     */
    public function publish(string $message, string $exchange): self;

    /**
     * @param callable $callable
     * @param string $queue
     * @param string $consumerTag
     * @param bool $noLocal
     * @param bool $noAck
     * @param bool $exclusive
     * @param bool $nowait
     * @return $this
     */
    public function consume(
        callable $callable,
        string $queue,
        string $consumerTag,
        bool $noLocal,
        bool $noAck,
        bool $exclusive,
        bool $nowait
    ): self;

    public function isConsuming(): void;

    public function closeConnection(): void;
}