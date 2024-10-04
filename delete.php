<?php
// Überprüfen, ob eine zu löschende Datei gesendet wurde
if (isset($_POST['delete'])) {
    $fileToDelete = $_POST['delete'];

    // Versuch, die Datei zu löschen
    if (unlink($fileToDelete)) {
        echo "Die Datei wurde erfolgreich gelöscht.";
        // Nach erfolgreichem Löschen zur Indexseite weiterleiten
        header("Location: index.php");
        exit;
    } else {
        echo "Fehler beim Löschen der Datei.";
    }
}
?>
