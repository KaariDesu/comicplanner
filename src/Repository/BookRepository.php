<?php

declare(strict_types=1);

namespace ComicPlanner\Repository;

use ComicPlanner\Entity\Book;
use ComicPlanner\Entity\Priority;
use ComicPlanner\Entity\BookStatus;
use ComicPlanner\Entity\Retailer;
use ComicPlanner\Repository\PriorityRepository;
use ComicPlanner\Repository\BookStatusRepository;
use ComicPlanner\Repository\RetailerRepository;
use PDO;

class BookRepository
{

    public function __construct(private PDO $pdo)
    {
    }

    public function find(int $id)
    {
        $statement = $this->pdo->prepare('SELECT * FROM book WHERE id = ?;');
        $statement->bindValue(1, $id, PDO::PARAM_INT);
        $statement->execute();

        return $this->hydrateBook($statement->fetch(PDO::FETCH_ASSOC));
    }

    public function hydrateBook(array $bookData): Book
    {
        $priority = $this->findPriority($bookData['priority_id']);
        $bookStatus = $this->findBookStatus($bookData['book_status_id']);
        $retailer = $this->findRetailer($bookData['retailer_id']);

        $book = new Book($bookData['id'], $bookData['checklist_id'], $bookData['title'], $bookData['price'], $priority->priority, $bookStatus->bookStatus, $retailer->retailer);

        if ($bookData['image_path'] !== null) {
            $book->setImagePath($bookData['image_path']);
        } else {
            $book->setImagePath(null);
        }

        return $book;
    }

    public function findPriority(int $id): Priority
    {
        $priorityRepository = new PriorityRepository($this->pdo);
        return $priorityRepository->find($id);
    }

    public function findBookStatus(int $id): BookStatus
    {
        $bookStatusRepository = new BookStatusRepository($this->pdo);
        return $bookStatusRepository->find($id);
    }

    public function findRetailer(int $id): Retailer
    {
        $retailerRepository = new RetailerRepository($this->pdo);
        return $retailerRepository->find($id);
    }

    public function findByChecklist(int $checklistId): array
    {
        $statement = $this->pdo->prepare('SELECT * FROM book WHERE checklist_id = ?;');
        $statement->bindValue(1, $checklistId, PDO::PARAM_INT);
        $statement->execute();

        $bookList = $statement->fetchAll(PDO::FETCH_ASSOC);

        return array_map($this->hydrateBook(...),$bookList);
    }

    public function update(Book $book, int $priorityId, int $bookStatusId, int $retailerId): void 
    {
        $updateImageSql = ' ';
        if ($book->getImagePath() !== null) {
            $updateImageSql = ', image_path = :image_path';
        }
        $sql = "UPDATE book SET 
                title = :title, 
                price = :price, 
                priority_id = :priority, 
                book_status_id = :bookStatus, 
                retailer_id = :retailer
                $updateImageSql
            WHERE id = :id;";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(':title', $book->title);
        $statement->bindValue(':price', $book->price);
        $statement->bindValue(':priority', $priorityId, PDO::PARAM_INT);
        $statement->bindValue(':bookStatus', $bookStatusId, PDO::PARAM_INT);
        $statement->bindValue(':retailer', $retailerId, PDO::PARAM_INT);
        if ($book->getImagePath() !== null) {
            $statement->bindValue(':image_path', $book->getImagePath());
        }
        $statement->bindValue(':id', $book->id, PDO::PARAM_INT);
        $statement->execute();
        
    }

    public function add(Book $book, int $priorityId, int $bookStatusId, int $retailerId): void 
    {
        $updateImageSql = ' ';
        if ($book->getImagePath() !== null) {
            $insertImageSql = ', image_path ';
            $insertImageValue = ', :image_path ';
        }
        $sql = "INSERT INTO book (
                title,
                checklist_id,
                price,
                priority_id,
                book_status_id,
                retailer_id
                $insertImageSql
                )
                VALUES ( 
                :title, 
                :checklistId,
                :price, 
                :priority, 
                :bookStatus, 
                :retailer
                $insertImageValue
                );";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(':title', $book->title);
        $statement->bindValue(':checklistId', $book->checklistId, PDO::PARAM_INT);
        $statement->bindValue(':price', $book->price);
        $statement->bindValue(':priority', $priorityId, PDO::PARAM_INT);
        $statement->bindValue(':bookStatus', $bookStatusId, PDO::PARAM_INT);
        $statement->bindValue(':retailer', $retailerId, PDO::PARAM_INT);
        if ($book->getImagePath() !== null) {
            $statement->bindValue(':image_path', $book->getImagePath());
        }
        $statement->execute();
        
    }

    public function remove(int $id): void
    {
        $sql = 'DELETE FROM book WHERE id = ?';
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $id);

        $statement->execute();
    }
}