<?php

declare(strict_types=1);

namespace ComicPlanner\Repository;

use ComicPlanner\Entity\Book;
use ComicPlanner\Entity\Month;
use ComicPlanner\Entity\Checklist;
use ComicPlanner\Repository\BookRepository;
use ComicPlanner\Repository\MonthRepository;
use PDO;

class ChecklistRepository
{

    public function __construct(private PDO $pdo)
    {
    }

    public function find(int $id)
    {
        $statement = $this->pdo->prepare('SELECT * FROM checklist WHERE id = ?;');
        $statement->bindValue(1, $id, PDO::PARAM_INT);
        $statement->execute();

        return $this->hydrateChecklist($statement->fetch(PDO::FETCH_ASSOC));
    }

    public function findByMonthAndYear(int $month, int $year, int $checklistTypeId)
    {
        $statement = $this->pdo->prepare('SELECT * FROM checklist WHERE checklist_month = ? AND checklist_year = ? AND checklist_type_id = ?;');
        $statement->bindValue(1, $month, PDO::PARAM_INT);
        $statement->bindValue(2, $year, PDO::PARAM_INT);
        $statement->bindValue(3, $checklistTypeId, PDO::PARAM_INT);
        $statement->execute();

        $checklistList = $statement->fetchAll(PDO::FETCH_ASSOC);

        return array_map($this->hydrateChecklistBasicInfo(...),$checklistList);
    }


    public function hydrateChecklist(array $checklistData): Checklist
    {
        $month = $this->findMonth($checklistData['checklist_month']);
        $books = $this->findBooks($checklistData['id']);
        $checklist = new CheckList($checklistData['id'], $month->month, $checklistData['checklist_year'], $checklistData['checklist_type_id'], $books);
        $checklist->setBooks($books);
        $checklist->setTotalExpense($this->calculateTotalExpense($books));
        $checklist->setAverageExpense($this->calculateAverageExpense($checklist));

        return $checklist;
    }

    public function hydrateChecklistBasicInfo(array $checklistData): Checklist
    {
        $month = $this->findMonth($checklistData['checklist_month']);
        $books = $this->findBooks($checklistData['id']);
        $totalExpense = $this->calculateTotalExpense($books);

        $checklist = new CheckList($checklistData['id'], $month->month, $checklistData['checklist_year'], $checklistData['checklist_type_id'], $totalExpense, $checklistData['first_image_path']);
        if ($checklistData['first_image_path'] !== null) {
            $checklist->setFirstImagePath($checklistData['first_image_path']);
        } else {
            $checklist->setFirstImagePath(null);
        }

        $checklist->setTotalExpense($this->calculateTotalExpense($books));
        $checklist->setAverageExpense($this->calculateAverageExpense($checklist));
        $checklist->setBookCount(count($books));

        return $checklist;
    }

    public function findMonth(int $id): Month
    {
        $monthRepository = new MonthRepository($this->pdo);
        return $monthRepository->find($id);
    }

    public function findBooks(int $checklistId): array 
    {
        $bookRepository = new BookRepository($this->pdo);
        return $bookRepository->findByChecklist($checklistId);
    }

    public function calculateTotalExpense(array $books): float
    {
        $totalExpense = 0.0;
        foreach ($books as $book) {
            $totalExpense = $totalExpense + $book->price;
        }
        return $totalExpense;
    }

    public function calculateAverageExpense(Checklist $checklist): float
    {
        $monthRepository = new MonthRepository($this->pdo);
        $months = $monthRepository->all();
        if ($checklist->checklistMonth == 'Janeiro') {
            $previousMonth = 12;
            $year = $checklist->checklistYear-1;
        } else {
            foreach($months as $month) {
                if ($checklist->checklistMonth == $month->month) {
                    $previousMonth = $month->id-1;
                }
            }
            $year = $checklist->checklistYear;
        }
        
        $previousChecklist = $this->findByMonthAndYear($previousMonth,$year,$checklist->checklistTypeId);
        if ($previousChecklist != null) {
            $averageExpense = ($checklist->totalExpense + $previousChecklist[0]->totalExpense)/2;
        } else {
            $averageExpense = $checklist->totalExpense;
        }
        return $averageExpense;
    }

    public function findAllByType(int $typeId)
    {
        $statement = $this->pdo->prepare('SELECT * FROM checklist WHERE checklist_type_id = ?;');
        $statement->bindValue(1, $typeId, PDO::PARAM_INT);
        $statement->execute();

        $checklistList = $statement->fetchAll(PDO::FETCH_ASSOC);

        return array_map($this->hydrateChecklistBasicInfo(...),$checklistList);
    }

    public function update(Checklist $checklist, int $monthId): void 
    {
            $sql = "UPDATE checklist SET 
                checklist_month = :checklist_month, 
                checklist_year = :checklist_year
            WHERE id = :id;";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(':checklist_month', $monthId, PDO::PARAM_INT);
        $statement->bindValue(':checklist_year', $checklist->checklistYear, PDO::PARAM_INT);
        $statement->bindValue(':id', $checklist->id, PDO::PARAM_INT);
        $statement->execute();
        
    }

    public function add(Checklist $checklist, int $monthId): void 
    {
            $sql = "INSERT INTO checklist ( 
                    checklist_type_id,
                    checklist_month, 
                    checklist_year
                ) VALUES (
                    :checklist_type_id, 
                    :checklist_month, 
                    :checklist_year
                );";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(':checklist_type_id', $checklist->checklistTypeId, PDO::PARAM_INT);
        $statement->bindValue(':checklist_month', $monthId, PDO::PARAM_INT);
        $statement->bindValue(':checklist_year', $checklist->checklistYear, PDO::PARAM_INT);
        $statement->execute();
        
    }

    public function remove(int $id): void
    {
        $sql = 'DELETE FROM checklist WHERE id = ?';
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $id);

        $statement->execute();
    }

    public function refresh(int $id): void 
    {
        $checklist = $this->find($id);
        $firstBookImage = $this->getFirstBookImage($checklist);
        $this->updateFirstBookImage($id, $firstBookImage);
        $this->updateTotalExpense($checklist);
        $this->updateAverageExpense($checklist);
    }

    public function getFirstBookImage(Checklist $checklist)
    {
        return $checklist->books[0]->imagePath;
    }

    public function updateFirstBookImage(int $checklistId, string $firstBookImage)
    {
        $sql = "UPDATE checklist SET first_image_path = ? WHERE id = ?";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $firstBookImage);
        $statement->bindValue(2, $checklistId);

        $statement->execute();
    }

    public function updateTotalExpense(Checklist $checklist) 
    {
        $books = $this->findBooks($checklist->id);
        $totalExpense = $this->calculateTotalExpense($books);

        $sql = "UPDATE checklist SET total_expense = ? WHERE id = ?";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $totalExpense);
        $statement->bindValue(2, $checklist->id);

        $statement->execute();
    }

    public function updateAverageExpense(Checklist $checklist) 
    {
        $averageExpense = $this->calculateAverageExpense($checklist);

        $sql = "UPDATE checklist SET average_expense = ? WHERE id = ?";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $averageExpense);
        $statement->bindValue(2, $checklist->id);

        $statement->execute();
    }

}