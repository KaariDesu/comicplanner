<?php

declare(strict_types=1);

namespace ComicPlanner\Repository;

use ComicPlanner\Entity\Retailer;
use PDO;

class RetailerRepository
{
    public function __construct(private PDO $pdo)
    {
    }

    public function find(int $id)
    {
        $statement = $this->pdo->prepare('SELECT * FROM retailer WHERE id = ?;');
        $statement->bindValue(1, $id, PDO::PARAM_INT);
        $statement->execute();

        return $this->hydrateRetailer($statement->fetch(PDO::FETCH_ASSOC));
    }

    public function hydrateRetailer(array $retailerData): Retailer
    {
        $retailer = new Retailer($retailerData['id'], $retailerData['retailer']);

        return $retailer;
    }

    public function all(): array 
    {
        $statement = $this->pdo->prepare('SELECT * FROM retailer;');
        $statement->execute();

        $retailerList = $statement->fetchAll(PDO::FETCH_ASSOC);

        return array_map($this->hydrateRetailer(...),$retailerList);
    }
}