<?php

class OrganizacionC{
    static public function VerOrganizacionC($columna, $valor){

        $tablaBD ="empresa";

        $resultado = OrganizacionM::VerOrganizacionM($tablaBD, $columna, $valor);
        
        return $resultado;

    }


	/*=============================================
	EDITAR PERFIL MIENTRAS EL ROL ES PACIENTE
	=============================================*/

	static public function EditarOrganizacionC(){

		if(isset($_POST["editarDireccion"])){
			
			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombre"])){

				/*=============================================
				VALIDAR IMAGEN
				=============================================*/

				$ruta = $_POST["fotoActual"];

				if(isset($_FILES["editarFoto"]["tmp_name"]) && !empty($_FILES["editarFoto"]["tmp_name"])){

					list($ancho, $alto) = getimagesize($_FILES["editarFoto"]["tmp_name"]);

					$nuevoAncho = 500;
					$nuevoAlto = 500;

					/*=============================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
					=============================================*/

					$directorio = "Vistas/img/empresa/";

					/*=============================================
					PRIMERO PREGUNTAMOS SI EXISTE OTRA IMAGEN EN LA BD
					=============================================*/

					if(!empty($_POST["fotoActual"])){

						unlink($_POST["fotoActual"]);

					}else{

						mkdir($directorio, 0755);

					}	

					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

					if($_FILES["editarFoto"]["type"] == "image/jpeg"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "Vistas/img/empresa/".$aleatorio.".jpg";

						$origen = imagecreatefromjpeg($_FILES["editarFoto"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $ruta);

					}

					if($_FILES["editarFoto"]["type"] == "image/png"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "Vistas/img/empresa/".$aleatorio.".png";

						$origen = imagecreatefrompng($_FILES["editarFoto"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $ruta);

					}

				}

				$tabla = "empresa";

				$datos = array(
                                "id" => $_POST["idOrganizacion"],
							   "nombre" => $_POST["editarNombre"],
							   "ruc" => $_POST["editarRuc"], //encriptar
							   "telefono" => $_POST["editarTelefono"],
							   "direccion" => $_POST["editarDireccion"],
                               "correo" => $_POST["editarCorreo"],
                               "horarioE" => $_POST["editarHoraE"],
                               "horarioS" => $_POST["editarHoraS"],

							   "logo" => $ruta);

				$respuesta = OrganizacionM::EditarOrganizacionM($tabla, $datos);

				if($respuesta == true){

					echo'<script>

					swal({
						  type: "success",
						  title: "El perfil de la Empresa ha sido editado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "configuracion";

									}
								})

					</script>';

				}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El nombre no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "configuracion";

							}
						})

			  	</script>';

			}
		
		}

	}


}
