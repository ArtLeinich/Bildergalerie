window.onload = function() {
    // Ereignis-Handler für die Auswahl eines Bildes (beim Hochladen)
    document.getElementById('imageInput').addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                // Bildvorschau anzeigen
                const previewImage = document.getElementById('previewImage');
                previewImage.src = event.target.result;
                document.getElementById('previewContainer').style.display = 'block'; // Vorschau-Container anzeigen
            }
            reader.readAsDataURL(file); // Bild als Data URL lesen
        }
    });

    // Alle Bilder in der Galerie finden und Event-Handler hinzufügen
    var galleryImages = document.getElementsByClassName('gallery-image');
    for (var i = 0; i < galleryImages.length; i++) {
        galleryImages[i].onclick = function() {
            openModal(this.src); // Modal mit dem Bildpfad öffnen
        }
    }

    // Funktion zum Öffnen des modalen Fensters
    function openModal(src) {
        var modal = document.getElementById("myModal");
        var modalImg = document.getElementById("modalImage"); // Bild im modal setzen
        var captionText = document.getElementById("caption");

        modal.style.display = "flex"; // Modal sichtbar machen (flex für zentrierung)
        modalImg.src = src; // Bildquelle im modal setzen
        captionText.innerHTML = ""; // Optional: Bildunterschrift hinzufügen
    }

    // Schließen des modalen Fensters
    var span = document.getElementsByClassName("close")[0];
    span.onclick = function() {
        var modal = document.getElementById("myModal");
        modal.style.display = "none"; // Modal schließen
    }

    // Modal schließen, wenn außerhalb des Bildes geklickt wird
    window.onclick = function(event) {
        var modal = document.getElementById("myModal");
        if (event.target == modal) {
            modal.style.display = "none"; // Modal schließen
        }
    }
}
