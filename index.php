<?php
session_start(); 

// Alle hochgeladenen Bilder abrufen
$uploadedImages = glob("images/*.{jpg,jpeg,png,gif}", GLOB_BRACE);
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bildergalerie</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js" defer></script> <!-- Skript einbinden -->
</head>
<body>

<h1>Bildergalerie</h1>

<!-- Formular für das Hochladen von Bildern, sendet die Anfrage an upload.php -->
<form action="upload.php" method="POST" enctype="multipart/form-data">
    <input type="file" name="image" accept="image/*" id="imageInput" required>
    <input type="submit" value="Bild hochladen" name="submit" class="upload-button">
</form>

<!-- Bildvorschau -->
<div id="previewContainer" style="display: none; text-align: center; margin-top: 20px;">
    <h2>Bildvorschau:</h2>
    <img id="previewImage" style="max-width: 150px; max-height: 150px; height: auto; border: 1px solid #ccc;" />
</div>


<!-- Anzeige von Fehlernachrichten -->
<?php
if (isset($_SESSION['error'])) {
    echo '<div class="error-message" style="color: red; text-align: center;">' . $_SESSION['error'] . '</div>';
    unset($_SESSION['error']); // Fehlernachricht nach dem Anzeigen löschen
}
?>

<h2>Hochgeladene Bilder</h2>
<div class="gallery">
    <?php foreach ($uploadedImages as $image): ?>
        <div class="gallery-item">
            <img src="<?php echo $image; ?>" alt="Bild" class="gallery-image">
            <!-- Formular für das Löschen von Bildern, sendet die Anfrage an delete.php -->
            <form action="delete.php" method="POST" class="delete-form">
                <input type="hidden" name="delete" value="<?php echo $image; ?>">
                <button type="submit" class="delete-button">Löschen</button>
            </form>
        </div>
    <?php endforeach; ?>
</div>

<!-- Modal für Bildanzeige -->
<div id="myModal" class="modal" style="display: none;">
    <span class="close">&times;</span>
    <img class="modal-content" id="modalImage">
    <div id="caption"></div>
</div>

</body>
</html>
