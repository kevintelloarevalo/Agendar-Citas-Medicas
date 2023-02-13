
/*=============================================
EDITAR CONSULTORIO 
=============================================*/
$(".tablas").on("click", ".btnEditarConsultorio", function(){

    var idConsultorio = $(this).attr("idConsultorio"); //vamos almacenar lo que traiga esa clase 
    console.log("Respuesta",idConsultorio);
    //Solicitar con ajax que nos traiga una respuesta
    //Del id que estamos capturas de ese campo
    var datos =  new FormData(); // con ajax vamos a tener una respuesta

    //Le pasamos entonces
    //Una variable POST Y Le agregamos como valor lo que 
    //estamos capturando en la variable idConsultorio
    datos.append("idConsultorio", idConsultorio);
    
    $.ajax({
        url: "Ajax/consultorios.ajax.php",
        //HACEMOS EL METODO POST
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType:"json",

        success: function(respuesta){

            // mostramos  de acuerdo al id de ese campo con JS.
            //lo que obtuvimos con ajax
            $("#editarConsultorio").val(respuesta["nombre"]);
            $("#idConsultorio").val(respuesta["id"]);

            
        }

    })
    
})


/*=============================================
ELIMINAR CONSULTORIO 
=============================================*/
$(".tablas").on("click", ".btnEliminarConsultorio", function(){
    var idConsultorio = $(this).attr("idConsultorio");
//KEVIN RECUERDO ESTA CREANDO UNA VARIABLE QUE CAPTURA TODO LO QUE TIENE ESA CLASE QUE
//CREASTE EN EL BOTON idConsultorio //No te olvides !!
    swal({
        title: '¿Está seguro de borrar el consultorio?',
        text: "¡Si no lo está puede cancelar la acción!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar consultorio!'
    }).then(function(result){

        if(result.value){

            window.location = "index.php?url=consultorios&idConsultorio="+idConsultorio;

        }

    })

})