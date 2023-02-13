<?php

require_once "../Controladores/AdministradoresC.php";
require_once "../Modelos/AdministradoresM.php";


class AjaxAdministradores{
   /*=============================================
	EDITAR Administradores
	=============================================*/	
    public $idAdministrador; //Propiedad publica
    //ojo si en el servidor presenta problemas agregar static
    public function ajaxEditarAdministrador(){//metodo    
    
        $columna = "id"; //la columna de la tabla
        $valor = $this ->idAdministrador; //Le pasamos la propiedad
        
        $respuesta = AdministradoresC::VerAdministradorC($columna, $valor);

        echo json_encode($respuesta);        
    
    }
}
   /*=============================================
	EDITAR Administradores
	=============================================*/	
//CREAMOS EL OBJETO QUE VA RECIBIR LA PROPIEDAD PUBLICA

if (isset($_POST["idAdministrador"])){ //Si viene la variable post idAdministrador
    //Entonces vamos a ser un objeto a la clase

    $administrador = new AjaxAdministradores();//instanciamos la clase
    //a la propiedad publica le vamos agregar lo que viene en la variable post    
    $administrador -> idAdministrador = $_POST["idAdministrador"];
    //Entonces ejecutamos el metodo o funcion
    $administrador -> ajaxEditarAdministrador();

}