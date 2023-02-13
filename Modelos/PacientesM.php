<?php
require_once "ConexionBD.php"; //SIEMPRE ACABA EN PHP EN ;

class PacientesM extends ConexionBD{

    //CREAR PACIENTE DESDE OTROS PERFILES 
    static public function CrearPacienteM($tablaBD, $datos){

        $pdo = ConexionBD::cBD()->prepare("INSERT INTO $tablaBD (nombre, apellido, rol, sexo, usuario, clave, documento)
                                            VALUES(:nombre, :apellido, :rol, :sexo, :usuario, :clave, :documento)");
        
        $pdo ->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $pdo ->bindParam(":apellido", $datos["apellido"], PDO::PARAM_STR);
        $pdo ->bindParam(":rol", $datos["rol"], PDO::PARAM_STR);
        $pdo ->bindParam(":sexo", $datos["sexo"], PDO::PARAM_STR);
        $pdo ->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
        $pdo ->bindParam(":clave", $datos["clave"], PDO::PARAM_STR);
        $pdo ->bindParam(":documento", $datos["documento"], PDO::PARAM_STR);
        

        if($pdo->execute()){ //ejecutamos el SQL

            return true; //RPTA

        }else{
            
            return false;
        }
        $pdo ->close(); //cerramos
        $pdo = null;  //vaceamos

    }
    //VER PACIENTES TODOS
    static public function VerPacienteM($tablaBD, $columna, $valor){

        if($columna == null){
            
            $pdo = ConexionBD::cBD()->prepare("SELECT * FROM $tablaBD ORDER BY nombre ASC");

            $pdo->execute();

            return $pdo ->fetchAll(); //MOSTRAR TODO
       

        }else{  // USAMOS PARA JAVASCRIPT

            $pdo = ConexionBD::cBD()->prepare("SELECT * FROM $tablaBD WHERE $columna = :$columna ORDER BY nombre ");

            $pdo ->bindParam(":".$columna, $valor, PDO::PARAM_STR);
            
            $pdo->execute();

            return $pdo ->fetch();    //MOSTRAR SEGUN LA COLUMNA

        }
        $pdo ->close();

        $pdo = null;

    }

    //ELIMINAR PACIENTE //LE PASAMOS ID LO OBTENGO CON JAVASCRIPT

    static public function EliminarPacienteM($tablaBD, $id){

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

    //EDITAR PACIENTES // NO ESTA COMPLETO DESDE OTROS ROLES X EJEMPLO DOCTOR, SECRETARIA, ADMINISTRADOR

    static public function EditarPacienteM($tablaBD, $datos){

        $pdo = ConexionBD::cBD()->prepare("UPDATE $tablaBD SET nombre = :nombre , apellido = :apellido, documento = :documento, sexo = :sexo, usuario = :usuario, clave = :clave WHERE id = :id");

        //ENLAZAMOS
        $pdo ->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $pdo ->bindParam(":apellido", $datos["apellido"], PDO::PARAM_STR);
        $pdo ->bindParam(":documento", $datos["documento"], PDO::PARAM_STR);
        $pdo ->bindParam(":sexo", $datos["sexo"], PDO::PARAM_STR);
        $pdo ->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
        $pdo ->bindParam(":clave", $datos["clave"], PDO::PARAM_STR);
        $pdo ->bindParam(":id", $datos["id"], PDO::PARAM_INT);

        if($pdo->execute()){ //ejecutamos el SQL

            return true;//RPTA

        }else{
            
            return false;
        }
        $pdo ->close(); //cerramos

        $pdo = null;  //vaceamos

    }
    //LOGIN Ingresar Paciente
    static public function IngresarPacienteM($tablaBD, $datos){

        $pdo = ConexionBD::cBD()->prepare("SELECT id, nombre, apellido, documento, sexo, foto, rol, usuario, clave 
                                            FROM $tablaBD WHERE usuario = :usuario");

        $pdo ->bindParam(":usuario",$datos["usuario"], PDO::PARAM_STR);

        $pdo ->execute();


        return $pdo ->fetch();    //MOSTRAR SEGUN LA COLUMNA    
    
        $pdo ->close();

        $pdo = null;

    }
    // VER MI PERFIL PACIENTE EN ESTE CASO SEGUN EL ID DEL PACIENTE QUE INICIA SESION
    static public function VerPerfilPacienteM($tablaBD, $id){

        $pdo = ConexionBD::cBD()->prepare("SELECT id, nombre, apellido, documento, sexo, foto, rol, usuario, clave 
                                            FROM $tablaBD WHERE id = :id");
                                            
        $pdo ->bindParam(":id",$id, PDO::PARAM_INT);

        $pdo ->execute();


        return $pdo ->fetch();    //MOSTRAR SEGUN LA COLUMNA    
    
        $pdo ->close();

        $pdo = null;

    }
    
    //EDITAR PERFIL COMPLETO DESDE MI PERFILPACIENTE

    static public function EditarPacienteRolM($tablaBD, $datos){

        $pdo = ConexionBD::cBD()->prepare("UPDATE $tablaBD SET nombre = :nombre , apellido = :apellido, documento = :documento, sexo = :sexo, usuario = :usuario, clave = :clave, foto =:foto WHERE id = :id");

        //EJECUTAMOS
        $pdo ->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $pdo ->bindParam(":apellido", $datos["apellido"], PDO::PARAM_STR);
        $pdo ->bindParam(":documento", $datos["documento"], PDO::PARAM_STR);
        $pdo ->bindParam(":sexo", $datos["sexo"], PDO::PARAM_STR);
        $pdo ->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
        $pdo ->bindParam(":clave", $datos["clave"], PDO::PARAM_STR);
        $pdo ->bindParam(":foto", $datos["foto"], PDO::PARAM_STR);
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