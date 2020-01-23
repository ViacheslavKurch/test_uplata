<?php

namespace App\Parser\Library\RabbitMQ;

use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Message\AMQPMessage;
use App\System\Config\ConfigInterface;
use PhpAmqpLib\Exchange\AMQPExchangeType;
use PhpAmqpLib\Connection\AMQPStreamConnection;

/**
 * Class RabbitMQ
 * @package App\Parser\Library\RabbitMQ
 */
final class RabbitMQAdapter implements RabbitMQAdapterInterface
{
    private const DEFAULT_QUEUE = 'parse_queue';

    private const DEFAULT_EXCHANGE = 'parse_exchange';

    private const DEFAULT_CONSUMER_TAG = 'parse_consumer_tag';

    /**
     * @var AMQPStreamConnection
     */
    private AMQPStreamConnection $connection;

    /**
     * @var AMQPChannel
     */
    private AMQPChannel $channel;

    /**
     * RabbitMQ constructor.
     * @param ConfigInterface $config
     */
    public function __construct(ConfigInterface $config)
    {
        $this->connection = new AMQPStreamConnection(
            $config->get('RABBITMQ_HOST'),
            $config->get('RABBITMQ_PORT'),
            $config->get('RABBITMQ_USER'),
            $config->get('RABBITMQ_PASSWORD'),
            $config->get('RABBITMQ_VHOST')
        );

        $this->channel = $this->connection->channel();
    }

    /**
     * @param string $queue
     * @param bool $passive
     * @param bool $durable
     * @param bool $exclusive
     * @param bool $autoDelete
     * @return $this
     */
    public function queueDeclare(
        string $queue = self::DEFAULT_QUEUE,
        bool $passive = false,
        bool $durable = true,
        bool $exclusive = false,
        bool $autoDelete = false
    ): self {
        $this->channel->queue_declare($queue, $passive, $durable, $exclusive, $autoDelete);

        return $this;
    }

    /**
     * @param string $exchange
     * @param string $type
     * @param bool $passive
     * @param bool $durable
     * @param bool $autoDelete
     * @return $this
     */
    public function exchangeDeclare(
        string $exchange = self::DEFAULT_EXCHANGE,
        string $type = AMQPExchangeType::DIRECT,
        bool $passive = false,
        bool $durable = true,
        bool $autoDelete = false
    ): self {
        $this->channel->exchange_declare($exchange, $type, $passive, $durable, $autoDelete);

        return $this;
    }

    /**
     * @param string $queue
     * @param string $exchange
     * @return $this
     */
    public function queueBind(
        string $queue = self::DEFAULT_QUEUE,
        string $exchange = self::DEFAULT_EXCHANGE
    ): self {
        $this->channel->queue_bind($queue, $exchange);

        return $this;
    }

    /**
     * @param string $message
     * @param string $exchange
     * @return $this
     */
    public function publish(string $message, string $exchange = self::DEFAULT_EXCHANGE): self
    {
        $this->channel->basic_publish(new AMQPMessage($message), $exchange);

        return $this;
    }

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
        string $queue = self::DEFAULT_QUEUE,
        string $consumerTag = self::DEFAULT_CONSUMER_TAG,
        bool $noLocal = false,
        bool $noAck = true,
        bool $exclusive = false,
        bool $nowait = false
    ): self {
        $this->channel->basic_consume($queue, $consumerTag, $noLocal, $noAck, $exclusive, $nowait, $callable);

        return $this;
    }

    /**
     * @throws \ErrorException
     */
    public function isConsuming(): void
    {
        while ($this->channel->is_consuming()) {
            $this->channel->wait(null, true);
        }
    }

    /**
     * @throws \Exception
     */
    public function closeConnection(): void
    {
        $this->channel->close();
        $this->connection->close();
    }
}