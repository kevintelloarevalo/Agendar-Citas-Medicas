<?php

class ConsultoriosC{

    //CREAR CONSULTORIOS

    static public function CrearConsultoriosC(){

        if(isset ($_POST["consultorioN"])){
            $tablaBD= "consultorios";
            $consultorio = array( "nombre" => $_POST["consultorioN"]);

            //Que haga una conexión con la función 
            $resultado = ConsultoriosM::CrearConsultoriosM($tablaBD, $consultorio);
            
            if($resultado == true){

				echo'<script>

					swal({
						  type: "success",
						  title: "¡Consultorio agregado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "consultorios";

							}
						})

			  	</script>';
            }

        

        }


    }

	static public function VerConsultoriosC($columna, $valor){

		$tablaBD="consultorios";

		$resultado = ConsultoriosM::VerConsultoriosM($tablaBD, $columna, $valor); // enlazamos al modelo 
		
		return $resultado;  
	}

	static public function EliminarConsultoriosC(){
		
		if(isset($_GET["idConsultorio"])){ //si existe


		
			$tablaBD ="consultorios";

			$id= $_GET["idConsultorio"];

			$resultado = ConsultoriosM::EliminarConsultoriosM($tablaBD, $id);

			if ($resultado == true){
				echo'<script>

					swal({
						type: "success",
						title: "El consultorio ha sido borrada correctamente",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"
						}).then(function(result){
								if (result.value) {

								window.location = "consultorios";

								}
							})

			  	</script>';


			}
		}

	}

	static public function EditarConsultoriosC(){

		if(isset($_POST["editarConsultorio"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ]+$/', $_POST["editarConsultorio"])){

				$tabla = "consultorios";

				$datos = array("nombre"=>$_POST["editarConsultorio"],  //nombre
							   "id"=>$_POST["idConsultorio"]); //id 

				$respuesta = ConsultoriosM::EditarConsultoriosM($tabla, $datos);

				if($respuesta == true){

					echo'<script>

					swal({
						  type: "success",
						  title: "El consultorio ha sido cambiado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "consultorios";

									}
								})

					</script>';

				}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El consultorio no puede ir vacía o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "consultorios";

							}
						})

			  	</script>';

			}

		}

	}
		

}