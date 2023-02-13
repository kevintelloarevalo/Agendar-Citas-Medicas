
//EDITARMIPERFIL
$(".tablas").on("click", ".btnEditarOrganizacion", function(){
    //vamos almacenar lo que traiga esa clase 
    var idOrganizacion = $(this).attr("idOrganizacion");
    

    
    //Solicitar con ajax que nos traiga una respuesta
    //Del id que estamos capturando de ese campo
    var datos =  new FormData(); // con ajax vamos a tener una respuesta
    //Le pasamos entonces
    //Una variable POST Y Le agregamos como valor lo que 
    //estamos capturando en la variable idPaciente
    datos.append("idOrganizacion", idOrganizacion);

    $.ajax({

        url: "ajax/organizacion.ajax.php",
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

            $("#idOrganizacion").val(respuesta["id"]);
            $("#editarNombre").val(respuesta["nombre"]);
            $("#editarRuc").val(respuesta["ruc"]);
            $("#editarTelefono").val(respuesta["telefono"]);
            $("#editarDireccion").val(respuesta["direccion"]);
            $("#editarCorreo").val(respuesta["correo"]);
            $("#editarHoraE").val(respuesta["horarioE"]);
            $("#editarHoraS").val(respuesta["horarioS"]);

            $("#fotoActual").val(respuesta["logo"]);
            

			if(respuesta["logo"] != ""){

				$(".previsualizar").attr("src", respuesta["logo"]);

			}
        }

    })
})
