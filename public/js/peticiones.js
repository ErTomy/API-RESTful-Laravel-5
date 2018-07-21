$( document ).ready(function() {

    Aplicacion.form = $('div.card');

    $('input.btn').click(function(){
        if($(this).data('accion') !== undefined){
            $('input[name="accion"]').val($(this).data('accion'));
        }
    });

    $('.btnDetalle').click(function(e){
        e.preventDefault();
        Aplicacion.form = $('#formPeticion');
        var id = $(this).closest('div.row').data('id');
        $.ajax({
            url: $('#formPeticion').attr('action') + '/' + id,
            method: 'GET'
        }).done(function(resultado) {
            $('input[name="id"]').val(resultado.data.id);
            $('input[name="direccion"]').val(resultado.data.direccion);
            $('input[name="fecha_entrega"]').val(resultado.data.fecha_entrega);
            $('select[name="hora_desde"] option[value="'+resultado.data.hora_desde+'"]').prop('selected', 'selected');
            $('select[name="hora_hasta"] option[value="'+resultado.data.hora_hasta+'"]').prop('selected', 'selected');
            $('select[name="conductor_id"] option[value="'+resultado.data.conductor.id+'"]').prop('selected', 'selected');
            $('#peticionModal').modal('show');
            Aplicacion.resultadoAjax = function(resultado){
                $('#peticionModal').modal('hide');
                Aplicacion.form = $('div.card');
                Aplicacion.avisoAjax(resultado);
                var $row = $('.card .card-body .row[data-id="'+id+'"]');
                if($('input[name="accion"]').val() == 'save'){
                    $row.find('.laFecha').text($('input[name="fecha_entrega"]').val());
                    $row.find('.laDireccion').text($('input[name="direccion"]').val());
                    $row.find('.elNombre').text($('select[name="conductor_id"] option:selected').text());
                }else{
                    $row.remove();
                }
            };
        });
    });

});