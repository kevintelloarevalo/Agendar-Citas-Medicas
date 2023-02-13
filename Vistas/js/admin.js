//EDITARMIPERFILCOMPLETO
$(document).on("click", ".btnEditarAdministradorModal", function(){
    //vamos almacenar lo que traiga esa clase 
    var idAdministrador = $(this).attr("idAdministrador");


    //Solicitar con ajax que nos traiga una respuesta
    //Del id que estamos capturando de ese campo
    var datos =  new FormData(); // con ajax vamos a tener una respuesta
    //Le pasamos entonces
    //Una variable POST Y Le agregamos como valor lo que 
    //estamos capturando en la variable idPaciente
    datos.append("idAdministrador", idAdministrador);

    $.ajax({

        url: "Ajax/administradores.ajax.php",
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
            $("#idAdministrador").val(respuesta["id"]);
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