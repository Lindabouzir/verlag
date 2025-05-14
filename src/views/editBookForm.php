<h2>Buch bearbeiten</h2>
<form action="index.php?action=updateBook" method="post">
    <input type="hidden" name="id" value="<?= $book->getId() ?>">
    ISBN: <input type="text" name="isbn" value="<?= $book->getIsbn() ?>"><br>
    Veröffentlichungsdatum: <input type="date" name="publication_date" value="<?= $book->getPublicationDate() ?>"><br>
    Seitenanzahl: <input type="number" name="pages" value="<?= $book->getPages() ?>"><br>
    Titel: <input type="text" name="title" value="<?= $book->getTitle() ?>"><br>
    Preis: <input type="text" name="price" value="<?= $book->getPrice() ?>"><br>
    Kategorie: <input type="text" name="category" value="<?= $book->getCategory() ?>"><br>
    Hardcover: <input type="checkbox" name="hardcover" value="1" <?= $book->getHardcover() ? 'checked' : '' ?>><br>
    Autor ID: <input type="number" name="author_id" value="<?= $book->getAuthorId() ?>"><br>
    <input type="submit" value="Speichern">
</form>
