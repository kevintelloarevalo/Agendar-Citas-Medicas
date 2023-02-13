<?php

class SecretariasC{

	//Ingreso Secretarias
	public function IngresarSecretariaC(){

		if(isset($_POST["usuario-Ing"])){  // Si la variable post del formulario usuario viene con información. que se ejecute lo sgt

			//Otra condición para evitar ataques //Expresión Regular
			if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["usuario-Ing"]) && preg_match('/^[a-zA-Z0-9]+$/', $_POST["clave-Ing"])){

				//Si el preg-math se cumple que haga lo sgt

				$tablaBD = "secretarias";

				// las variables usuario y clave tendran información de lo que se introdujo en el formulario
				$datosC = array(
								"usuario"=>$_POST["usuario-Ing"], 
								"clave"=>$_POST["clave-Ing"]);  //array con propiedades

				//Obtenemos una respuesta le mandamos a modelo lo sgt
				$resultado = SecretariasM::IngresarSecretariaM($tablaBD, $datosC);  

				
				if($resultado["usuario"] == $_POST["usuario-Ing"] && $resultado["clave"] == $_POST["clave-Ing"]){

					$_SESSION["Ingresar"] = true; // Entonces si lo de resultado se cumple la variable de sesión sea TRUE

					$_SESSION["id"] = $resultado["id"];  // El id 
					$_SESSION["usuario"] = $resultado["usuario"];  // Para usarlo luego
					$_SESSION["clave"] = $resultado["clave"];// Para usarlo luego
					$_SESSION["nombre"] = $resultado["nombre"];// Para usarlo luego
					$_SESSION["apellido"] = $resultado["apellido"];// Para usarlo luego
					$_SESSION["foto"] = $resultado["foto"];// Para usarlo luego
					$_SESSION["rol"] = $resultado["rol"];// Para usarlo luego

					echo '<script>

					window.location = "inicio";  

					</script>';

					//Redirir a la página Inicio
				}else{

					echo '<div class="alert alert-danger">Error al Ingresar</div>';

				}

			}

		}

	}
	
	/*=============================================
	DATOS MODAL EN SECRETARIA EDITAR  // muestra todos las secretarias
	=============================================*/
	static public function DatosSecretariaModal($item, $valor){

		$tabla = "secretarias";

		$respuesta = SecretariasM::ModalVisualizarDatos($tabla, $item, $valor);

		return $respuesta;
	}


	/*=============================================
	EDITAR DATOS DEL PERFIL SECRETARIA SEGUN EL INICIO DE SESIÓN // muestra solo 1
	=============================================*/
	
	static public function MostrarSecretariasC(){

		$tabla = "secretarias";
		$id = $_SESSION["id"];

		$respuesta = SecretariasM:: VerPerfilSecretariaM($tabla, $id);

		return $respuesta;
	}

	/*=============================================
	EDITAR Secretaria  // completo 
	=============================================*/

	static public function EditarSecretariaRolC(){

		if(isset($_POST["editarNombre"])){
			
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

					$directorio = "Vistas/img/secretaria/";

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

						$ruta = "Vistas/img/secretaria/".$aleatorio.".jpg";

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

						$ruta = "Vistas/img/secretaria/".$aleatorio.".png";

						$origen = imagecreatefrompng($_FILES["editarFoto"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $ruta);

					}

				}

				$tabla = "secretarias";

				if($_POST["editarPassword"] != ""){

					if(preg_match('/^[A-Za-z0-9!?@.*|-]{8,12}+$/', $_POST["editarPassword"])){

						$encriptar = crypt($_POST["editarPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

					}else{

						echo'<script>

								swal({
									  type: "error",
									  title: "¡La contraseña no puede ir vacía o llevar caracteres especiales!",
									  showConfirmButton: true,
									  confirmButtonText: "Cerrar"
									  }).then(function(result){
										if (result.value) {

										window.location = "perfil-Secretaria";

										}
									})

						  	</script>';

					}

				}else{

					$encriptar = $_POST["passwordActual"];

				}

				$datos = array(
								"id" => $_POST["idSecretaria"],
							   "usuario" => $_POST["editarUsuario"],
							   "clave" => $_POST["editarPassword"], //encriptar
							   "nombre" => $_POST["editarNombre"],
							   "apellido" => $_POST["editarApellido"],
							   "foto" => $ruta);

				$respuesta = SecretariasM::EditarSecretariaRolM($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "La secretaria ha sido editado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "perfil-Secretaria";

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

							window.location = "perfil-Secretaria";

							}
						})

			  	</script>';

			}

			

		}

	}

	//AGREGAR SECRETARIA - Desde ADMINISTRADOR
	static public function CrearSecretariaC(){
		
		if(isset($_POST["nuevoNombre"])){ // puede ir cualquiera que sea del formulario
			//SI VIENE ESA VARIABLE ENTONCES CONTINUAMOS:
			$tablaBD ="secretarias"; // nombre de la BDD
			$datos = array(
					//sintaxis "nombre" => $_POST ["lo que viene del name del formulario"]
					"nombre" => $_POST["nuevoNombre"], //campoNombre
					"apellido"=>$_POST["nuevoApellido"],//campoApellido
					"usuario"=>$_POST["nuevoUsuario"],//campo Usuario
					"clave"=>$_POST["nuevoPassword"],//campo Passowrd
					"rol"=>$_POST["nuevoRol"]//campo rol

			);
			// ANEXAMOS AL MODELO
			//AL METODO LE PASAMOS LA TABLA Y DATOS
			$respuesta = SecretariasM::CrearSecretariaM($tablaBD, $datos);

			//ahora si la RESPUESTA ES TRUE mostrar ALERTA
			if($respuesta==true){
				echo '<script>
					swal({
						type: "success",
						title: "¡Secretaria agregada correctamente",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"
						}).then(function(result){
						if (result.value) {

						window.location = "secretarias";

						}
					})                
				</script';

			}

		}

	}

	//EDITAR SECRETARIA - Desde ADMINISTRADOR

	static public function EditarSecretariasC(){
		if(isset($_POST["editarNombre"])){ //Si viene la variable $_POST nombre

			$tablaBD="secretarias"; //nombre de LA BDD
			$datos = array(
						"id"=>$_POST["idSecretaria"], //id campo oculto ID
						"nombre"=>$_POST["editarNombre"], //campo nombre 
						"apellido"=>$_POST["editarApellido"], //campo apellido
						"usuario"=>$_POST["editarUsuario"], //campo usuario
						"clave"=>$_POST["editarPassword"]//campo clave
						);
			//ANEXAMOS AL METODO DEL MODELO //LE PASAMOS LA BDD Y DATOS 
			$respuesta = SecretariasM::EditarSecretariasM($tablaBD, $datos);
			//Si tenemos Respuesta:
			if($respuesta == true){
				echo '<script>
					swal({
						type: "success",
						title: "La secretaria ha sido editado correctamente",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"
						}).then(function(result){
						if (result.value) {

						window.location = "secretarias";

						}
					})                
				</script>';

			}else{

				echo 'error';
			}

		}


	}

	//ELIMINAR SECRETARIA - DESDE ADMINISTRADOR
	static public function EliminarSecretariasC(){

        if(isset($_GET["idSecretaria"])){ //variable que obtenemos del url

            $tablaBD = "secretarias";

            $id = $_GET["idSecretaria"];

			if($_GET["fotoSecretaria"] != ""){

				unlink($_GET["fotoSecretaria"]);
				//rmdir('vistas/img/usuarios/'.$_GET["usuario"]);

			}

            $resultado = SecretariasM::EliminarSecretariaM($tablaBD, $id);

            if($resultado == true){
				echo'<script>

				swal({
					  type: "success",
					  title: "La secretaria ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "secretarias";

								}
							})

				</script>';

            }


        }

	}
}