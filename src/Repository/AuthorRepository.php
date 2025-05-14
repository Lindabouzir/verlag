<?php

namespace Repository;
use PDO;
use Repository\Author;

class AuthorRepository
{
    private  $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAllAuthors(): array
    {
        $stmt = $this->pdo->query("SELECT * FROM author");
        $authors = [];

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $authors[] = new Author(
                (int)$row['id'],
                $row['fname'],
                $row['lname'],
                $row['bday'],
                $row['country']
            );
        }

        return $authors;
    }

    public function getAuthorById(int $id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM author WHERE id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            return new Author(
                (int)$row['id'],
                $row['fname'],
                $row['lname'],
                $row['bday'],
                $row['country']
            );
        }

        return null;
    }

    public function addAuthor(string $fname, string $lname, string $bday, string $country)
    {
        $stmt = $this->pdo->prepare("INSERT INTO author (fname, lname, bday, country) VALUES (?, ?, ?, ?)");
        $stmt->execute([$fname, $lname, $bday, $country]);
    }

    public function updateAuthor(int $id, string $fname, string $lname, string $bday, string $country)
    {
        $stmt = $this->pdo->prepare("UPDATE author SET fname = ?, lname = ?, bday = ?, country = ? WHERE id = ?");
        $stmt->execute([$fname, $lname, $bday, $country, $id]);
    }

    public function deleteAuthor(int $id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM author WHERE id = ?");
        $stmt->execute([$id]);
    }
}
