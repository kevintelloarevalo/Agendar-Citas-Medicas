$(".tablas").on("click", ".btnEditarPaciente", function(){
    //vamos almacenar lo que traiga esa clase 
    var idPaciente = $(this).attr("idPaciente");
    //Solicitar con ajax que nos traiga una respuesta
    //Del id que estamos capturando de ese campo
    var datos =  new FormData(); // con ajax vamos a tener una respuesta
    //Le pasamos entonces
    //Una variable POST Y Le agregamos como valor lo que 
    //estamos capturando en la variable idPaciente
    datos.append("idPaciente", idPaciente);

    $.ajax({

        url: "ajax/pacientes.ajax.php",
        //HACEMOS EL METODO POST
        method: "POST",
        data:datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType:"json",
        
        success: function(respuesta){

            //console.log("Respuesta",respuesta);

            // mostramos  de acuerdo al id de ese campo con JS.
            //lo que obtuvimos con ajax

            $("#idPaciente").val(respuesta["id"]);
            $("#editarNombre").val(respuesta["nombre"]);
            $("#editarApellido").val(respuesta["apellido"]);
            $("#editarUsuario").val(respuesta["usuario"]);
            $("#editarPassword").val(respuesta["clave"]);
            $("#editarDocumento").val(respuesta["documento"]);
            $("#editarGenero").html(respuesta["sexo"]);
            $("#editarGenero").val(respuesta["sexo"]);
        }

    })
})

//EDITARMIPERFILCOMPLETO
$(".tablas").on("click", ".btnEditarPacienteModal", function(){
    //vamos almacenar lo que traiga esa clase 
    var idPaciente = $(this).attr("idPaciente");
    //Solicitar con ajax que nos traiga una respuesta
    //Del id que estamos capturando de ese campo
    var datos =  new FormData(); // con ajax vamos a tener una respuesta
    //Le pasamos entonces
    //Una variable POST Y Le agregamos como valor lo que 
    //estamos capturando en la variable idPaciente
    datos.append("idPaciente", idPaciente);

    $.ajax({

        url: "ajax/pacientes.ajax.php",
        //HACEMOS EL METODO POST
        method: "POST",
        data:datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType:"json",
        
        success: function(respuesta){

            //console.log("Respuesta",respuesta);

            // mostramos  de acuerdo al id de ese campo con JS.
            //lo que obtuvimos con ajax

            $("#idPaciente").val(respuesta["id"]);
            $("#editarNombre").val(respuesta["nombre"]);
            $("#editarApellido").val(respuesta["apellido"]);
            $("#editarUsuario").val(respuesta["usuario"]);
            $("#editarPassword").val(respuesta["clave"]);
            $("#editarDocumento").val(respuesta["documento"]);
            $("#editarGenero").html(respuesta["sexo"]);
            $("#editarGenero").val(respuesta["sexo"]);
            $("#fotoActual").val(respuesta["foto"]);

			if(respuesta["foto"] != ""){

				$(".previsualizar").attr("src", respuesta["foto"]);

			}
        }

    })
})



//ELIMINAR DOCTOR
$(".tablas").on("click", ".btnEliminarPaciente", function(){

    //Almacenamos lo que traiga esa clase de los input
    var idPaciente = $(this).attr("idPaciente");

    var fotoPaciente = $(this).attr("fotoPaciente");
    
    //ALERTA SUAVE
    swal({
        title: '¿Está seguro de borrar al paciente?',
        text: "¡Si no lo está puede cancelar la acción!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar paciente!'
    }).then(function(result){
        

        if(result.value){

            window.location = "index.php?url=pacientes&idPaciente="+idPaciente+"&fotoPaciente="+fotoPaciente;

        }

    })

})