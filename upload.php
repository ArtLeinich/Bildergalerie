<?php
session_start(); 

// Zielverzeichnis für das Speichern der Bilder festlegen
$targetDir = "images/";
$targetFile = $targetDir . basename($_FILES["image"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

// Überprüfen, ob die Datei bereits existiert
if (file_exists($targetFile)) {
    $_SESSION['error'] = "Entschuldigung, die Datei existiert bereits.";
    $uploadOk = 0;
}

// Überprüfen der Dateigröße
if ($_FILES["image"]["size"] > 5000000) {
    $_SESSION['error'] = "Entschuldigung, die Datei ist zu groß.";
    $uploadOk = 0;
}

// Überprüfen des Dateiformats
if (!in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
    $_SESSION['error'] = "Entschuldigung, nur JPG, JPEG, PNG und GIF-Dateien sind erlaubt.";
    $uploadOk = 0;
}

// Versuch, die Datei hochzuladen
if ($uploadOk == 0) {
    header("Location: index.php"); // Leitet zurück zur index.php
    exit;
} else {
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
        // Nach erfolgreichem Upload zur Indexseite weiterleiten
        header("Location: index.php");
        exit;
    } else {
        $_SESSION['error'] = "Entschuldigung, es gab einen Fehler beim Hochladen Ihrer Datei.";
        header("Location: index.php");
        exit;
    }
}
?>
