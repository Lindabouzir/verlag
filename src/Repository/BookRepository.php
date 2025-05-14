<?php

namespace Repository;

use PDO;
use Repository\Book;

class BookRepository
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAllBooks()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM book");
        $stmt->execute();

        $books = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $books[] = new Book(
                $row['id'],
                $row['isbn'],
                $row['publication_date'],
                $row['pages'],
                $row['title'],
                $row['price'],
                $row['category'],
                $row['hardcover'],
                $row['author_id']
            );
        }

        return $books;
    }

    public function getBookById(int $id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM book WHERE id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            return new Book(
                $row['id'],
                $row['isbn'],
                $row['publication_date'],
                $row['pages'],
                $row['title'],
                $row['price'],
                $row['category'],
                $row['hardcover'],
                $row['author_id']
            );
        }

        return null;
    }

    public function addBook(string $isbn, string $publication_date, int $pages, string $title, float $price, string $category, bool $hardcover, int $author_id)
    {
        $stmt = $this->pdo->prepare(
            "INSERT INTO book (isbn, publication_date, pages, title, price, category, hardcover, author_id) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$isbn, $publication_date, $pages, $title, $price, $category, $hardcover, $author_id]);

    }

    public function updateBook(int $id, string $isbn, string $publication_date, int $pages, string $title, float $price, string $category, bool $hardcover, int $author_id)
    {
        $stmt = $this->pdo->prepare("UPDATE book SET isbn = ?, publication_date = ?, pages = ?, title = ?, price = ?, category = ?, hardcover = ?, author_id = ? WHERE id = ?");
        $stmt->execute([$isbn, $publication_date, $pages, $title, $price, $category, $hardcover, $author_id, $id]);
    }

    public function deleteBook(int $id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM book WHERE id = ?");
        $stmt->execute([$id]);
    }
    public function getBooksByAuthorId(int $author_id): array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM book WHERE author_id = ?");
        $stmt->execute([$author_id]);

        $books = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $books[] = new Book(
                $row['id'],
                $row['isbn'],
                $row['publication_date'],
                $row['pages'],
                $row['title'],
                $row['price'],
                $row['category'],
                $row['hardcover'],
                $row['author_id']
            );
        }

        return $books;
    }

    public function deleteBooksByAuthorId(int $author_id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM book WHERE author_id = ?");
        $stmt->execute([$author_id]);
    }

}
