<?php

declare(strict_types=1);

namespace ComicPlanner\Controller;

use PDO;
use ComicPlanner\Repository\ChecklistRepository;

class DeleteChecklistController 
{

    public function __construct(private PDO $pdo)
    {
    }

    public function processaRequisicao(): void 
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $checklistTypeId = filter_input(INPUT_GET, 'checklistTypeId', FILTER_VALIDATE_INT);

        $checklistRepository = new ChecklistRepository($this->pdo);
        $checklistRepository->remove($id);
 
        header('Location: /checklist-list?id='. $checklistTypeId);
    }
} ?>