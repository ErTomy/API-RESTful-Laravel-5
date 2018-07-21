/************  functiones generales de la aplicación  *************************/

var Aplicacion = {
    form:null,
    resultadoAjax:function(){},
    avisoAjax:function(aviso){
        $('<div>', {'class':'alert'})
            .addClass( (aviso.result)?'alert-success':'alert-danger' )
            .html(aviso.message)
            .appendTo( (Aplicacion.form == null)?'body':Aplicacion.form )
            .delay(6000)
            .queue(function() {
                $(this).remove();
            });
    }
};

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ajaxError(function( event, request, settings ) {
    if(request.responseJSON.hasOwnProperty('errors')){
        var errores = [];
        $.each(request.responseJSON.errors, function(i, item) {
            $('input[name="'+i+'"]').addClass('is-invalid').keypress(function(){
                $(this).removeClass('is-invalid');
            });
            errores.push(item);
        });
        Aplicacion.avisoAjax({'result':false, 'message':errores.join('<br />')});
    }
}).ready(function() {
    $('.ajaxSubmit').submit(function(event) {
        event.stopPropagation();
        event.preventDefault();
        $.ajax({
            method: 'POST',
            url: $(this).attr('action'),
            dataType: 'json',
            data: $(this).serializeArray(),
            cache: false,
        }).done(function(resultado) {
            Aplicacion.resultadoAjax(resultado);
        });
    });
});

