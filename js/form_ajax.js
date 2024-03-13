$(document).ready(function () {
    // Carga dinámica de contenido en el modal al mostrarse
    $(document).on('show.bs.modal', '#forModal', function (e) {
        var button = $(e.relatedTarget); // Botón que disparó el modal
        var contentUrl = button.data('url'); // URL del contenido
        $.ajax({
            url: contentUrl,
            method: 'GET',
            success: function (data) {
                $('#forModal .modal-body').html(data); // Inserta el contenido en el modal

                // Manejo del envío del formulario mediante AJAX
                $('#forModal form').on('submit', function (e) {
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
                            $('#forModal .modal-body').html('');
                            $('#forModal .modal-body').html(response);
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

    // Recargar la página al enviar el formulario
    $(document).on('submit', '#forModal form', function () {
        $('#forModal').modal('hide');
        location.reload();
    });
});