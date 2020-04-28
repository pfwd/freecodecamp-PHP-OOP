<?php
namespace App\Repository;

use App\DB\Builder\Builder;
use App\DB\Connection;
use App\DB\QueryBuilder;
use App\Entity\Invoice;
use App\Entity\Status;

class RepositoryFactory
{
    /**
     * @var Connection
     */
    protected $connection;
    /**
     * @var QueryBuilder
     */
    protected $queryBuilder;
    /**
     * @var array
     */
    private $repositories = [];

    /**
     * @param Connection $connection
     * @param QueryBuilder $queryBuilder
     */
    public function __construct(Connection $connection, QueryBuilder $queryBuilder)
    {
        $this->connection = $connection;
        $this->queryBuilder = $queryBuilder;
    }

    /**
     * @param string $entityClassName
     * @return mixed
     */
    public function make(string $entityClassName): RepositoryInterface
    {
        if (key_exists($entityClassName, $this->repositories)) {
            return $this->repositories[$entityClassName];
        }

        $map = [
            Status::class => StatusRepository::class,
            Invoice::class => InvoiceRepository::class
        ];

        if(key_exists($entityClassName, $map)) {
            $repo = $map[$entityClassName];
        }
        

        return $this->repositories[$entityClassName] = new $repo($this->connection, $this->queryBuilder);
    }
}

$connection = new Connection();
$builder = new Builder();
$queryBuilder = new QueryBuilder($builder);
$respositoryFactory = new RepositoryFactory($connection, $queryBuilder);

$statusRepo = $respositoryFactory->make(Status::class)->findAll();