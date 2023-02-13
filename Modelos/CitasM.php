<?php
require_once "ConexionBD.php"; //SIEMPRE ACABA EN PHP EN ;

class CitasM extends ConexionBD{ 
    //enlazamos parametros con el array que trae del $POST FORMUALRIO           
        //ESTRUCTURA
        //"nombre del campo", $array ["nombre del arreglo que trae el $POST"], PDO::
    //AGENDAR CITA DESDE PACIENTE
	static public function AgendarCitaM($tablaBD, $datos){

		$pdo = ConexionBD::cBD()->prepare("INSERT INTO $tablaBD (id_doctor, id_consultorio, id_paciente, paciente, documento, doctor, inicio, fin) VALUES (:id_doctor, :id_consultorio, :id_paciente, :paciente, :documento, :doctor, :inicio, :fin)");

		$pdo -> bindParam(":id_doctor", $datos["Did"], PDO::PARAM_INT);
		$pdo -> bindParam(":id_consultorio", $datos["Cid"], PDO::PARAM_INT);
		$pdo -> bindParam(":id_paciente", $datos["Pid"], PDO::PARAM_INT);

		$pdo -> bindParam(":paciente", $datos["nyaC"], PDO::PARAM_STR);
		$pdo -> bindParam(":documento", $datos["documentoC"], PDO::PARAM_STR);
        $pdo -> bindParam(":doctor", $datos["doctorC"], PDO::PARAM_STR);
		$pdo -> bindParam(":inicio", $datos["fyhIC"], PDO::PARAM_STR);
		$pdo -> bindParam(":fin", $datos["fyhFC"], PDO::PARAM_STR);

		
        
        if($pdo->execute()){
			return true;
		}

		$pdo -> close();
		$pdo = null;

	}

	//AGENDAR CITA DESDE PERFIL DOCTOR
    static public function AgendarCitaDoctorM($tablaBD, $datos){

		$pdo = ConexionBD::cBD()->prepare("INSERT INTO $tablaBD (id_doctor, id_consultorio, paciente, doctor, inicio, fin) VALUES (:id_doctor, :id_consultorio, :paciente, :doctor, :inicio, :fin)");

		$pdo -> bindParam(":id_doctor", $datos["Did"], PDO::PARAM_INT);
		$pdo -> bindParam(":id_consultorio", $datos["Cid"], PDO::PARAM_INT);
		$pdo -> bindParam(":paciente", $datos["nyaC"], PDO::PARAM_STR);
        $pdo -> bindParam(":doctor", $datos["doctorC"], PDO::PARAM_STR);
		$pdo -> bindParam(":inicio", $datos["fyhIC"], PDO::PARAM_STR);
		$pdo -> bindParam(":fin", $datos["fyhFC"], PDO::PARAM_STR);


        if($pdo->execute()){

			return true;
		}

		$pdo -> close();
		$pdo = null;

	}
	
	// VER TODAS LAS CITAS
	static public function VerCitasM($tablaBD){

		$pdo = ConexionBD::cBD()->prepare("SELECT * FROM $tablaBD");
		
		$pdo ->execute(); //EJECUTAMOS EL SQL

		return $pdo ->fetchAll(); //MOSTRAR TODO

		$pdo -> close(); // CERRAMOS

		$pdo = null; // VACEAMOS

	}

    //ELIMINAR CITA

    static public function EliminarCitaM($tablaBD, $id){

        $pdo = ConexionBD::cBD()->prepare("DELETE FROM $tablaBD WHERE id = :id");

        $pdo->bindParam(":id", $id, PDO::PARAM_INT);
        
        if($pdo->execute()){ //ejecutamos el SQL

            return true;

        }else{
            
            return false;
        }
		
        $pdo ->close(); //cerramos
        $pdo = null;  //vaceamos

    }
}