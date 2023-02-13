<?php

class PacientesC{ //crear la clase controlador Paciente

    static public function CrearPacienteC(){

        if(isset($_POST["nuevoNombre"])){

            $tablaBD = "pacientes";
            $datos = array (
                    "nombre" => $_POST["nuevoNombre"],
                    "apellido"=> $_POST["nuevoApellido"],
                    "documento"=>$_POST["nuevoDocumento"],
                    "sexo"=>$_POST["nuevoGenero"],
                    "rol"=>$_POST["nuevoRol"],
                    "usuario"=>$_POST["nuevoUsuario"],
                    "clave"=>$_POST["nuevoPassword"]
            );

            $resultado = PacientesM::CrearPacienteM($tablaBD,$datos);

            if($resultado == true){

                echo'<script>
                    swal({
                        type: "success",
                        title: "¡Paciente agregado correctamente",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                        }).then(function(result){
                        if (result.value) {

                        window.location = "pacientes";

                        }
                    })                
                </script>';
            }

        }

    }
    //MOSTRAR PACIENTES
    static public function VerPacienteC($columna, $valor){

        $tablaBD ="pacientes";

        $resultado = PacientesM::VerPacienteM($tablaBD, $columna, $valor);
        
        return $resultado;

    }
    
    //ELIMINAR PACIENTES
    static public function EliminarPacienteC(){
        
        if(isset($_GET["idPaciente"])){
            
            $tablaBD = "pacientes";
            $id = $_GET["idPaciente"];
            //si hay foto
            if($_GET["fotoPaciente"]!= ""){

                unlink($_GET["idPaciente"]);

            }

            $resultado = PacientesM::EliminarPacienteM($tablaBD, $id);

            if($resultado == true){
                echo' <script>
				swal({
                    type: "success",
                    title: "El paciente ha sido borrado correctamente",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar"
                    }).then(function(result){
                              if (result.value) {

                              window.location = "pacientes";

                              }
                          })

                </script>';

            }
        }
    }
    //EDITAR PACIENTES
    static public function EditarPacienteC(){

        if (isset($_POST["editarNombre"])){// si existe la variable idPaciente
            
            $tablaBD = "pacientes";

            $datos = array(
                
                "id" => $_POST["idPaciente"],
                "nombre"=> $_POST["editarNombre"],
                "apellido"=> $_POST["editarApellido"],
                "documento"=> $_POST["editarDocumento"],
                "sexo" => $_POST["editarGenero"],
                "usuario" => $_POST["editarUsuario"],
                "clave" => $_POST["editarPassword"]
            );

            $resultado = PacientesM::EditarPacienteM($tablaBD, $datos);

            if ($resultado == true){

                echo'<script>
                    swal({
                        type: "success",
                        title: "El Paciente ha sido editado correctamente",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                        }).then(function(result){
                        if (result.value) {

                        window.location = "pacientes";

                        }
                    })                
                </script>';

            }else{

                echo 'error';
            }


        }

    }

    //Ingreso Paciente Login

    static public function IngresarPacienteC(){

        if(isset($_POST["usuario-Ing"])){//si viene el usuario

            if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["usuario-Ing"]) && preg_match('/^[a-zA-Z0-9]+$/', $_POST["clave-Ing"])){

                $tablaBD="pacientes";
                $datos = array(
                    "usuario"=>$_POST["usuario-Ing"], 
                    "clave"=>$_POST["clave-Ing"]  //array con propiedades
                );

                //obtener respuesta del modelo Ingresar enviamos dos parametros la tabla y datos
                $resultado = PacientesM::IngresarPacienteM($tablaBD, $datos);
            
                if($resultado["usuario"] == $_POST["usuario-Ing"] && $resultado["clave"] == $_POST["clave-Ing"]){

                    $_SESSION["Ingresar"] = true ; // la variable de la plantilla
                    $_SESSION["id"] = $resultado["id"];  // El id 
                    $_SESSION["nombre"] = $resultado["nombre"];// Para usarlo luego
					$_SESSION["apellido"] = $resultado["apellido"];// Para usarlo luego
                    $_SESSION["documento"] = $resultado["documento"];// Para usarlo luego
                    $_SESSION["sexo"] = $resultado["sexo"];// Para usarlo luego
					$_SESSION["foto"] = $resultado["foto"];// Para usarlo luego
					$_SESSION["rol"] = $resultado["rol"];// Para usarlo luego
                    $_SESSION["usuario"] = $resultado["usuario"];  // Para usarlo luego
					$_SESSION["clave"] = $resultado["clave"];// Para usarlo luego

                    echo '<script>

					window.location = "inicio";  

					</script>';
                }else{

					echo '<div class="alert alert-danger">Error al Ingresar</div>';

				}
            }    

        }

    }

    //VER MI PERFIL DE PACIENTE
    static public function VerPerfilPacienteC(){

        $tablaBD ="pacientes";
        $id = $_SESSION["id"];

        $resultado = PacientesM::VerPerfilPacienteM($tablaBD, $id);

        return $resultado;

    }


	/*=============================================
	EDITAR PERFIL MIENTRAS EL ROL ES PACIENTE
	=============================================*/

	static public function EditarPacienteRolC(){

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

					$directorio = "Vistas/img/paciente/";

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

						$ruta = "Vistas/img/paciente/".$aleatorio.".jpg";

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

						$ruta = "Vistas/img/paciente/".$aleatorio.".png";

						$origen = imagecreatefrompng($_FILES["editarFoto"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $ruta);

					}

				}

				$tabla = "pacientes";

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

										window.location = "perfil-Paciente";

										}
									})

						  	</script>';

					}

				}else{

					$encriptar = $_POST["passwordActual"];

				}

				$datos = array(
                                "id" => $_POST["idPaciente"],
							   "usuario" => $_POST["editarUsuario"],
							   "clave" => $_POST["editarPassword"], //encriptar
							   "nombre" => $_POST["editarNombre"],
							   "apellido" => $_POST["editarApellido"],
                               "sexo" => $_POST["editarGenero"],
                               "documento" => $_POST["editarDocumento"],

							   "foto" => $ruta);

				$respuesta = PacientesM::EditarPacienteRolM($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "Tu perfil ha sido editado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "perfil-Paciente";

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

							window.location = "perfil-Paciente";

							}
						})

			  	</script>';

			}

			

		}

	}
    

    
}