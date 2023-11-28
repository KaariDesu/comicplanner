<?php

declare(strict_types=1);

namespace ComicPlanner\Repository;

use ComicPlanner\Entity\Month;
use PDO;

class MonthRepository
{
    public function __construct(private PDO $pdo)
    {
    }

    public function find(int $id)
    {
        $statement = $this->pdo->prepare('SELECT * FROM month WHERE id = ?;');
        $statement->bindValue(1, $id, PDO::PARAM_INT);
        $statement->execute();

        return $this->hydrateMonth($statement->fetch(PDO::FETCH_ASSOC));
    }

    public function hydrateMonth(array $monthData): Month
    {
        $month = new month($monthData['id'], $monthData['month']);

        return $month;
    }

    public function all(): array 
    {
        $statement = $this->pdo->prepare('SELECT * FROM month;');
        $statement->execute();

        $monthList = $statement->fetchAll(PDO::FETCH_ASSOC);

        return array_map($this->hydrateMonth(...),$monthList);
    }
}