
<!--MAQUETACIÓN DE GESTOR DE DOCTORES-->
<div class="content-wrapper"> <!--Para abrir una interfaz---->

    <section class="content-header"> <!--Para el encabezado de la interfaz--->

        <h1>Historial de Citas Médicas</h1> <!--Titulo--->

        <ol class="breadcrumb">

            <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
            
            <li class="active">Historial de Citas Médicas</li>
        
        </ol>
    </section>

    <section class="content"> <!--Contenido---->

      <div class="box">
            <div class="box-header">
            
            </div>
            <div class="box-body"> <!---Cuerpo de la caja--->
                <!--Creo ua tabla-->
                <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
                    <thead> <!---Para la cabezera de la tabla--->
                        <tr>
                            
                            <td>Fecha y Hora</td>
                            <td>Paciente</td>
                            <td>Doctor</td>
                            <td>Consultorio</td>
                            <td>Acciones</td>
                        </tr>

                    </thead>

                    <tbody>
                        <?php

                            $resultado = CitasC::VerCitasC();

                            foreach ($resultado as $key => $value) {

                                //esta es una condición  //x ejemplo para doctor estamos comparando si el id de su sessión, es igual a la de la tabla cita, id,doctor
                                //if($_SESSION["id"] == $value["id_doctor"]){

                                    echo'<tr>
                                        
                                        <td>'.$value["inicio"].'</td>
                                        <td>'.$value["paciente"].'</td>
                                        <td>'.$value["doctor"].'</td>';

                                        
                                        
                                        $columna="id"; //id consultorio
                                        $valor = $value["id_consultorio"];

                                        $consultorio = ConsultoriosC::VerConsultoriosC($columna, $valor);

                                        echo'<td>'.$consultorio["nombre"].'</td>
                                        <td>
                                            <div class="btn-group">

                                                <button class="btn btn-danger btnEliminarCita" idCita="'.$value["id"].'"><i class="fa fa-times"></i>Borrar</button> 

                                            </div>
                                        </td>
                                    
                                    </tr>';
                                //}



                            }
 
                        ?>


                    </tbody>
                
                </table>

            </div>

        </div>

    </section>

</div>

<?php

$eliminarCitas = new CitasC();
$eliminarCitas -> EliminarCitaC();

?>  

<footer class="main-footer">

  <strong>Copyright &copy; 2023 <a href="" target="_blank">Desarrollador --> Kevin Tello Arévalo</a>
  </strong>

</footer>
