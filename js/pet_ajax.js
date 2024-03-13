
$(document).ready(function() {
    // Carga dinámica de contenido en el modal al mostrarse
    $(document).on('show.bs.modal', '#myModal', function(e) {
        var button = $(e.relatedTarget); // Botón que disparó el modal
        var contentUrl = button.data('url'); // URL del contenido

        $.ajax({
            url: contentUrl,
            method: 'GET',
            success: function(data) {
                $('#myModal .modal-body').html(data); // Inserta el contenido en el modal
            },
            error: function() {
                alert('Error cargando el formulario.');
            }
        });
    });
    
});

