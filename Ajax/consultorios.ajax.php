<?php

require_once "../Controladores/ConsultoriosC.php";
require_once "../Modelos/ConsultoriosM.php";

class AjaxConsultorios{

    /*=============================================
	EDITAR CONSULTORIOS
	=============================================*/	
    public $idConsultorio; //propiedad publica

    //ojo si en el servidor presenta problemas agregar static
    public function ajaxEditarConsultorio(){

        //Despues de lo que esta abajo 
        //Solicitamos al controlador una respuesta con el metodo 

        $columna = "id"; //la columna de la tabla
        $valor = $this ->idConsultorio; //Le pasamos la propiedad

        $respuesta = ConsultoriosC::VerConsultoriosC($columna, $valor);

        echo json_encode($respuesta);

    }

}

    /*=============================================
	EDITAR CONSULTORIOS
	=============================================*/	
//CREAMOS EL OBJETO QUE VA RECIBIR 

if(isset($_POST["idConsultorio"])){ //Si viene la variable post idConsultorio

    //Entonces vamos a ser un objeto a la clase
    //instanciamos
    $consultorio = new AjaxConsultorios();
    //a la propiedad publica le vamos agregar lo que viene en la variable post
    $consultorio -> idConsultorio = $_POST["idConsultorio"];

    //Entonces ejecutamos el metodo o funcion
    $consultorio -> ajaxEditarConsultorio();
 
}