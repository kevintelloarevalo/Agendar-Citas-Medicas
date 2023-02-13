<?php
require_once "ConexionBD.php"; //SIEMPRE ACABA EN PHP EN ;

class OrganizacionM extends ConexionBD{

    static public function VerOrganizacionM($tablaBD, $columna, $valor){

        if($columna == null){
            
            $pdo = ConexionBD::cBD()->prepare("SELECT * FROM $tablaBD");
        
            $pdo->execute();
        
            return $pdo ->fetchAll(); //MOSTRAR TODO
        
        
        }else{ //esto sirve para traer la info con JAVASCRIPT Y PARA ANEXAR

            $pdo = ConexionBD::cBD()->prepare("SELECT * FROM $tablaBD WHERE $columna = :$columna");

            $pdo ->bindParam(":".$columna, $valor, PDO::PARAM_STR);
            
            $pdo->execute();

            return $pdo ->fetch();    //MOSTRAR SEGUN LA COLUMNA

        }
        $pdo ->close();

        $pdo = null;

    }
    //EDITAR ORGANIZACION COMPLETO
    static public function EditarOrganizacionM($tablaBD, $datos){

        $pdo = ConexionBD::cBD()->prepare("UPDATE $tablaBD SET nombre = :nombre , ruc = :ruc, telefono = :telefono, direccion = :direccion, correo = :correo, horarioE = :horarioE, horarioS = :horarioS, logo =:logo WHERE id = :id");

        //ENLAZAMOS
        $pdo ->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $pdo ->bindParam(":ruc", $datos["ruc"], PDO::PARAM_STR);
        $pdo ->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
        $pdo ->bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
        $pdo ->bindParam(":correo", $datos["correo"], PDO::PARAM_STR);
        $pdo ->bindParam(":horarioE", $datos["horarioE"], PDO::PARAM_STR);
        $pdo ->bindParam(":horarioS", $datos["horarioS"], PDO::PARAM_STR);
        $pdo ->bindParam(":logo", $datos["logo"], PDO::PARAM_STR);
        $pdo ->bindParam(":id", $datos["id"], PDO::PARAM_INT);

        if($pdo->execute()){ //ejecutamos el SQL

            return true; //RPTA

        }else{
            
            return false;
        }
        $pdo ->close(); //cerramos

        $pdo = null;  //vaceamos

    }
    
}