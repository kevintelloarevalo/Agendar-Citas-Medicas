<?php
require_once "ConexionBD.php"; //SIEMPRE ACABA EN PHP EN ;

class ConsultoriosM extends ConexionBD{

    static public function CrearConsultoriosM($tablaBD, $consultorio){

        //Que haga una conexión la clase Conexión con la función cBD
        //SENTENCIA SQL ("INSERT INTO $tablaBD (nombre) VALUES (:nombre)");
        $pdo= ConexionBD::cBD()->prepare("INSERT INTO $tablaBD(nombre) VALUES (:nombre)");
        
        /*sirve para enlazar un parametro EN ESTE CASO NOMBRE*/ 
        $pdo ->bindParam(":nombre", $consultorio["nombre"], PDO::PARAM_STR);  // /*para solo recibir caracteres */
        
        if ($pdo ->execute()){ // ejecutamos el SQL

            return true;//RPTA

        }else{

            return false;
        }

        $pdo -> close();  // cerramos la conexión
        $pdo = null; //vaciamos
    }  

    static public function VerConsultoriosM($tablaBD, $columna, $valor){

        if ($columna == null){  //SI NO PASAMOS PARAMETROS

            //Cuando no le decimos que columna elegir me mostrara todo 
            //Esto lo usamos para mostrar en la tabla Todos

            $pdo= ConexionBD::cBD()->prepare("SELECT * FROM $tablaBD"); //mostrar todo

            $pdo ->execute();

            return $pdo -> fetchAll();  //muestra todo


        }else{

            //Cuando mando la columna nos referimos al ID que estamos mandando
            $pdo= ConexionBD::cBD()->prepare("SELECT * FROM $tablaBD WHERE $columna = :$columna");
            
            //Y QUE EL VALOR SEA LO QUE NOSOTROS MANDAMOS DESDE JAVASCRIPT PARA PODER EDITAR 

            $pdo -> bindParam(":".$columna, $valor, PDO::PARAM_STR);
            
            $pdo ->execute();

            return $pdo -> fetch(); //devolvemos una sola fila // o para editar solo ese ID Y sus campos

        }

        $pdo -> close();  // cerramos la conexión

        $pdo = null; //vaciamos

    }

	/*=============================================
	EDITAR CONSULTORIO
	=============================================*/

	static public function EditarConsultoriosM($tabla, $datos){

		$stmt = ConexionBD::cBD()->prepare("UPDATE $tabla SET nombre = :nombre WHERE id = :id");

		$stmt -> bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);  //enlazamos lo de la bdd con lo del array de campo 
		$stmt -> bindParam(":id", $datos["id"], PDO::PARAM_INT);//enlazamos lo de la bdd con lo del array de campo 

		if($stmt->execute()){ //ejecutamos

			return true; //RPTA

		}else{

			return false;
		
		}

		$stmt->close(); //cerramos 

		$stmt = null; //vaceamos

	}

    //ELIMINAR CONSULTORIOS
    static public function EliminarConsultoriosM($tablaBD, $id){
        
        $pdo = ConexionBD::cBD()->prepare("DELETE FROM  $tablaBD WHERE id = :id");
       
        //ENLAZAMOS
        $pdo ->bindParam(":id", $id, PDO::PARAM_INT);
        
        if ($pdo ->execute()){ // ejecutamos el SQL

            return true;//RPTA
        }else{
            return false;
        }

        $pdo -> close();  // cerramos la conexión
        
        $pdo = null; //vaciamos

    }

}