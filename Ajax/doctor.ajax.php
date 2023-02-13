<?php

require_once "../Controladores/DoctoresC.php";
require_once "../Modelos/DoctoresM.php";

class AjaxDoctores{


    /*=============================================
	EDITAR Doctores
	=============================================*/	
    public $idDoctor; //propiedad publica

    //ojo si en el servidor presenta problemas agregar static
    public function ajaxEditarDoctor(){//metodo

        //Despues de lo que esta abajo 
        //Solicitamos al controlador una respuesta con el metodo 

        $columna = "id"; //la columna de la tabla
        $valor = $this ->idDoctor; //Le pasamos la propiedad

        $respuesta = DoctoresC::VerDoctorC($columna, $valor);

        echo json_encode($respuesta);

    }

}

    /*=============================================
	EDITAR DOCTORES
	=============================================*/	
//CREAMOS EL OBJETO QUE VA RECIBIR 

if(isset($_POST["idDoctor"])){ //Si viene la variable post idDoctor

    //Entonces vamos a ser un objeto a la clase
    //instanciamos
    $doctor = new AjaxDoctores();//instanciamos la clase
    //a la propiedad publica le vamos agregar lo que viene en la variable post
    $doctor -> idDoctor = $_POST["idDoctor"];

    //Entonces ejecutamos el metodo o funcion
    $doctor -> ajaxEditarDoctor();
 
}
