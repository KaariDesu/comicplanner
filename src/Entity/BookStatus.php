<?php

declare(strict_types=1);

namespace ComicPlanner\Entity;

class BookStatus
{
    public readonly int $id;
    public readonly string $bookStatus;

    public function __construct(
        int $id,
        string $bookStatus
    )
    {
        $this->setId($id);
        $this->setBookStatus($bookStatus);
    }

    public function setId(int $id): void 
    {
        $this->id = $id;
    }

    public function setBookStatus(string $bookStatus): void 
    {
        $this->bookStatus = $bookStatus;
    }
}