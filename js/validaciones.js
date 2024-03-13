function validateaulaeditar() {
    var nombre = document.getElementById("nombre").value;
    var capacidad = document.getElementById("capacidad").value;

    if (nombre === "" || capacidad === "") {
        alert("Por favor, complete todos los campos.");
        return false;
    }

    if (capacidad <= 0) {
        alert("La capacidad debe ser un número entero positivo.");
        return false;
    }

    return true;
}

function validateFormAddCarrera() {
    var nombreCarrera = document.getElementsByName("nombre_carrera")[0].value.trim();

    if (nombreCarrera === "") {
        alert("Por favor, ingrese el nombre de la carrera.");
        return false;
    }

    return true;
}