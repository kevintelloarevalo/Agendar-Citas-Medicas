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
        
        <h1>Elija el consultorio que desea pasar Cita</h1>  <!--Titulo------>

        <ol class="breadcrumb">

          <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
            
          <li class="active">Elegir Consultorio </li>
            
        </ol>

    </section>

    <section class="content"> <!--contenido--->

        <div class="box">  <!--caja -->

            <div class="box-body">

                <?php
                
                    $columna=null;
                    $valor =null;

                    $respuesta=ConsultoriosC::VerConsultoriosC($columna, $valor);

                    foreach ($respuesta as $key => $value) {
                        echo '<div class="col-lg-3 col-xs-6">

                                <div class="small-box bg-aqua">
                                    <div class="inner">
                                        <h2>'.$value["nombre"].'</h2>';

                                        $columna="id_consultorio"; //id de la tabla doctor
                                        $valor= $value["id"]; // id del consultorio

                                        $doctores = DoctoresC::DoctorC($columna,$valor);

                                        //$id=$_GET["idDoctor"];

                                        foreach ($doctores as $key => $value) {
                                          
                                          if($value["sexo"] == "Femenino"){

                                            echo'<button class="btn btn-success btnID" idDoctor="'.$value["id"].'">Doctora: '.$value["nombre"].' '.$value["apellido"].'</button>';
                            
                                          }else{
                              
                                            echo'<button class="btn btn-success btnID" idDoctor="'.$value["id"].'">Doctor: '.$value["nombre"].' '.$value["apellido"].'</button>';
                              
                                          }

                                        }
                                echo'</div>
                                </div>
                            </div>';
                    }

                ?>
            
            </div>

        </div>

    </section > 

</div>

<footer class="main-footer">

  <strong>Copyright &copy; 2023 <a href="" target="_blank">Desarrollador --> Kevin Tello Arévalo</a>
  </strong>

</footer>
