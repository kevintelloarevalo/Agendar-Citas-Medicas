/*=============================================
SUBIENDO LA FOTO DE LA Doctor
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

$(document).on("click", ".btnEditarDoctor", function(){
    //vamos almacenar lo que traiga esa clase 
    var idDoctor = $(this).attr("idDoctor");
    
    //Solicitar con ajax que nos traiga una respuesta
    //Del id que estamos capturas de ese campo
    var datos =  new FormData(); // con ajax vamos a tener una respuesta
    //Le pasamos entonces
    //Una variable POST Y Le agregamos como valor lo que 
    //estamos capturando en la variable idDoctor
    datos.append("idDoctor", idDoctor);

    $.ajax({
        url: "ajax/doctor.ajax.php",
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
            
            
            $("#idDoctor").val(respuesta["id"]);
            $("#editarNombre").val(respuesta["nombre"]);
            $("#editarApellido").val(respuesta["apellido"]);
            $("#editarUsuario").val(respuesta["usuario"]);
            $("#editarPassword").val(respuesta["clave"]);

            $("#editarGenero").html(respuesta["sexo"]);
            $("#editarGenero").val(respuesta["sexo"]);
        }

    })
})


// editar Perfil Completo 

$(document).on("click", ".btnEditarDoctorModal", function(){
    //vamos almacenar lo que traiga esa clase 
    var idDoctor = $(this).attr("idDoctor");
    
    //Solicitar con ajax que nos traiga una respuesta
    //Del id que estamos capturas de ese campo
    var datos =  new FormData(); // con ajax vamos a tener una respuesta
    //Le pasamos entonces
    //Una variable POST Y Le agregamos como valor lo que 
    //estamos capturando en la variable idDoctor
    datos.append("idDoctor", idDoctor);

    $.ajax({
        url: "ajax/doctor.ajax.php",
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
            
            
            $("#idDoctor").val(respuesta["id"]);
            $("#editarNombre").val(respuesta["nombre"]);
            $("#editarApellido").val(respuesta["apellido"]);
            $("#editarUsuario").val(respuesta["usuario"]);
            $("#editarPassword").val(respuesta["clave"]);
            $("#editarHoraE").val(respuesta["horarioE"]);
            $("#editarHoraS").val(respuesta["horarioS"]);
            $("#editarGenero").html(respuesta["sexo"]);
            $("#editarGenero").val(respuesta["sexo"]);
            $("#fotoActual").val(respuesta["foto"]);

            if(respuesta["foto"] != ""){

				$(".previsualizar").attr("src", respuesta["foto"]);

			}
        }

    })
})

// ELIMINAR DOCTOR
$(".tablas").on("click", ".btnEliminarDoctor", function(){
    //vamos almacenar lo que traiga esa clase 
    var idDoctor = $(this).attr("idDoctor");
    var fotoDoctor = $(this).attr("fotoDoctor");
    //ALERTA SUAVE
    swal({
        title: '¿Está seguro de borrar al doctor?',
        text: "¡Si no lo está puede cancelar la acción!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar doctor!'
    }).then(function(result){

        if(result.value){

            window.location = "index.php?url=doctores&idDoctor="+idDoctor+"&fotoDoctor="+fotoDoctor;

        }

    })


})



//SELECCIONAR DOCTOR
$(".btnID").click(function(){
    //vamos almacenar lo que traiga esa clase 
    var idDoctor = $(this).attr("idDoctor");
    //ALERTA SUAVE
    swal({
        title: '¿Está seguro de agendar una cita?',
        text: "¡Si no lo está puede cancelar la acción!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, continuar!'
    }).then(function(result){

        if(result.value){

            window.location = "index.php?url=Doctor&idDoctor="+idDoctor;

        }

    })


})

