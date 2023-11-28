<?php

declare(strict_types=1);

namespace ComicPlanner\Entity;

use ComicPlanner\Entity\Book;

class Checklist
{
    public ?int $id;
    public readonly string $checklistMonth;
    public readonly int $checklistYear;
    public readonly int $checklistTypeId;
    public float $totalExpense = 0;
    public float $averageExpense = 0;
    public ?array $books = null;
    public ?string $firstImagePath = null;
    public ?int $bookCount = 0;

    public function __construct(
        ?int $id,
        string $checklistMonth,
        int $checklistYear,
        int $checklistTypeId,
    )
    {
        $this->setId($id);
        $this->setChecklistMonth($checklistMonth);
        $this->setChecklistYear($checklistYear);
        $this->setChecklistTypeId($checklistTypeId);
    }

    public function setId(?int $id): void 
    {
        $this->id = $id;
    }

    public function setChecklistMonth(string $checklistMonth): void 
    {
        $this->checklistMonth = $checklistMonth;
    }

    public function setChecklistYear(int $checklistYear): void 
    {
        $this->checklistYear = $checklistYear;
    }

    public function setChecklistTypeId(int $checklistTypeId): void 
    {
        $this->checklistTypeId = $checklistTypeId;
    }

    public function setTotalExpense(float $totalExpense): void 
    {
        $this->totalExpense = $totalExpense;
    }

    public function setAverageExpense(float $averageExpense): void 
    {
        $this->averageExpense = $averageExpense;
    }

    public function setBooks(array $books): void 
    {
        $this->books = $books;
    }

    public function setFirstImagePath(?string $firstImagePath): void
    {
        if (!isset($firstImagePath)) {
            $this->firstImagePath = 'capa-provisoria.jpg';
        } else {
            $this->firstImagePath = $firstImagePath;
        }
    }

    public function getFirstImagePath() : ?string
    {
        return $this->firstImagePath;
    }

    public function setBookCount(int $bookCount): void 
    {
        $this->bookCount = $bookCount;
    }
    
}   