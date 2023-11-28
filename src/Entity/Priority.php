<?php

declare(strict_types=1);

namespace ComicPlanner\Entity;

class Priority
{
    public readonly int $id;
    public readonly string $priority;

    public function __construct(
        int $id,
        string $priority
    )
    {
        $this->setId($id);
        $this->setPriority($priority);
    }

    public function setId(int $id): void 
    {
        $this->id = $id;
    }

    public function setPriority(string $priority): void 
    {
        $this->priority = $priority;
    }
}