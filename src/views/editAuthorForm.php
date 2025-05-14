<?php
/** @var \Repository\Author $author */
?>
<h2>Autor bearbeiten</h2>
<form action="index.php?action=updateAuthor" method="post">
    <input type="hidden" name="id" value="<?= $author->getId() ?>">
    Vorname: <input type="text" name="fname" value="<?= $author->getFname() ?>"><br>
    Nachname: <input type="text" name="lname" value="<?= $author->getLname() ?>"><br>
    Geburtstag: <input type="date" name="bday" value="<?= $author->getBday() ?>"><br>
    Land: <input type="text" name="country" value="<?= $author->getCountry() ?>"><br>
    <input type="submit" value="Speichern">
</form>
