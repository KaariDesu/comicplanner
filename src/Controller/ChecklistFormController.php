<?php

declare(strict_types=1);

namespace ComicPlanner\Controller;

use PDO;
use ComicPlanner\Repository\ChecklistRepository;
use ComicPlanner\Repository\MonthRepository;
use ComicPlanner\Entity\Video;

class ChecklistFormController 
{

    public function __construct(private PDO $pdo)
    {
    }

    public function processaRequisicao(): void 
    {
        $checklistRepository = new ChecklistRepository($this->pdo);
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $checklistTypeId = filter_input(INPUT_GET, 'checklistTypeId', FILTER_VALIDATE_INT);
        $checklist = null;

        if ($id !== false && $id !== NULL) {
            $checklist = $checklistRepository->find($id);
        }

        $monthRepository = new MonthRepository($this->pdo);
        $months = $monthRepository->all();

        require_once __DIR__ . '/../../views/checklist-form.php';
    } 
} 

 

