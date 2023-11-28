<?php

declare(strict_types=1);

namespace ComicPlanner\Controller;

use PDO;
use ComicPlanner\Repository\BookRepository;
use ComicPlanner\Repository\PriorityRepository;
use ComicPlanner\Repository\BookStatusRepository;
use ComicPlanner\Repository\RetailerRepository;
use ComicPlanner\Entity\Book;
use finfo;

class NewBookController 
{

    public function __construct(private PDO $pdo)
    {
    }

    public function processaRequisicao(): void 
    {
        $id = null;
        $title = filter_input(INPUT_POST, 'title');
        $checklistId = filter_input(INPUT_GET, 'checklistId', FILTER_VALIDATE_INT);
        $price = str_replace(',', '.', $_POST['price']);
        $price = filter_var($price, FILTER_VALIDATE_FLOAT);
        $priorityId = filter_input(INPUT_POST, 'priority', FILTER_VALIDATE_INT);
        $bookStatusId = filter_input(INPUT_POST, 'book-status', FILTER_VALIDATE_INT);
        $retailerId = filter_input(INPUT_POST, 'retailer', FILTER_VALIDATE_INT);

        $bookRepository = new BookRepository($this->pdo);
        $priorityRepository = new PriorityRepository($this->pdo);
        $bookStatusRepository = new BookStatusRepository($this->pdo);
        $retailerRepository = new RetailerRepository($this->pdo);

        $priority = $priorityRepository->find($priorityId)->priority;
        $bookStatus = $bookStatusRepository->find($bookStatusId)->bookStatus;
        $retailer = $retailerRepository->find($retailerId)->retailer;
        
        $book = new Book($id, $checklistId, $title, $price, $priority, $bookStatus, $retailer);

        if($_FILES['image']['error'] === UPLOAD_ERR_OK){
            $safeFileName = uniqid('upload_') . '_' . pathinfo($_FILES['image']['name'], PATHINFO_BASENAME);
            $finfo = new finfo(FILEINFO_MIME_TYPE);
            $mimeType = $finfo->file($_FILES['image']['tmp_name']);

            if (str_starts_with($mimeType, 'image/')) {
                move_uploaded_file(
                    $_FILES['image']['tmp_name'],
                    __DIR__ . '/../../public/img/uploads/' . $safeFileName
                );
                $book->setImagePath($safeFileName);
            }
        }

        $bookRepository->add($book, $priorityId, $bookStatusId, $retailerId);
        header('Location: /checklist?id='.$checklistId);
    }
} ?>