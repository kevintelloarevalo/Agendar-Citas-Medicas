<?php

session_start();

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Clínica Médica</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <!-- Bootstrap 3.3.7 NO MOVER LE DA MUCHO ESTILO
  <link rel="stylesheet" href="Vistas/bower_components/bootstrap/dist/css/bootstrap.min.css"> -->

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="Vistas/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="Vistas/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style no- es la defecto
  <link rel="stylesheet" href="Vistas/dist/css/AdminLTE.min.css">--->

  <!-- AdminLTE Skins.  copy es el mas bonito-->
  <link rel="stylesheet" href="Vistas/dist/css/AdminLTE copy.css">
       
  <link rel="stylesheet" href="Vistas/dist/css/skins/_all-skins.min.css">
   <!-- DATABLE CSS uno--> 
  <link rel="stylesheet" href="Vistas/dist/css/dataTables.bootstrap5.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="Vistas/bower_components/datatables.net-bs/css/responsive.bootstrap.min.css">
  <link rel="stylesheet" href="Vistas/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

  <!-- FullCalendar -->
  <link rel="stylesheet" href="Vistas/bower_components/fullcalendar/dist/fullcalendar.min.css">
  <link rel="stylesheet" href="Vistas/bower_components/fullcalendar/dist/fullcalendar.print.min.css" media="print">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  
  <!-- plantilla agregada de boostrap4 si la saco se normaliza-->
  <link href="Vistas/dist/css/bootstrap.min.css" rel="stylesheet">

  <!--JAVASCRIPT--->


  <!-- jQuery 3 NO MOVER--> 
  <script src="Vistas/bower_components/jquery/dist/jquery.min.js"></script>

  
  <!-- Bootstrap 3.3.7 NO MOVER
  <script src="Vistas/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>-->
  <script src="Vistas/dist/js/bootstrap.min.js"></script>
  <script src="Vistas/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://unpkg.com/@popperjs/core@2"></script>

  <!-- SlimScroll -->
  <script src="Vistas/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
  <!-- FastClick -->
  <script src="Vistas/bower_components/fastclick/lib/fastclick.js"></script>
  <!-- AdminLTE App -->
  <script src="Vistas/dist/js/adminlte.min.js"></script>

  <!-- AdminLTE for demo purposes -->
  <script src="Vistas/dist/js/demo.js"></script>
    <!-- SweetAlert 2-->
  <script src="Vistas/plugins/sweetalert2/sweetalert2.all.js"></script>
      <!-- By default SweetAlert2 doesn't support IE. To enable IE 11 support, include Promise polyfill:-->

  <!-- DataTables -->
  <script src="vistas/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="vistas/dist/css/dataTables.bootstrap5.min.js"></script>

  <script src="vistas/bower_components/datatables.net-bs/js/dataTables.responsive.min.js"></script>
  <script src="vistas/bower_components/datatables.net-bs/js/responsive.bootstrap.min.js"></script>

  <!-- fullCalendar -->
  <script src="Vistas/bower_components/moment/moment.js"></script>
  <script src="Vistas/bower_components/fullcalendar/dist/fullcalendar.min.js"></script>
  <script src="Vistas/bower_components/fullcalendar/dist/locale/es.js"></script>

</head>


<body class="hold-transition skin-blue sidebar-mini login-page">
<!-- Site wrapper -->


  <?php

  if(isset($_SESSION["Ingresar"]) && $_SESSION["Ingresar"] == true){

    echo '<div class="wrapper">';

    include "modulos/cabecera.php";

    if($_SESSION["rol"] == "Secretaria"){

      include "modulos/menuSecretaria.php";

    }else if($_SESSION["rol"] == "Paciente"){

      include "modulos/menuPaciente.php";

    }else if($_SESSION["rol"] == "Doctor"){

      include "modulos/menuDoctor.php";

    }else if($_SESSION["rol"] == "Administrador"){

      include "modulos/menuAdmin.php";

    }

    

    $url = array();

    if(isset($_GET["url"])){

      $url = explode("/", $_GET["url"]);

      if($url[0] == "inicio" || $url[0] == "salir" || $url[0] == "perfil-Secretaria" || $url[0] == "perfil-S" || $url[0] == "consultorios" || $url[0] == "E-C" || $url[0] == "doctores" || $url[0] == "pacientes" || $url[0] == "perfil-Paciente" || $url[0] == "perfil-P" || $url[0] == "Ver-consultorios" || $url[0] == "Doctor" || $url[0] == "historial" || $url[0] == "perfil-Doctor" || $url[0] == "perfil-D" || $url[0] == "Citas" || $url[0] == "perfil-Administrador" || $url[0] == "perfil-A" || $url[0] == "secretarias" || $url[0] == "inicio-editar" || $url[0] == "configuracion"|| $url[0] == "historial-total"|| $url[0] == "historialDoctor"){

        include "modulos/".$url[0].".php";

      }

    }else{

        include "modulos/inicio.php";

    }


      echo '</div>';

    }else if(isset($_GET["url"])){

      if($_GET["url"] == "seleccionar"){

        include "modulos/seleccionar.php";

      }else if($_GET["url"] == "ingreso-Secretaria"){

        include "modulos/ingreso-Secretaria.php";

      }else if($_GET["url"] == "ingreso-Paciente"){

        include "modulos/ingreso-Paciente.php";

      }else if($_GET["url"] == "ingreso-Doctor"){

        include "modulos/ingreso-Doctor.php";

      }else if($_GET["url"] == "ingreso-Administrador"){

        include "modulos/ingreso-Administrador.php";

      }

    }else {

      include "modulos/seleccionar.php";

    }


  ?>

<script>
  $(document).ready(function () {
    $('.sidebar-menu').tree()
  })


  var date = new Date()
  var d    = date.getDate(),
      m    = date.getMonth(),
      y    = date.getFullYear()

  $('#calendar').fullCalendar({

    header:{
          left: 'prev, next',
          center: 'title',
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

                    if($value["id_doctor"] == $_GET["idDoctor"]){

                       echo '{
                              //no tocar
                              id: '.$value["id"].',
                              backgroundColor: "#f56954",
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

        $columna = "id";
        $valor = $_GET["idDoctor"];

            $resultado = DoctoresC::VerDoctorC($columna, $valor);
            
            echo 'scrollTime: "'.$resultado["horarioE"].'",
                    minTime: "'.$resultado["horarioE"].'",
                    maxTime: "'.$resultado["horarioS"].'",';
            
      ?>

    dayClick:function(date, jsEvent, view){

      $('#modalAgendarCita').modal();
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
<script src="Vistas/js/plantilla.js"></script>
<script src="Vistas/js/admin.js"></script>
<script src="Vistas/js/cita.js"></script>
<script src="Vistas/js/consultorios.js"></script>
<script src="Vistas/js/doctor.js"></script>
<script src="Vistas/js/organizacion.js"></script>
<script src="Vistas/js/paciente.js"></script>
<script src="Vistas/js/secretaria.js"></script>

</body>
</html>
