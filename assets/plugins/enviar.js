$(document).ready(function() {

    $(".formulario-contacto").bind("submit", function() {

        $.ajax({
            type: $(this).attr("method"),
            url:  $(this).attr("action"),
            data: $(this).serialize(),
            success: function(respuesta) {
                if(respuesta == 'ok'){
                    $("#alerta").removeClass("hide").removeClass("alert-danger").removeClass("alert-success").addClass("alert-success");
                    $(".respuesta").html("Enviado!");
                    $(".mensaje-alerta").html("Muchas gracias!! Tu mensaje ha sido entregado, pronto nos comunicaremos contigo.");
                }else{
                    $("#alerta").removeClass("hide").removeClass("alert-danger").removeClass("alert-success").addClass("alert-danger");
                    $(".respuesta").html("Error al enviar!");
                    $(".mensaje-alerta").html("No se pudo enviar tu mensaje, intentalo de nuevo.");  
                }

            },
            error: function() {
                $("#alerta").removeClass("hide").removeClass("alert-danger").removeClass("alert-success").addClass("alert-danger");
                $(".respuesta").html("Error al enviar!");
                $(".mensaje-alerta").html("No se pudo enviar tu mensaje, intentalo de nuevo.");
            }
        });

        return false;
    });
});