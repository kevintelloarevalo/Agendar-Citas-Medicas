<?php

require_once "../Controladores/PacientesC.php";
require_once "../Modelos/PacientesM.php";


class AjaxPacientes{
   /*=============================================
	EDITAR Pacientes
	=============================================*/	
    public $idPaciente; //Propiedad publica
    //ojo si en el servidor presenta problemas agregar static
    public function ajaxEditarPaciente(){//metodo    
    
        $columna = "id"; //la columna de la tabla
        $valor = $this ->idPaciente; //Le pasamos la propiedad
        
        $respuesta = PacientesC::VerPacienteC($columna, $valor);

        echo json_encode($respuesta);        
    
    }
}
   /*=============================================
	EDITAR Pacientes
	=============================================*/	
//CREAMOS EL OBJETO QUE VA RECIBIR LA PROPIEDAD PUBLICA

if (isset($_POST["idPaciente"])){ //Si viene la variable post idPaciente
    //Entonces vamos a ser un objeto a la clase

    $paciente = new AjaxPacientes();//instanciamos la clase
    //a la propiedad publica le vamos agregar lo que viene en la variable post    
    $paciente -> idPaciente = $_POST["idPaciente"];
    //Entonces ejecutamos el metodo o funcion
    $paciente -> ajaxEditarPaciente();

}