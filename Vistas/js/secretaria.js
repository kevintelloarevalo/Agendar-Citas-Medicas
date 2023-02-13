/*=============================================
SUBIENDO LA FOTO DE LA SECRETARIA
=============================================*/
$(".nuevaFoto").change(function(){

	var imagen = this.files[0];
	
	/*=============================================
  	VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
  	=============================================*/

  	if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){

  		$(".nuevaFoto").val("");

  		 swal({
		      title: "Error al subir la imagen",
		      text: "¡La imagen debe estar en formato JPG o PNG!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });

  	}else if(imagen["size"] > 2000000){

  		$(".nuevaFoto").val("");

  		 swal({
		      title: "Error al subir la imagen",
		      text: "¡La imagen no debe pesar más de 2MB!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });

  	}else{

  		var datosImagen = new FileReader;
  		datosImagen.readAsDataURL(imagen);

  		$(datosImagen).on("load", function(event){

  			var rutaImagen = event.target.result;

  			$(".previsualizar").attr("src", rutaImagen);

  		})

  	}
})

//EDITAR SECRETARIA MODAL BOTON EDITAR // COMPLETO DESDE EL PERFIL SECRETARIA
$(document).on("click", ".btnEditarSecretariaRol", function(){

	var idSecretaria = $(this).attr("idSecretaria"); // esa variable en el atributo idSecretaria


    var datos = new FormData();
	datos.append("idSecretaria", idSecretaria);

	$.ajax({

		url:"Ajax/secretarias.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){ //lo que venga de la bdd
			
			$("#idSecretaria").val(respuesta["id"]);
			$("#editarUsuario").val(respuesta["usuario"]);
			$("#editarPassword").val(respuesta["clave"]);
			$("#editarNombre").val(respuesta["nombre"]);
			$("#editarApellido").val(respuesta["apellido"]);
			$("#fotoActual").val(respuesta["foto"]);


			
			if(respuesta["foto"] != ""){

				$(".previsualizar").attr("src", respuesta["foto"]);

			}

		}

	});

})

//iniciar el script cuando damos click
//EDITAR SECRETARIA DESDE ADMINISTRADOR
$(document).on("click", ".btnEditarSecretaria", function(){

	var idSecretaria = $(this).attr("idSecretaria"); // esa variable en el atributo idSecretaria

	//console.log("Respuesta", idSecretaria);

    var datos = new FormData();
	datos.append("idSecretaria", idSecretaria);

	$.ajax({

		url:"Ajax/secretarias.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){ //lo que venga de la bdd
			
			$("#idSecretaria").val(respuesta["id"]);
			$("#editarUsuario").val(respuesta["usuario"]);
			$("#editarPassword").val(respuesta["clave"]);
			$("#editarNombre").val(respuesta["nombre"]);
			$("#editarApellido").val(respuesta["apellido"]);
			
			//traemos los datos con AJAX 
		}

	});


})

//ELIMINAR SECRETAROA
$(".tablas").on("click", ".btnEliminarSecretaria", function(){

    //Almacenamos lo que traiga esa clase de los input
    var idSecretaria = $(this).attr("idSecretaria");

    var fotoSecretaria = $(this).attr("fotoSecretaria");
    
    //ALERTA SUAVE
    swal({
        title: '¿Está seguro de borrar a la secretaria?',
        text: "¡Si no lo está puede cancelar la acción!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar secretaria!'
    }).then(function(result){
        

        if(result.value){

            window.location = "index.php?url=secretarias&idSecretaria="+idSecretaria+"&fotoSecretaria="+fotoSecretaria;

        }

    })

})