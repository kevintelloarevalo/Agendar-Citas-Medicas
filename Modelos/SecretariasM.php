<?php

require_once "ConexionBD.php";

class SecretariasM extends ConexionBD{  // creamos la clase 


	//LOGIN INGRESAR SECRETARIA
	static public function IngresarSecretariaM($tablaBD, $datosC){  // creamos la función public // estatica cuando lleva parametros

		//Hacemos una variable que sea IGUAL a la conexión BDD y conexte a la functión CBD () -> prepare la sentencia SQL
		$pdo = ConexionBD::cBD()->prepare("SELECT usuario, clave, nombre, apellido, foto, rol, id FROM $tablaBD WHERE usuario = :usuario");

		//Sentencia SQL = Seleccionar todas los atributos de la tabla "usuarios" donde "usuario" sea igual a la variable post del formulario.
		
		//llamamos todo para tener nuestras variables de sesión. Por eso "select"
		
		$pdo -> bindParam(":usuario", $datosC["usuario"], PDO::PARAM_STR); //La variable enlace a lo que viene en el SQL "where" con lo que viene en el controlador 

		$pdo -> execute();

		return $pdo -> fetch(); //UNA SOLA LINEA

		$pdo -> close();

		$pdo = null; //vaciamos la conexión con PDO


	}

	//MOSTRAR SECRETARIA  // SOLO para el perfil de la Secretaria QUE INICIA SESION X ESO LE PASAMOS ID
	static public function VerPerfilSecretariaM($tabla, $id){

		$pdo = ConexionBD::cBD()->prepare("SELECT usuario, clave, nombre, apellido, foto, rol, id FROM $tabla WHERE id = :id");

		$pdo -> bindParam(":id", $id, PDO::PARAM_INT);

		$pdo -> execute();

		return $pdo -> fetch(); //una sola fila // MUESTRA SOLO UNO

		$pdo -> close();
		$pdo = null;

	}

	/*=============================================
	 SECRETARIA EN MODAL Datos // EN LA TABLA MUESTRA todos 
	=============================================*/

	static public function ModalVisualizarDatos($tabla, $item, $valor){

		if($item != null){  

			$stmt = ConexionBD::cBD()->prepare("SELECT * FROM $tabla WHERE $item = :$item");/*consulta */
			/*sirve para enlazar un parametro*/
			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR); /*para solo recibir caracteres */

			$stmt -> execute();

			return $stmt -> fetch(); /*se usa para retornar una linea  */

		}else{ //USAMOS PARA JAVASCRIPT O PARA MOSTRAR TODOS 

			$stmt = ConexionBD::cBD()->prepare("SELECT * FROM $tabla");

			$stmt -> execute();

			return $stmt -> fetchAll();  //MOSTRAR TODOS

		}
	

		$stmt -> close();

		$stmt = null;

	}
	
	/*=============================================
	EDITAR SECRETARIA // COMPLETO DESDE EL PERFIL SECRETARIA
	=============================================*/

	static public function EditarSecretariaRolM($tabla, $datos){
	
		$stmt = ConexionBD::cBD()->prepare("UPDATE $tabla SET  nombre = :nombre, apellido = :apellido, clave = :clave, foto = :foto, usuario =:usuario WHERE id = :id");

		$stmt -> bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt -> bindParam(":apellido", $datos["apellido"], PDO::PARAM_STR);
		$stmt -> bindParam(":clave", $datos["clave"], PDO::PARAM_STR);
		$stmt -> bindParam(":foto", $datos["foto"], PDO::PARAM_STR);
		$stmt -> bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
		$stmt -> bindParam(":id", $datos["id"], PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

	//CREAR SECRETARIAS CON ROL ADMINISTRADOR
	//LE PASAMOS LA BDD Y DATOS DEL CONTROLADOR
	static public function CrearSecretariaM($tablaBD, $datos){

		$pdo=ConexionBD::cBD()->prepare("INSERT INTO $tablaBD(nombre, apellido, usuario, clave, rol) 
									VALUES (:nombre, :apellido, :usuario, :clave, :rol)");
		//Enlazamos lo de la BDD CON LOS DATOS DEL CONTROLADOR ARRAY CONTROLADOR
		//SINTAXIS (":nombredelcampo", $datos["nombredelcampodelarray"], PDO::PARAM_STR) // SI ES ENTERO INT
		//va segun el orden del SQL
		$pdo ->bindParam(":nombre",$datos["nombre"], PDO::PARAM_STR);
		$pdo ->bindParam(":apellido",$datos["apellido"], PDO::PARAM_STR);
		$pdo ->bindParam(":usuario",$datos["usuario"], PDO::PARAM_STR);
		$pdo ->bindParam(":clave",$datos["clave"], PDO::PARAM_STR);
		$pdo ->bindParam(":rol",$datos["rol"], PDO::PARAM_STR);

		if($pdo->execute()){ // ejecutamos el SQL

			return true; // VA AL CONTROLADOR LA RESPUESTA

		}else{

			return false;

		}
		$pdo->close(); //cerramos
		$pdo = null; //vaceamos
	}

	//EDITAR SECRETARIA DESDE ADMINISTRADOR

	//le pasamos la bdd y datos 
	static public function EditarSecretariasM($tablaBD, $datos){
		$pdo = ConexionBD::cBD()->prepare("UPDATE $tablaBD SET nombre = :nombre, apellido = :apellido, usuario = :usuario, clave = :clave  WHERE id =:id");

		//ENLAZAMOS
		$pdo->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$pdo->bindParam(":apellido", $datos["apellido"], PDO::PARAM_STR);
		$pdo->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
		$pdo->bindParam(":clave", $datos["clave"], PDO::PARAM_STR);
		$pdo->bindParam(":id", $datos["id"], PDO::PARAM_INT);

		if($pdo->execute()){ //ejecutamos

			return true; //RPTA

		}else{
			return false;
		}
		$pdo->close(); //CERRAMOS
		$pdo =null; //VACEAMOS

	}

    //ELIMINAR SECRETARIA LE PASAMOS ID
    static public function EliminarSecretariaM($tablaBD, $id){

        $pdo = ConexionBD::cBD()->prepare("DELETE FROM $tablaBD WHERE id = :id"); 

        //ENLAZAMOS
        // ID DE LA BDD Y EL OTRO DEL CAMPO A EDITAR
        $pdo ->bindParam (":id", $id, PDO::PARAM_INT); //siempre usar para editar

        if($pdo ->execute()){ // ejecutamos

            return true; // enviamos una respuesta al controlador

        }else{
            
            return false;
        } 
        $pdo ->close();  //cerramos el pdo
        $pdo = null; //vaceamos

    }	

}