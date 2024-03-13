$(document).ready(function () {
    // Carga dinámica de contenido en el modal al mostrarse
    $(document).on('show.bs.modal', '#myModal', function (e) {
        var button = $(e.relatedTarget); // Botón que disparó el modal
        var contentUrl = button.data('url'); // URL del contenido
        $.ajax({
            url: contentUrl,
            method: 'GET',
            success: function (data) {
                $('#myModal .modal-body').html(data); // Inserta el contenido en el modal

                // Manejo del envío del formulario mediante AJAX
                $('#myModal form').on('submit', function (e) {
                    e.preventDefault(); // Evitar el envío convencional del formulario

                    var form = $(this);
                    var formData = form.serialize(); // Serializar los datos del formulario
                    var url = form.attr('action'); // Obtener la URL del atributo 'action'

                    $.ajax({
                        type: 'POST',
                        url: url,
                        data: formData,
                        success: function (response) {
                            // Manejar la respuesta del servidor
                            $('#myModal .modal-body').html('');
                            $('#myModal .modal-body').html(response);
                        },
                        error: function () {
                            alert('Error al enviar el formulario.');
                        }
                    });
                });
            },
            error: function () {
                alert('Error cargando el formulario.');
            }
        });
    });
});