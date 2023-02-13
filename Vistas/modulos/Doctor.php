<?php //abrimos PHP
    if($_SESSION["rol"] != "Paciente" ){

        echo '<script>
            window.location "inicio";    
        </script>'; //no olvidar el punto ;
        return;
    }

?>

<div class="content-wrapper"> <!--Para abrir una interfaz---->

    <section class="content-header"> <!--Para los titulos---->

        <?php

            $columna = "id";

            $valor= $_GET["idDoctor"];
            //$valor = substr($_GET["url"], -1);

            $resultado = DoctoresC::VerDoctorC($columna, $valor);

            if($resultado["sexo"] == "Femenino"){

                echo '<h1>Doctora: '.$resultado["apellido"].' '.$resultado["nombre"].'</h1>';

            }else{

                echo '<h1>Doctor: '.$resultado["apellido"].' '.$resultado["nombre"].'</h1>';

            }

            $columna = "id";
            $valor = $resultado["id_consultorio"];

            $consultorio = ConsultoriosC::VerConsultoriosC($columna, $valor);

            echo '<br>
            <h1>Consultorio de: '.$consultorio["nombre"].'</h1>';

        ?>

        <ol class="breadcrumb">

            <li><a href="inicio"><i class="fa fa-dashboard"></i>Inicio</a></li>  
            <li><a href="Ver-consultorios"><i class="fa fa-dashboard"></i>Ver-Consultorios</a></li>
            
            
        </ol>

    </section>

    <section class="content"> <!--contenido--->

        <div class="box">  <!--caja -->

            <div class="box-body">

                <div id="calendar"></div>
            
            </div>

        </div>

    </section > 

</div>

<footer class="main-footer">

  <strong>Copyright &copy; 2023 <a href="" target="_blank">Desarrollador --> Kevin Tello Arévalo</a>
  </strong>

</footer>

<!---CREANDO MODAL DE CITA CON DATOS DINAMICOS---->


<div class="modal fade" role="dialog" id="modalAgendarCita">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form class="needs-validation" role="form" enctype="multipart/form-data" method="post" novalidate> 

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agendar Cita</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <?php

            $columna ="id";
            $valor = $_GET["idDoctor"];

            $resultado =DoctoresC::VerDoctorC($columna, $valor);
                echo'<!-- NOMBRE DEL PACIENTE -->
            
                <div class="form-group">
                    <h3>Paciente:</h3>
    
                  <div class="input-group">
    
                    <span class="input-group-text"><i class="fa fa-code fa-fw"></i></span> 
                    <!---name: nombreyapellidopacienteCita--->
                    <input type="text" class="form-control input-lg form-control-lg" name="nyaCita" value ="'.$_SESSION["nombre"].' '.$_SESSION["apellido"].'" readonly>
                    <input type="hidden" name="idPacienteCita" value="'.$_SESSION["id"].'"> 
                    <input type="hidden" name="idDoctorCita" value="'.$resultado["id"].'"> 
                    
                  </div>
    
                </div>
    
                <!-- ENTRADA PARA EL DOCUMENTO PACIENTE CITA-->
    
                <div class="form-group">
                    
                    <h3>Documento:</h3>
                
                  <div class="input-group">
                    
                    <span class="input-group-text"><i class="fa fa-code fa-fw"></i></span> 
    
                    <input type="text" class="form-control input-lg form-control-lg" name="documentoCita" value ="'.$_SESSION["documento"].'" readonly>
    
                  </div>
    
                </div>
                <!-- ENTRADA PARA EL DOCTOR CITA-->
    
                <div class="form-group">
                    
                    <h3>Doctor:</h3>
                
                  <div class="input-group">
                    
                    <span class="input-group-text"><i class="fa fa-user-md"></i></span> 
    
                    <input type="text" class="form-control input-lg form-control-lg" name="doctorCita" value ="'.$resultado["nombre"].' '.$resultado["apellido"].'" readonly>
    
                  </div>
    
                </div>';
                
                $columna ="id";
                $valor = $resultado["id_consultorio"];

                $consultorio = ConsultoriosC::VerConsultoriosC($columna, $valor);

                    echo'<!-- ENTRADA PARA EL CONSULTORIO CITA-->
                        <div class="form-group">
                            <div class="input-group">
                                <input type="hidden" name="idConsultorioCita" value="'.$consultorio["id"].'"> 
                            </div>
                        </div>';
            ?>

            <!-- ENTRADA PARA EL FECHA CITA-->

            <div class="form-group">
                
                <h3>Fecha Cita:</h3>
            
              <div class="input-group">
                
                <span class="input-group-text"><i class="fa fa-calendar-plus-o"></i></span> 

                <input type="text" class="form-control input-lg form-control-lg" id="fechaCita" name="fechaCita" value ="" readonly>

              </div>

            </div>            
            <!-- ENTRADA PARA LA HORA CITA-->

            <div class="form-group">
                
                <h3>Hora Cita:</h3>
            
              <div class="input-group">
                
                <span class="input-group-text"><i class="fa  fa-clock-o fa-fw"></i></span> 

                <input type="text" class="form-control input-lg form-control-lg" id="horaCita" name="horaCita" value ="" readonly>

              </div>

            </div>   
            <!-- ENTRADA PARA LA HORA y FECHO OCULTO PARA LA BDD-->

            <div class="form-group">
            
              <div class="input-group">
                

                <input type="hidden" class="form-control input-lg form-control-lg" id="fechayhoraInicial" name="fechayhoraInicial" value="" readonly>
                <input type="hidden" class="form-control input-lg form-control-lg" id="fechayhoraFinal" name="fechayhoraFinal" value="" readonly>

              </div>

            </div>         

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-success pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Agendar Cita</button>

        </div>

      </form>

      <?php

        $crearCita = new CitasC();
        $crearCita -> AgendarCitaC();

      ?>  

    </div>

  </div>

</div>