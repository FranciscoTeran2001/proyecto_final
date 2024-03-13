function crearDiv() {
    // Obtener el valor seleccionado del campo de selección
    var selectedNrc = document.getElementById("nrcSelect").value;

    // Crear un nuevo objeto XMLHttpRequest
    var xhr = new XMLHttpRequest();

    // Configurar la solicitud
    xhr.open("GET", "detalle_nrc.php?idNrc=" + selectedNrc, true);

    // Configurar la función de devolución de llamada
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Obtener la respuesta del servidor
            var detallesNrc = xhr.responseText;

            // Crear un nuevo div con los detalles del NRC seleccionado
            var nuevoDiv = document.createElement("div");
            nuevoDiv.classList.add("detalle-nrc");
            nuevoDiv.innerHTML = detallesNrc;

            // Obtener el código NRC correspondiente al ID NRC seleccionado
            var codigoNrc = document.querySelector("#nrcSelect option[value='" + selectedNrc + "']").textContent;

            // Crear el div para los nrc
            var nrcDiv = document.createElement("div");
            nrcDiv.classList.add("nrc");
            nrcDiv.setAttribute("draggable", "true");
            nrcDiv.textContent = "NRC " + codigoNrc; // Mostrar el código NRC en lugar del ID NRC

            // Agregar el evento de arrastrar al div del NRC
            nrcDiv.addEventListener('dragstart', dragStart);
            nrcDiv.addEventListener('dragend', dragEnd);

            // Crear el botón de eliminación
            var closeButton = document.createElement("span");
            closeButton.classList.add("close-button");
            closeButton.innerHTML = "&times;"; // Carácter X

            // Agregar el evento de clic al botón de eliminación
            closeButton.addEventListener('click', function () {
                nuevoDiv.remove();
            });

            // Agregar el botón de eliminación al nuevo div
            nuevoDiv.appendChild(closeButton);

            // Agregar el div de nrc al nuevo div
            nuevoDiv.appendChild(nrcDiv);

            // Agregar el nuevo div al documento
            document.getElementById("detalleNrc").appendChild(nuevoDiv);
        }
    };

    // Enviar la solicitud
    xhr.send();
}


const nrcs = document.querySelectorAll('.nrc');
const horas = document.querySelectorAll('.hora');

nrcs.forEach(nrc => {
    nrc.addEventListener('dragstart', dragStart);
    nrc.addEventListener('dragend', dragEnd);
});

horas.forEach(hora => {
    hora.addEventListener('dragover', dragOver);
    hora.addEventListener('dragenter', dragEnter);
    hora.addEventListener('dragleave', dragLeave);
    hora.addEventListener('drop', drop);
});

let nrcArrastrado = null;

function dragStart() {
    nrcArrastrado = this;
    nrcArrastrado.classList.add('dragging');
}

function dragEnd() {
    nrcArrastrado.classList.remove('dragging');
    nrcArrastrado = null;
}

function dragOver(e) {
    e.preventDefault();
}

function dragEnter(e) {
    e.preventDefault();
    this.style.backgroundColor = '#f5f5f5';
}

function dragLeave() {
    this.style.backgroundColor = 'inherit';
}

function drop() {
    // Create a new div for the dropped NRC 
    const nrcDiv = document.createElement('div');
    nrcDiv.classList.add('nrc');
    nrcDiv.setAttribute('draggable', 'true');
    nrcDiv.textContent = nrcArrastrado.textContent;

    // Create a close button for the NRC
    const closeButton = document.createElement('span');
    closeButton.textContent = 'x';
    closeButton.classList.add('close-button');
    closeButton.addEventListener('click', function () {
        nrcDiv.remove();
    });

    // Add drag event listeners to the new NRC div
    nrcDiv.addEventListener('dragstart', dragStart);
    nrcDiv.addEventListener('dragend', dragEnd);

    // Append the close button to the NRC div
    nrcDiv.appendChild(closeButton);

    // Append the NRC div to the drop target (this)
    this.appendChild(nrcDiv);

    // Reset background color
    this.style.backgroundColor = 'inherit';
}
function actualizarHorario() {
    var aulaSeleccionada = document.getElementById("aulaSelect").value;
    var periodoSeleccionado = document.getElementById("periodoSelect").value;

    // Realizar una solicitud AJAX para obtener los datos del horario según el aula y el periodo seleccionados
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "obtener_horario.php?aula=" + aulaSeleccionada + "&periodo=" + periodoSeleccionado, true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var horarioData = JSON.parse(xhr.responseText);
            actualizarTablaHorario(horarioData);
        }
    };
    xhr.send();
}

function actualizarTablaHorario(horarioData) {
    // Limpia la tabla de horario antes de agregar nuevos datos
    var tablaHorario = document.getElementById("horario");
    tablaHorario.innerHTML = "";

    // Agrega las filas y columnas según los datos recibidos
    // Aquí debes procesar los datos recibidos y agregar las filas y columnas a la tabla
}

function guardarHorario() {
    var id_fh = obtenerIdHorario();
    var id_fd = obtenerIdDia();
    var id_nrc = document.getElementById("nrcSelect").value;
    var id_aula = document.getElementById("aulaSelect").value;
    var id_periodo = document.getElementById("periodoSelect").value;

    // Realizar una solicitud AJAX para enviar los datos al script de PHP
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "guardar_horario.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Manejar la respuesta del servidor (puede ser mostrar un mensaje de éxito o limpiar la tabla de horario)
            alert(xhr.responseText);
            // Limpiar la tabla de horario
            limpiarHorario();
        }
    };

    // Convertir los datos del horario a una cadena de consulta
    var data = "id_fh=" + id_fh + "&id_fd=" + id_fd + "&id_nrc=" + id_nrc + "&id_aula=" + id_aula + "&id_periodo=" + id_periodo;
    xhr.send(data);
}