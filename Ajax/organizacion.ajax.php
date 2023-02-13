<?php

require_once "../Controladores/OrganizacionC.php";
require_once "../Modelos/OrganizacionM.php";

class AjaxOrganizacion{

	/*=============================================
	EDITAR Organizacion
	=============================================*/	

	public $idOrganizacion;

	public function ajaxEditarOrganizacion(){

		$item = "id";
		$valor = $this->idOrganizacion;

		$respuesta = OrganizacionC::VerOrganizacionC($item, $valor);


		echo json_encode($respuesta);

	}
}


    /*=============================================
    EDITAR Organizacion
    =============================================*/
    if(isset($_POST["idOrganizacion"])){    //mientras no mandemos el id no se hara el resto

        $editar = new AjaxOrganizacion();
        $editar -> idOrganizacion = $_POST["idOrganizacion"];
        $editar -> ajaxEditarOrganizacion();

    }


