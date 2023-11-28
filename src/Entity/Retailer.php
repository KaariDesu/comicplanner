<?php

declare(strict_types=1);

namespace ComicPlanner\Entity;

class Retailer
{
    public readonly int $id;
    public readonly string $retailer;

    public function __construct(
        int $id,
        string $retailer
    )
    {
        $this->setId($id);
        $this->setRetailer($retailer);
    }

    public function setId(int $id): void 
    {
        $this->id = $id;
    }

    public function setRetailer(string $retailer): void 
    {
        $this->retailer = $retailer;
    }
}