<?php

namespace App\Parser\Infrastructure\Repository;

use PDO;
use App\System\Config\ConfigInterface;

/**
 * Class AbstractRepository
 * @package App\Parser\Infrastructure\Repository
 */
abstract class AbstractRepository
{
    /**
     * @var PDO
     */
    private PDO $pdo;

    /**
     * AbstractRepository constructor.
     * @param ConfigInterface $config
     */
    public function __construct(ConfigInterface $config)
    {
        $dbName = $config->get('POSTGRES_DB_NAME');
        $host = $config->get('POSTGRES_HOST');
        $user = $config->get('POSTGRES_USER');
        $password = $config->get('POSTGRES_PASSWORD');

        $this->pdo = new PDO("pgsql:host=$host;dbname=$dbName", $user, $password);

    }

    /**
     * @return PDO
     */
    protected function getPDO(): PDO
    {
        return $this->pdo;
    }
}