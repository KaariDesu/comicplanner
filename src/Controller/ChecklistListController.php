<?php

declare(strict_types=1);

namespace ComicPlanner\Controller;
use PDO;

use ComicPlanner\Repository\ChecklistRepository;

class ChecklistListController
{

    public function __construct(private PDO $pdo)
    {
    }

    public function processaRequisicao(): void 
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        $checklistRepository = new ChecklistRepository($this->pdo);
        $checklists= $checklistRepository->findAllByType($id);
        require_once __DIR__ . '/../../views/checklist-list.php';
    }
}