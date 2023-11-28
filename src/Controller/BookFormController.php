<?php

declare(strict_types=1);

namespace ComicPlanner\Controller;

use PDO;
use ComicPlanner\Repository\BookRepository;
use ComicPlanner\Repository\PriorityRepository;
use ComicPlanner\Repository\RetailerRepository;
use ComicPlanner\Repository\BookStatusRepository;
use ComicPlanner\Entity\Video;

class BookFormController 
{

    public function __construct(private PDO $pdo)
    {
    }

    public function processaRequisicao(): void 
    {
        $bookRepository = new BookRepository($this->pdo);
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $book = null;

        if ($id !== false && $id !== NULL) {
            $book = $bookRepository->find($id);
        }

        $priorityRepository = new PriorityRepository($this->pdo);
        $priorities = $priorityRepository->all();

        $retailerRepository = new RetailerRepository($this->pdo);
        $retailers = $retailerRepository->all();

        $bookStatusRepository = new BookStatusRepository($this->pdo);
        $bookStatuses = $bookStatusRepository->all();

        require_once __DIR__ . '/../../views/book-form.php';
    } 
} 

 

