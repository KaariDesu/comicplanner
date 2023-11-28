<?php

declare(strict_types=1);

namespace ComicPlanner\Repository;

use ComicPlanner\Entity\Priority;
use PDO;

class PriorityRepository
{
    public function __construct(private PDO $pdo)
    {
    }

    public function find(int $id)
    {
        $statement = $this->pdo->prepare('SELECT * FROM priority WHERE id = ?;');
        $statement->bindValue(1, $id, PDO::PARAM_INT);
        $statement->execute();

        return $this->hydratePriority($statement->fetch(PDO::FETCH_ASSOC));
    }

    public function hydratePriority(array $priorityData): Priority
    {
        $priority = new Priority($priorityData['id'], $priorityData['priority']);

        return $priority;
    }

    public function all(): array 
    {
        $statement = $this->pdo->prepare('SELECT * FROM priority;');
        $statement->execute();

        $priorityList = $statement->fetchAll(PDO::FETCH_ASSOC);

        return array_map($this->hydratePriority(...),$priorityList);
    }
}