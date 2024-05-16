var modal = $("#myModal");
var closeModal = $("#closeModal");
var generarButton = $("#generarButton");

// Función para generar el QR
function generarQR() {
    // URL de Facebook (puedes cambiarlo según tu perfil o página)
    var id = $("#id_recluta").val();
    var url = "http://10.206.173.188/reclutamiento/view/formulario.php?id=" + id;

    // Obtén el contenedor del QR
    var qrContainer = $("#qrContainer");

    // Limpia el contenido del contenedor antes de generar un nuevo código QR
    qrContainer.html("");

    // Genera el código QR
    qrContainer.qrcode({
        width: 200,
        height: 200,
        text: url,
    });

    // Muestra la ventana modal
    modal.show();
}

// Agrega un listener al botón para llamar a la función generarQR cuando sea clickeado
generarButton.click(generarQR);

// Cierra la ventana modal y desmarca el checkbox al hacer clic en la "x"
closeModal.click(function () {
    modal.hide();
});

// Cierra la ventana modal al hacer clic fuera de ella
$(window).click(function (event) {
    if (event.target === modal[0]) {
        modal.hide();
    }
});

