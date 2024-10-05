// validaciones.js

document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form");

    form.addEventListener("submit", function (e) {
        let isValid = true;
        const textInput = document.querySelector("#text");
        if (textInput && textInput.value.trim() === "") {
            alert("Por favor, introduce un texto válido para encriptar.");
            isValid = false;
        }

        const fileInput = document.querySelector("#file");
        if (fileInput && fileInput.files.length === 0) {
            alert("Por favor, selecciona un archivo.");
            isValid = false;
        }

        if (!isValid) {
            e.preventDefault();
        }
    });
});
