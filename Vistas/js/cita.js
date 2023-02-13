// ELIMINAR DOCTOR
$(".tablas").on("click", ".btnEliminarCita", function(){
    //vamos almacenar lo que traiga esa clase 
    var idCita = $(this).attr("idCita");
    //ALERTA SUAVE
    swal({
        title: '¿Está seguro de cancelar la cita?',
        text: "¡Si no lo está puede cancelar la acción!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar cita!'
    }).then(function(result){

        if(result.value){

            window.location = "index.php?url=historialDoctor&idCita="+idCita;

        }

    })


})