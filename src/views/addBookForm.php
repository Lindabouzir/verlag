<h2>Buch hinzufügen</h2>
<form action="index.php?action=saveBook" method="post">
    ISBN: <input type="text" name="isbn"><br>
    Veröffentlichungsdatum: <input type="date" name="publication_date"><br>
    Seitenanzahl: <input type="number" name="pages"><br>
    Titel: <input type="text" name="title"><br>
    Preis: <input type="number" step="0.01" name="price"><br>
    Kategorie: <input type="text" name="category"><br>
    Hardcover: <input type="checkbox" name="hardcover" value="1"><br>
    Autor ID: <input type="number" name="author_id"><br>
    <input type="submit" value="Speichern">
</form>
