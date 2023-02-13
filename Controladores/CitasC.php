<?php //abrimos php

class CitasC{

    //crear o agendar citas
    static public function AgendarCitaC(){

        if(isset($_POST["idDoctorCita"])){

            $tablaBD="citas";

            $id= $_GET["idDoctor"];

            $datos = array(
                    "Did"=>$_POST["idDoctorCita"], 
					"Pid"=>$_POST["idPacienteCita"], 
					"nyaC"=>$_POST["nyaCita"], 
					"Cid"=>$_POST["idConsultorioCita"], 
					"documentoC"=>$_POST["documentoCita"], 
                    "doctorC"=>$_POST["doctorCita"],
					"fyhIC"=>$_POST["fechayhoraInicial"], 
					"fyhFC"=>$_POST["fechayhoraFinal"]
            );

            $resultado = CitasM::AgendarCitaM($tablaBD, $datos);

            if($resultado == true){

                echo'<script>

                swal({
                      type: "success",
                      title: "¡Cita agregada correctamente",
                      showConfirmButton: true,
                      confirmButtonText: "Cerrar"
                      }).then(function(result){
                        if (result.value) {

                        window.location = "Ver-consultorios";

                        }
                    })

              </script>';

            }else{

                echo'error';
            }
        }

    }

    static public function AgendarCitaDoctorC(){

        if(isset($_POST["idDoctorCita"])){

            $tablaBD="citas";


            $datos = array(
                    "Did"=>$_POST["idDoctorCita"], 
					"Cid"=>$_POST["idConsultorioCita"], 
                    "nyaC"=>$_POST["nombrePaciente"], 
                    "doctorC"=>$_POST["doctorCita"],
					"fyhIC"=>$_POST["fechayhoraInicial"], 
					"fyhFC"=>$_POST["fechayhoraFinal"]
            );

            $resultado = CitasM::AgendarCitaDoctorM($tablaBD, $datos);

            if($resultado == true){

                echo'<script>

                swal({
                      type: "success",
                      title: "¡Cita agregada correctamente",
                      showConfirmButton: true,
                      confirmButtonText: "Cerrar"
                      }).then(function(result){
                        if (result.value) {

                        window.location = "Citas";

                        }
                    })

              </script>';

            }else{

                echo'error';
            }
        }

    }
    // VER CITAS TODAS HISTORIAL
    static public function VerCitasC(){

        $tablaBD = "citas";

        // CUANDO QUEREMOS VER POR COLUMNA SE USA 

        //COLUMNA Y VALOR

        $resultado = CitasM::VerCitasM($tablaBD);

        return $resultado;
    }

    
    static public function EliminarCitaC(){

        if(isset($_GET["idCita"])){
            
            $tablaBD = "citas";

            $id = $_GET["idCita"];


            $resultado = CitasM::EliminarCitaM($tablaBD, $id);

            if($resultado == true && $_SESSION["rol"] == "Doctor"){
                echo' <script>
				swal({
                    type: "success",
                    title: "La cita ha sido borrado correctamente",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar"
                    }).then(function(result){
                              if (result.value) {

                              window.location = "historialDoctor";

                              }
                          })

                </script>';

            }elseif($resultado == true && $_SESSION["rol"] == "Paciente"){
                echo' <script>
				swal({
                    type: "success",
                    title: "La cita ha sido borrado correctamente",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar"
                    }).then(function(result){
                              if (result.value) {

                              window.location = "historial";

                              }
                          })

                </script>';

            }elseif($resultado == true && $_SESSION["rol"] == "Administrador" || $_SESSION["rol"] == "Secretaria"){
                echo' <script>
				swal({
                    type: "success",
                    title: "La cita ha sido borrado correctamente",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar"
                    }).then(function(result){
                              if (result.value) {

                              window.location = "historial-total";

                              }
                          })

                </script>';

            }
        }
    }
}

