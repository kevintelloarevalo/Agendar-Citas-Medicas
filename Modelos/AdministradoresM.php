<?php
require_once "ConexionBD.php"; //SIEMPRE ACABA EN PHP EN ;

class AdministradoresM extends ConexionBD{
    
    //LOGIN INGRESARADMINISTRADOR
    static public function IngresarAdministradorM($tablaBD, $datos){

        $pdo = ConexionBD::cBD()->prepare("SELECT id, nombre, apellido, documento, sexo, foto, rol, usuario, clave 
                                            FROM $tablaBD WHERE usuario = :usuario");

        $pdo ->bindParam(":usuario",$datos["usuario"], PDO::PARAM_STR);

        $pdo ->execute();


        return $pdo ->fetch();    //MOSTRAR SEGUN LA COLUMNA    

        $pdo ->close();

        $pdo = null;

    }

    // VER MI PERFIL ADMINISTRADOR
    static public function VerPerfilAdministradorM($tablaBD, $id){

        $pdo = ConexionBD::cBD()->prepare("SELECT id, nombre, apellido, documento, sexo, foto, rol, usuario, clave 
                                            FROM $tablaBD WHERE id = :id");
                                            
        $pdo ->bindParam(":id",$id, PDO::PARAM_INT);

        $pdo ->execute();


        return $pdo ->fetch();    //MOSTRAR SEGUN LA COLUMNA    
    
        $pdo ->close();

        $pdo = null;

    }        

     //ver pacientes todos
        static public function VerAdministradorM($tablaBD, $columna, $valor){

        if($columna == null){
                
                $pdo = ConexionBD::cBD()->prepare("SELECT * FROM $tablaBD ORDER BY nombre ASC");

                $pdo->execute();

                return $pdo ->fetchAll(); //MOSTRAR TODO
                

        }else{

                $pdo = ConexionBD::cBD()->prepare("SELECT * FROM $tablaBD WHERE $columna = :$columna ORDER BY nombre ");

                $pdo ->bindParam(":".$columna, $valor, PDO::PARAM_STR);
                        
                $pdo->execute();

                return $pdo ->fetch();    //MOSTRAR SEGUN LA COLUMNA

        }
        $pdo ->close();

        $pdo = null;

    }

//EDITAR PERFIL COMPLETO 

    static public function EditarAdministradorRolM($tablaBD, $datos){

        $pdo = ConexionBD::cBD()->prepare("UPDATE $tablaBD SET nombre = :nombre , apellido = :apellido, documento = :documento, sexo = :sexo, usuario = :usuario, clave = :clave, foto = :foto WHERE id = :id");

        //ENLAZAMOS
        $pdo ->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $pdo ->bindParam(":apellido", $datos["apellido"], PDO::PARAM_STR);
        $pdo ->bindParam(":documento", $datos["documento"], PDO::PARAM_STR);
        $pdo ->bindParam(":sexo", $datos["sexo"], PDO::PARAM_STR);
        $pdo ->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
        $pdo ->bindParam(":clave", $datos["clave"], PDO::PARAM_STR);
        $pdo ->bindParam(":foto", $datos["foto"], PDO::PARAM_STR);
        $pdo ->bindParam(":id", $datos["id"], PDO::PARAM_INT);
        
        if($pdo->execute()){ //ejecutamos el SQL

            return true;


        }else{
            
            return false;
        }
        $pdo ->close(); //cerramos

        $pdo = null;  //vaceamos

    }
}