
<?php
require_once "ConexionBD.php"; //SIEMPRE ACABA EN PHP EN ;

class DoctoresM extends ConexionBD{ 

// metodos
    //CREARDOCTOR DESDE OTROS PERFILES X EJEMPLO ADMIN, SECRETARIA
    static public function CrearDoctorM($tablaBD, $datos){

        $pdo = ConexionBD::cBD()->prepare("INSERT INTO $tablaBD(nombre, apellido, sexo, id_consultorio, usuario, clave, rol ) 
                                            VALUES(:nombre, :apellido, :sexo, :id_consultorio, :usuario, :clave, :rol)");
        //ENLAZAMOS
        $pdo ->bindParam (":nombre", $datos["nombre"], PDO::PARAM_STR);
        $pdo ->bindParam (":apellido", $datos["apellido"], PDO::PARAM_STR);
        $pdo ->bindParam (":sexo", $datos["sexo"], PDO::PARAM_STR);
        $pdo ->bindParam (":id_consultorio", $datos["id_consultorio"], PDO::PARAM_INT);
        $pdo ->bindParam (":usuario", $datos["usuario"], PDO::PARAM_STR);
        $pdo ->bindParam (":clave", $datos["clave"], PDO::PARAM_STR);
        $pdo ->bindParam (":rol", $datos["rol"], PDO::PARAM_STR);

        if($pdo ->execute()){

            return true; //RPTA

        }else{
            return false;
        } 
        $pdo ->close();
        $pdo = null;

    }
    //Ver doctores en la tabla (TODOS)
    public static function VerDoctorM($tablaBD, $columna, $valor){

        if($columna != null){
            
            // columna = id ,  y id del post lo compar
            $pdo = ConexionBD::cBD()->prepare("SELECT * FROM $tablaBD WHERE $columna = :$columna");


            $pdo -> bindParam(":".$columna, $valor, PDO::PARAM_STR);
            
            $pdo -> execute();   

            return $pdo ->fetch(); //ejecutar solo una fila//antes era fetchall
           
           

        }else{
                
            $pdo = ConexionBD::cBD()->prepare("SELECT * FROM $tablaBD");

            $pdo ->execute();
    
            return $pdo ->fetchAll(); //MUESTRA TODOS CUANDO NO LE PASAS PARAMETROS

        }
        $pdo ->close(); //CERRAMOS

        $pdo = null;

    }

    //Mostrar solo un doctor  // EN ALGUNOS CASOS SI SE USA
	static public function DoctorM($tablaBD, $columna, $valor){

		if($columna != null){
            //LE PASAMOS EL ID DOCTOR Y MUESTRE TODOS LOS DOCTORES
			$pdo = ConexionBD::cBD()->prepare("SELECT * FROM $tablaBD WHERE $columna = :$columna");

			$pdo -> bindParam(":".$columna, $valor, PDO::PARAM_STR);

			$pdo->execute();

			return $pdo -> fetchAll(); // PARA LOS CARD SELECCIONAR DOCTOR A CITA 

		}

		$pdo -> close();
		$pdo = null;

	}

    //EDITAR DOCTORES //DESDE OTROS PERFILES X EJEMPLO DESDE Secretaria, ADMIN

    static public function EditarDoctorM ($tablaBD, $datos){


		$pdo = ConexionBD::cBD()->prepare("UPDATE $tablaBD SET nombre = :nombre , apellido = :apellido, sexo = :sexo, usuario = :usuario, clave = :clave WHERE id = :id");
       
        $pdo ->bindParam (":nombre", $datos["nombre"], PDO::PARAM_STR);
        $pdo ->bindParam (":apellido", $datos["apellido"], PDO::PARAM_STR);
        $pdo ->bindParam (":sexo", $datos["sexo"], PDO::PARAM_STR);
        $pdo ->bindParam (":usuario", $datos["usuario"], PDO::PARAM_STR);
        $pdo ->bindParam (":clave", $datos["clave"], PDO::PARAM_STR);
        $pdo ->bindParam (":id", $datos["id"], PDO::PARAM_INT); //siempre usar para editar
        
        if($pdo ->execute()){ // ejecutamos

            return true; // enviamos una respuesta al controlador

        }else{
            
            return false;
        } 
        $pdo ->close();  //cerramos el pdo
        $pdo = null; //vaceamos

    }
    //ELIMINAR DOCTOR LE PASAMOS ID
    static public function EliminarDoctorM($tablaBD, $id){

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

    //LOGIN Ingresar Doctor

    static public function IngresarDoctorM($tablaBD, $datos){

        $pdo = ConexionBD::cBD()->prepare("SELECT id, nombre, apellido, sexo, foto, rol, usuario, clave 
                                            FROM $tablaBD WHERE usuario = :usuario");

        $pdo ->bindParam(":usuario",$datos["usuario"], PDO::PARAM_STR);

        $pdo ->execute();


        return $pdo ->fetch();    //MOSTRAR SEGUN LA COLUMNA    
    
        $pdo ->close();

        $pdo = null;

    }

   // VER PERFIL DOCTOR //SOLO PARA ÉL POR EJEMPLO VERPERFILDOCTOR
   //LE PASAMOS EL ID 

    static public function VerPerfilDoctorM($tablaBD, $id){

        $pdo = ConexionBD::cBD()->prepare("SELECT * FROM $tablaBD WHERE id = :id");
                                            
        $pdo ->bindParam(":id",$id, PDO::PARAM_INT);

        $pdo ->execute(); //EJECUTAMOS


        return $pdo ->fetch();    //MOSTRAR SEGUN LA COLUMNA EN ESTE CASO SEGUN EL ID DEL DOCTOR  
    
        $pdo ->close(); //CERRAMOS

        $pdo = null;

    }

    //EDITAR PERFIL COMPLETO DESDE ROL DOCTOR MI PERFILDOCTOR
    static public function EditarDoctorRolM($tablaBD, $datos){

        $pdo = ConexionBD::cBD()->prepare("UPDATE $tablaBD SET nombre = :nombre , apellido = :apellido, id_consultorio = :id_consultorio, sexo = :sexo, usuario = :usuario, clave = :clave, foto =:foto, horarioE = :horarioE, horarioS = :horarioS WHERE id = :id");
        //ENLAZAMOS
        $pdo ->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $pdo ->bindParam(":apellido", $datos["apellido"], PDO::PARAM_STR);
        $pdo ->bindParam(":id_consultorio", $datos["id_consultorio"], PDO::PARAM_INT);
        $pdo ->bindParam(":sexo", $datos["sexo"], PDO::PARAM_STR);
        $pdo ->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
        $pdo ->bindParam(":clave", $datos["clave"], PDO::PARAM_STR);
        $pdo ->bindParam(":foto", $datos["foto"], PDO::PARAM_STR);
        $pdo ->bindParam(":horarioE", $datos["horarioE"], PDO::PARAM_STR);
        $pdo ->bindParam(":horarioS", $datos["horarioS"], PDO::PARAM_STR);
        $pdo ->bindParam(":id", $datos["id"], PDO::PARAM_INT);
        
        if($pdo->execute()){ //ejecutamos el SQL

            return true; //RESPUESTA

        }else{
            
            return false;
        }
        $pdo ->close(); //cerramos

        $pdo = null;  //vaceamos

    }



}