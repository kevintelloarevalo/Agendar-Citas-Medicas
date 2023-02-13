<?php //abrimos PHP
    if($_SESSION["rol"] != "Doctor" ){

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

            $valor= $_SESSION["id"];
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


<div class="modal fade" role="dialog" id="modalAgendarCitaDoctor">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form class="needs-validation" role="form" enctype="multipart/form-data" method="post" novalidate> 

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-bs-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agendar Cita</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <?php

            $columna ="id";
            $valor = $_SESSION["id"];

            $resultado =DoctoresC::VerDoctorC($columna, $valor);

                echo'<div class="form-group">
        
                        <input type="hidden" name="idDoctorCita" value="'.$resultado["id"].'"> 
                    
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
        
        <!-- ENTRADA PARA SELECCIONAR PACIENTES -->

        <div class="form-group">
              <h3>Paciente:</h3>
                <div class="input-group">
                    
                    <span class="input-group-text"><i class="fa fa-user fa-fw"></i></span> 

                        <select class="form-control input-lg form-control-lg"  name="nombrePaciente" required>
                            
                            <?php
                            echo '<option>Selecciona Paciente</option>';

                                $columna = null;
                                $valor = null;

                                $pacientes = PacientesC::VerPacienteC($columna, $valor);

                                foreach ($pacientes as $key => $value) {
                                        
                                    echo '<option value="'.$value["nombre"].' '.$value["apellido"].'">'.$value["nombre"].' '.$value["apellido"].'</option>';
                                }

                                ?>

                        </select>

                </div>
        </div>

        <!-- ENTRADA PARA EL DOCTOR CITA-->
            <?php
            echo'<div class="form-group">
                    
                    <h3>Doctor:</h3>
                
                <div class="input-group">
                    
                    <span class="input-group-text"><i class="fa fa-user-md"></i></span> 
    
                    <input type="text" class="form-control input-lg form-control-lg" name="doctorCita" value ="'.$_SESSION["nombre"].' '.$_SESSION["apellido"].'" readonly>
    
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
                
                <span class="input-group-text"><i class="fa fa-clock-o  fa-fw"></i></span> 

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

        $crearCitas = new CitasC();
        $crearCitas -> AgendarCitaDoctorC();

      ?>  

    </div>

  </div>

</div>


<script>


  var date = new Date()
  var d    = date.getDate(),
      m    = date.getMonth(),
      y    = date.getFullYear()

  $('#calendar').fullCalendar({

     header:{
          left: 'prev, next',
          center: 'title',
          rigth: 'month',
      },

    //javascript usa siempre ","
    hiddenDays:[0,6],
    defaultView: 'agendaWeek',
    // MOSTRAR CITAS
    events:[

              <?php

                  $columna = null;
                  $valor = null;

                  $resultado = CitasC::VerCitasC($columna, $valor);

                  foreach ($resultado as $key => $value) {

                    if($value["id_doctor"] == $_SESSION["id"]){

                       echo '{
                              
                              id: '.$value["id"].',
                              backgroundColor: "yellow",
                              textColor: "black",
                              title:  "'.$value["paciente"].'",
                              start:"'.$value["inicio"].'",
                              end:"'.$value["fin"].'"
                              
                            },';

                      }
                  }
                 

              ?>

      ],
      <?php

      if($_SESSION["rol"] == "Doctor"){

        $columna = "id";
        $valor = $_SESSION["id"];

            $resultado = DoctoresC::VerDoctorC($columna, $valor);
            
            echo 'scrollTime: "'.$resultado["horarioE"].'",
                    minTime: "'.$resultado["horarioE"].'",
                    maxTime: "'.$resultado["horarioS"].'",';

      }
            
      ?>

    dayClick:function(date, jsEvent, view){

      $('#modalAgendarCitaDoctor').modal();
      var fecha = date.format();  // hora y fecha
      var hora2 = ("01:00:00").split(":"); // hora Inicial

      fecha = fecha.split("T"); // PARA SEPARAR LA FECHA DE LA HORA
      var dia = fecha[0];
      
      var hora = (fecha[1].split(":"));

      var h1 = parseFloat(hora[0]);  // la hora 06:00:00 agarra el primer parametro: 06
      var h2 = parseFloat(hora2[0]); // la hora  es siempre 01:00:00.

      var horaFinal = h1+h2 // si selecciono alas 7pm acabaria alas 8pm

      $('#fechaCita').val(dia); //asignamos la fecha (dia) en el ID: fechayhoraInicial

      $('#horaCita').val(h1+":00:00") // que siempre sea 7pm, 8pm cuando seleccionemos cita
      //ahora la FechayHoraInicial
      $('#fechayhoraInicial').val(fecha[0]+" "+h1+":00:00");
      //ahora la FechayHoraFinal
      $('#fechayhoraFinal').val(fecha[0]+" "+horaFinal+":00:00");

     }
    


  })

</script>