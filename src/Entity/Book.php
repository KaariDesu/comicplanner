<?php

declare(strict_types=1);

namespace ComicPlanner\Entity;

use ComicPlanner\Entity\Priority;
use ComicPlanner\Entity\BookStatus;
use ComicPlanner\Entity\Retailer;
use InvalidArgumentException;

class Book
{
    public ?int $id = null;
    public readonly int $checklistId;
    public readonly string $title;
    public readonly float $price;
    public readonly string $priority;
    public readonly string $bookStatus;
    public readonly string $retailer;
    public ?string $imagePath = null;

    public function __construct(
        ?int $id,
        int $checklistId,
        string $title,
        float $price,
        string $priority,
        string $bookStatus,
        string $retailer,
    )
    {
        $this->setId($id);
        $this->setChecklistId($checklistId);
        $this->setTitle($title);
        $this->setprice($price);
        $this->setPriority($priority);
        $this->setBookStatus($bookStatus);
        $this->setRetailer($retailer);
    }

    public function setId(?int $id): void 
    {
        $this->id = $id;
    }

    public function setChecklistId(int $checklistId): void 
    {
        $this->checklistId = $checklistId;
    }

    public function setTitle(string $title): void 
    {
        $this->title = $title;
    }

    public function setPrice(float $price): void 
    {
        $this->price = $price;
    }

    public function setPriority(string $priority): void 
    {
        $this->priority = $priority;
    }

    public function setBookStatus(string $bookStatus): void 
    {
        $this->bookStatus = $bookStatus;
    }

    public function setRetailer(string $retailer): void 
    {
        $this->retailer = $retailer;
    }

    public function setImagePath(?string $imagePath): void
    {
        if (!isset($imagePath)) {
            $this->imagePath = 'capa-provisoria.jpg';
        } else {
            $this->imagePath = $imagePath;
        }
    }

    public function getImagePath() : ?string
    {
        return $this->imagePath;
    }
    
}   