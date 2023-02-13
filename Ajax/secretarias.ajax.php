<?php

require_once "../Controladores/SecretariasC.php";
require_once "../Modelos/SecretariasM.php";

class AjaxSecretarias{

	/*=============================================
	EDITAR SECRETARIA
	=============================================*/	

	public $idSecretaria; //VARIABLE PUBLICA

	public function ajaxEditarSecretaria(){

		$item = "id"; //Buscara segun el id 
		$valor = $this->idSecretaria;

		$respuesta = SecretariasC::DatosSecretariaModal($item, $valor);


		echo json_encode($respuesta);

	}
}


    /*=============================================
    EDITAR SECRETARIA
    =============================================*/
    if(isset($_POST["idSecretaria"])){    //mientras no mandemos el id no se hara el resto

        $editar = new AjaxSecretarias();
        $editar -> idSecretaria = $_POST["idSecretaria"];
        $editar -> ajaxEditarSecretaria();

    }


