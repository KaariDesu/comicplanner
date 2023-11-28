<?php

declare(strict_types=1);

namespace ComicPlanner\Controller;

use PDO;
use ComicPlanner\Repository\ChecklistRepository;
use ComicPlanner\Repository\MonthRepository;
use ComicPlanner\Entity\Checklist;
use ComicPlanner\Entity\Month;
use finfo;

class NewChecklistController 
{

    public function __construct(private PDO $pdo)
    {
    }

    public function processaRequisicao(): void 
    {
        $id = null;
        $checklistTypeid = filter_input(INPUT_GET, 'checklistTypeId', FILTER_VALIDATE_INT);
        $monthId = filter_input(INPUT_POST, 'month', FILTER_VALIDATE_INT);
        $year = filter_input(INPUT_POST, 'year', FILTER_VALIDATE_INT);

        $checklistRepository = new ChecklistRepository($this->pdo);
        $monthRepository = new MonthRepository($this->pdo);

        $month = $monthRepository->find($monthId)->month;
        
        $checklist = new Checklist($id, $month, $year, $checklistTypeid, 0, 0);

        $checklistRepository->add($checklist, $monthId);
        header('Location: /checklist-list?id='. $checklistTypeid);
    }
} ?>