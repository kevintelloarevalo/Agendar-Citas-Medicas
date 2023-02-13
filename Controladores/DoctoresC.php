<?php

class DoctoresC{
  //Agregar Doctor
    static public function CrearDoctorC(){

        if(isset($_POST["nuevoNombre"])){

            $tablaBD= "doctores";
            //Que venga de la variable post
            $datos = array(
                "rol" => $_POST["nuevoRol"],
                "nombre" => $_POST["nuevoNombre"],
                "apellido" => $_POST["nuevoApellido"],
                "id_consultorio" => $_POST["nuevoConsultorio"],
                "sexo" => $_POST["nuevoGenero"],
                "usuario" => $_POST["nuevoUsuario"],
                "clave" => $_POST["nuevoPassword"]
            );
            $resultado = DoctoresM::CrearDoctorM($tablaBD, $datos);

            if ($resultado == true){

				echo'<script>

					swal({
						  type: "success",
						  title: "¡Doctor agregado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "doctores";

							}
						})

			  	</script>';
            }

        }

    }
 //ver docotores tabla
    static public function VerDoctorC($columna, $valor){

        $tablaBD ="doctores";

        $resultado = DoctoresM::VerDoctorM($tablaBD, $columna, $valor);
        
        return $resultado;  

    
    }

    //Doctor mostrar Solo 1:
static public function DoctorC($columna, $valor){

    $tablaBD ="doctores";

    $resultado = DoctoresM::DoctorM($tablaBD, $columna, $valor);
    
    return $resultado;  


}


//EDITAR DOCTOR
    static public function EditarDoctorC(){

        //si viene la variable del input formulario 
        if(isset($_POST["editarNombre"])){
            //nombre de la bdd
            $tablaBD= "doctores";
            //array para los datos que queremos editar
            $datos = array(
            "id" => $_POST["idDoctor"],
            "nombre"=> $_POST["editarNombre"],
            "apellido"=> $_POST["editarApellido"],
            "sexo" => $_POST["editarGenero"],
            "usuario" => $_POST["editarUsuario"],
            "clave" => $_POST["editarPassword"]
            );
            //ANEXAMOS A LA CLASE doctoresM Y ENTRAMOS A SU METODO EDITAR
            $resultado = DoctoresM::EditarDoctorM($tablaBD, $datos);
            
            if ($resultado == true){

				echo'<script>

					swal({
						  type: "success",
						  title: "El Doctor ha sido editado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "doctores";

							}
						})

			  	</script>';
            }            

        }

    }

    //ELIMINAR DOCTOR

    static public function EliminarDoctorC(){
        
        if(isset($_GET["idDoctor"])){ //variable que obtenemos del url

            $tablaBD = "doctores";

            $id = $_GET["idDoctor"];

			if($_GET["fotoDoctor"] != ""){

				unlink($_GET["fotoDoctor"]);
				//rmdir('vistas/img/usuarios/'.$_GET["usuario"]);

			}

            $resultado = DoctoresM::EliminarDoctorM($tablaBD, $id);

            if($resultado == true){
				echo'<script>

				swal({
					  type: "success",
					  title: "El doctor ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "doctores";

								}
							})

				</script>';

            }


        }



    }


    //Ingreso Paciente Login

    static public function IngresarDoctorC(){

        if(isset($_POST["usuario-Ing"])){//si viene el usuario

            if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["usuario-Ing"]) && preg_match('/^[a-zA-Z0-9]+$/', $_POST["clave-Ing"])){

                $tablaBD="doctores";
                $datos = array(
                    "usuario"=>$_POST["usuario-Ing"], 
                    "clave"=>$_POST["clave-Ing"]  //array con propiedades
                );

                //obtener respuesta del modelo Ingresar enviamos dos parametros la tabla y datos
                $resultado = DoctoresM::IngresarDoctorM($tablaBD, $datos);
            
                if($resultado["usuario"] == $_POST["usuario-Ing"] && $resultado["clave"] == $_POST["clave-Ing"]){

                    $_SESSION["Ingresar"] = true ; // la variable de la plantilla
                    
                    $_SESSION["id"] = $resultado["id"];  // El id 
                    $_SESSION["nombre"] = $resultado["nombre"];// Para usarlo luego
					$_SESSION["clave"] = $resultado["clave"];// Para usarlo luego
                    $_SESSION["apellido"] = $resultado["apellido"];// Para usarlo luego
                    $_SESSION["sexo"] = $resultado["sexo"];// Para usarlo luego
					$_SESSION["foto"] = $resultado["foto"];// Para usarlo luego
					$_SESSION["rol"] = $resultado["rol"];// Para usarlo luego
                    $_SESSION["usuario"] = $resultado["usuario"];  // Para usarlo luego

                    echo '<script>

					window.location = "inicio";  

					</script>';
                }else{

					echo '<div class="alert alert-danger">Error al Ingresar</div>';

				}
            }    

        }

    }

    static public function VerPerfilDoctorC(){

        $tablaBD = "doctores";

        $id = $_SESSION["id"];

        $resultado = DoctoresM::VerPerfilDoctorM($tablaBD, $id);

        return $resultado;


    }


	/*=============================================
	EDITAR PERFIL MIENTRAS EL ROL ES DOCTOR COMPLETO
	=============================================*/

	static public function EditarDoctorRolC(){

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

					$directorio = "Vistas/img/doctor/";

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

						$ruta = "Vistas/img/doctor/".$aleatorio.".jpg";

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

						$ruta = "Vistas/img/doctor/".$aleatorio.".png";

						$origen = imagecreatefrompng($_FILES["editarFoto"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $ruta);

					}

				}

				$tabla = "doctores";

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

										window.location = "perfil-Doctor";

										}
									})

						  	</script>';

					}

				}else{

					$encriptar = $_POST["passwordActual"];

				}

				$datos = array(
                                "id" => $_POST["idDoctor"],
							   "usuario" => $_POST["editarUsuario"],
							   "clave" => $_POST["editarPassword"], //encriptar
							   "nombre" => $_POST["editarNombre"],
							   "apellido" => $_POST["editarApellido"],
                               "sexo" => $_POST["editarGenero"],
                               "id_consultorio" => $_POST["editarConsultorio"],
                               "horarioE" => $_POST["editarHoraE"],
                               "horarioS" => $_POST["editarHoraS"],

							   "foto" => $ruta);

				$respuesta = DoctoresM::EditarDoctorRolM($tabla, $datos);

				if($respuesta == true){

					echo'<script>

					swal({
						  type: "success",
						  title: "Tu perfil ha sido editado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "perfil-Doctor";

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

							window.location = "perfil-Doctor";

							}
						})

			  	</script>';

			}

		}

	}
        
}