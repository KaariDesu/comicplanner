<?php

declare(strict_types=1);

namespace ComicPlanner\Controller;

use PDO;
use ComicPlanner\Repository\BookRepository;
use ComicPlanner\Entity\Book;

class DeleteBookController 
{

    public function __construct(private PDO $pdo)
    {
    }

    public function processaRequisicao(): void 
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $checklistId = filter_input(INPUT_GET, 'checklistId', FILTER_VALIDATE_INT);

        $bookRepository = new BookRepository($this->pdo);
        $bookRepository->remove($id);
 
        header('Location: /checklist?id='.$checklistId);

    }
} ?>