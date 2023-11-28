<?php

declare(strict_types=1);

namespace ComicPlanner\Entity;

class Month
{
    public readonly int $id;
    public readonly string $month;

    public function __construct(
        int $id,
        string $month
    )
    {
        $this->setId($id);
        $this->setMonth($month);
    }

    public function setId(int $id): void 
    {
        $this->id = $id;
    }

    public function setMonth(string $month): void 
    {
        $this->month = $month;
    }
}