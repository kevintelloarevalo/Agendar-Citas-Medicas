<?php

class AdministradoresC{

    static public function IngresarAdministradorC(){

        if(isset($_POST["usuario-Ing"])){//si viene el usuario

            if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["usuario-Ing"]) && preg_match('/^[a-zA-Z0-9]+$/', $_POST["clave-Ing"])){

                $tablaBD="admin";
                $datos = array(
                    "usuario"=>$_POST["usuario-Ing"], 
                    "clave"=>$_POST["clave-Ing"]  //array con propiedades
                );

                //obtener respuesta del modelo Ingresar enviamos dos parametros la tabla y datos
                $resultado = AdministradoresM::IngresarAdministradorM($tablaBD, $datos);
            
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

    //VER MI PERFIL DE ADMINISTRADOR
    static public function VerPerfilAdministradorC(){

        $tablaBD ="admin";
        $id = $_SESSION["id"]; // session de id del admi

        $resultado = AdministradoresM::VerPerfilAdministradorM($tablaBD, $id);

        return $resultado;

    }
    //MOSTRAR ADMINISTRADORES
    static public function VerAdministradorC($columna, $valor){

        $tablaBD ="admin";

        $resultado = AdministradoresM::VerAdministradorM($tablaBD, $columna, $valor);
        
        return $resultado;

    }
    //EDITAR PERFIL COMPLETO ADMINISTRADOR
    
	/*=============================================
	EDITAR PERFIL MIENTRAS EL ROL ES ADMINISTRADOR
	=============================================*/

	static public function EditarAdministradorRolC(){

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

					$directorio = "Vistas/img/admin/";

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

						$ruta = "Vistas/img/admin/".$aleatorio.".jpg";

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

						$ruta = "Vistas/img/admin/".$aleatorio.".png";

						$origen = imagecreatefrompng($_FILES["editarFoto"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $ruta);

					}

				}

				$tabla = "admin";

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

										window.location = "perfil-Administrador";

										}
									})

						  	</script>';

					}

				}else{

					$encriptar = $_POST["passwordActual"];

				}

				$datos = array(
                                "id" => $_POST["idAdministrador"],
								"nombre" => $_POST["editarNombre"],
								"apellido" => $_POST["editarApellido"],
								"documento" => $_POST["editarDocumento"],
							   	"usuario" => $_POST["editarUsuario"],
							   	"clave" => $_POST["editarPassword"], //encriptar
                               	"sexo" => $_POST["editarGenero"],
							   	"foto" => $ruta);

				$respuesta = AdministradoresM::EditarAdministradorRolM($tabla, $datos);

				if($respuesta == true){

					echo'<script>

					swal({
						  type: "success",
						  title: "Tu perfil ha sido editado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "perfil-Administrador";

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

							window.location = "perfil-Administrador";

							}
						})

			  	</script>';

			}

			

		}

	}
}