<?php
require_once __DIR__ . '/vendor/autoload.php';
include __DIR__ . '/src/views/nav.php';

use Repository\AuthorRepository;
use Repository\BookRepository;

try {
    $pdo = new PDO('mysql:host=localhost;dbname=verlag;charset=utf8', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $authorRepo = new AuthorRepository($pdo);
    $bookRepo = new BookRepository($pdo);

    $action = $_GET['action'] ?? 'showBooks';  // Standardaktion

    switch ($action) {

        case 'showAuthors':
            $authors = $authorRepo->getAllAuthors();
            echo "<h2>Autoren</h2>";
            echo '<table border="1"><tr>
                <th>ID</th><th>Vorname</th><th>Nachname</th><th>Geburtstag</th><th>Land</th><th>Aktion</th>
              </tr>';
            foreach ($authors as $author) {
                echo '<tr>';
                echo '<td>' . $author->getId() . '</td>';
                echo '<td>' . $author->getFname() . '</td>';
                echo '<td>' . $author->getLname() . '</td>';
                echo '<td>' . $author->getBday() . '</td>';
                echo '<td>' . $author->getCountry() . '</td>';
                echo '<td>
                    <a href="index.php?action=editAuthor&id=' . $author->getId() . '">Bearbeiten</a> |
                    <a href="index.php?action=deleteAuthor&id=' . $author->getId() . '" onclick="return confirm(\'Wirklich löschen?\')">Löschen</a>
                  </td>';
                echo '</tr>';
            }
            echo '</table>';
            break;

        case 'showBooks':
            $books = $bookRepo->getAllBooks();
            echo "<h2>Bücher</h2>";
            echo '<table border="1"><tr>
                <th>ID</th><th>ISBN</th><th>Datum</th><th>Seiten</th><th>Titel</th><th>Preis</th><th>Kategorie</th><th>Hardcover</th><th>Autor ID</th><th>Aktion</th>
              </tr>';
            foreach ($books as $book) {
                echo '<tr>';
                echo '<td>' . $book->getId() . '</td>';
                echo '<td>' . $book->getIsbn() . '</td>';
                echo '<td>' . $book->getPublicationDate() . '</td>';
                echo '<td>' . $book->getPages() . '</td>';
                echo '<td>' . $book->getTitle() . '</td>';
                echo '<td>' . $book->getPrice() . '</td>';
                echo '<td>' . $book->getCategory() . '</td>';
                echo '<td>' . ($book->getHardcover() ? 'Ja' : 'Nein') . '</td>';
                echo '<td>' . $book->getAuthorId() . '</td>';
                echo '<td>
                    <a href="index.php?action=editBook&id=' . $book->getId() . '">Bearbeiten</a> |
                    <a href="index.php?action=deleteBook&id=' . $book->getId() . '" onclick="return confirm(\'Wirklich löschen?\')">Löschen</a>
                  </td>';
                echo '</tr>';
            }
            echo '</table>';
            break;

        case 'addAuthorForm':
            include __DIR__ . '/src/views/addAuthorForm.php';
            break;

        case 'addBookForm':
            include __DIR__ . '/src/views/addBookForm.php';
            break;

        case 'saveAuthor':
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $bday = $_POST['bday'];
            $country = $_POST['country'];
            $authorRepo->addAuthor($fname, $lname, $bday, $country);
            header("Location: index.php?action=showAuthors");
            break;

        case 'saveBook':
            $isbn = $_POST['isbn'];
            $publication_date = $_POST['publication_date'];
            $pages = (int)$_POST['pages'];
            $title = $_POST['title'];
            $price = (float)$_POST['price'];
            $category = $_POST['category'];
            $hardcover = isset($_POST['hardcover']) && $_POST['hardcover'] == '1' ? 1 : 0;
            $author_id = (int)$_POST['author_id'];
            $bookRepo->addBook($isbn, $publication_date, $pages, $title, $price, $category, $hardcover, $author_id);
            header("Location: index.php?action=showBooks");
            break;

        case 'showAuthorsWithBooks':
            $authors = $authorRepo->getAllAuthors();
            echo "<h2>Autoren und ihre Bücher</h2>";
            echo "<table border='1'>";
            echo "<tr><th>ID</th><th>Vorname</th><th>Nachname</th><th>Geburtstag</th><th>Land</th><th>Bücher</th></tr>";
            foreach ($authors as $author) {
                echo "<tr>";
                echo "<td>{$author->getId()}</td>";
                echo "<td>{$author->getFname()}</td>";
                echo "<td>{$author->getLname()}</td>";
                echo "<td>{$author->getBday()}</td>";
                echo "<td>{$author->getCountry()}</td>";
                $books = $bookRepo->getBooksByAuthorId($author->getId());
                echo "<td>";
                foreach ($books as $book) {
                    echo $book->getTitle() . "<br>";
                }
                echo "</td>";
                echo "</tr>";
            }
            echo "</table>";
            break;

        case 'editBook':
            $id = (int)$_GET['id'];
            $book = $bookRepo->getBookById($id);
            include __DIR__ . '/src/views/editBookForm.php';
            break;

        case 'editAuthor':
            $id = (int)$_GET['id'];
            $author = $authorRepo->getAuthorById($id);
            include __DIR__ . '/src/views/editAuthorForm.php';
            break;

        case 'updateBook':
            $id = (int)$_POST['id'];
            $isbn = $_POST['isbn'];
            $publication_date = $_POST['publication_date'];
            $pages = (int)$_POST['pages'];
            $title = $_POST['title'];
            $price = (float)$_POST['price'];
            $category = $_POST['category'];
            $hardcover = isset($_POST['hardcover']) && $_POST['hardcover'] === '1' ? 1 : 0;
            $author_id = (int)$_POST['author_id'];
            $bookRepo->updateBook($id, $isbn, $publication_date, $pages, $title, $price, $category, $hardcover, $author_id);
            header("Location: index.php?action=showBooks");
            break;

        case 'updateAuthor':
            $id = (int)$_POST['id'];
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $bday = $_POST['bday'];
            $country = $_POST['country'];
            $authorRepo->updateAuthor($id, $fname, $lname, $bday, $country);
            header("Location: index.php?action=showAuthors");
            break;

        case 'deleteBook':
            $id = (int)$_GET['id'];
            $bookRepo->deleteBook($id);
            header('Location: index.php?action=showBooks');
            break;

        case 'deleteAuthor':
            $id = (int)$_GET['id'];
            $bookRepo->deleteBooksByAuthorId($id);   // zuerst alle Bücher löschen
            $authorRepo->deleteAuthor($id);          // dann Autor löschen
            header('Location: index.php?action=showAuthors');
            break;
    }

} catch (PDOException $e) {
    echo "Verbindung fehlgeschlagen: " . $e->getMessage();
}
