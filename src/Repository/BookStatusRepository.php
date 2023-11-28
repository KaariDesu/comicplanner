<?php

declare(strict_types=1);

namespace ComicPlanner\Repository;

use ComicPlanner\Entity\BookStatus;
use PDO;

class BookStatusRepository
{
    public function __construct(private PDO $pdo)
    {
    }

    public function find(int $id)
    {
        $statement = $this->pdo->prepare('SELECT * FROM book_status WHERE id = ?;');
        $statement->bindValue(1, $id, PDO::PARAM_INT);
        $statement->execute();

        return $this->hydrateBookStatus($statement->fetch(PDO::FETCH_ASSOC));
    }

    public function hydrateBookStatus(array $bookStatusData): BookStatus
    {
        $bookStatus = new BookStatus($bookStatusData['id'], $bookStatusData['book_status']);

        return $bookStatus;
    }

    public function all(): array 
    {
        $statement = $this->pdo->prepare('SELECT * FROM book_status;');
        $statement->execute();

        $bookStatusList = $statement->fetchAll(PDO::FETCH_ASSOC);

        return array_map($this->hydrateBookStatus(...),$bookStatusList);
    }
}