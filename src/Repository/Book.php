<?php

namespace Repository;
use Repository\Auther;
class Book
{
    private $id;
    private $isbn;
    private $publication_date;
    private $pages;
    private $title;
    private $price;
    private $category;
    private $hardcover;
    private $author_id;
    private $author; // ➡️ das ist das Author-Objekt

    public function __construct($id, $isbn, $publication_date, $pages, $title, $price, $category, $hardcover, $author_id)
    {
        $this->id = $id;
        $this->isbn = $isbn;
        $this->publication_date = $publication_date;
        $this->pages = $pages;
        $this->title = $title;
        $this->price = $price;
        $this->category = $category;
        $this->hardcover = $hardcover;
        $this->author_id = $author_id;
    }

    // ➡ Getter
    public function getId() {
        return $this->id;
    }
    public function getIsbn() {
        return $this->isbn;
    }
    public function getPublicationDate() {
        return $this->publication_date;

    }
    public function getPages() {
        return $this->pages;
    }
    public function getTitle() {
        return $this->title;
    }
    public function getPrice() {
        return $this->price;
    }
    public function getCategory() {
        return $this->category;
    }
    public function getHardcover() {
        return $this->hardcover;
    }
    public function getAuthorId() {
        return $this->author_id;
    }

    // ➡ Neuer Setter + Getter für das Author-Objekt
    public function setAuthor(Author $author) {
        $this->author = $author;
    }
    public function getAuthor() {
        return $this->author;
    }

}
