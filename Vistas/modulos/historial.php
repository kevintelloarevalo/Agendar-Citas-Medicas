
<!--MAQUETACIÓN DE GESTOR DE DOCTORES-->
<div class="content-wrapper"> <!--Para abrir una interfaz---->

    <section class="content-header"> <!--Para el encabezado de la interfaz--->

        <h1>Mi Historial de Citas Médicas</h1> <!--Titulo--->

        <ol class="breadcrumb">

            <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
            
            <li class="active">Historial de Citas Médicas</li>
        
        </ol>
    </section>

    <section class="content"> <!--Contenido---->

      <div class="box">
            <div class="box-header">
                
                 <a class="btn btn-success" href="Ver-consultorios">Agregar Cita</a>  <!----Boton para enviar el formulario--->
            
            </div>
            <div class="box-body"> <!---Cuerpo de la caja--->
                <!--Creo ua tabla-->
                <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
                    <thead> <!---Para la cabezera de la tabla--->
                        <tr>
                            
                            <td>Fecha y Hora</td>
                            <td>Doctor</td>
                            <td>Paciente</td>
                            <td>Consultorio</td>
                            <td>Acciones</td>
                        </tr>

                    </thead>

                    <tbody>
                        <?php

                            $resultado = CitasC::VerCitasC();

                            foreach ($resultado as $key => $value) {

                                if($_SESSION["documento"] == $value["documento"]){

                                    echo'<tr>
                                        
                                        <td>'.$value["inicio"].'</td>
                                        <td>'.$value["doctor"].'</td>
                                        <td>'.$value["paciente"].'</td>';
                                        
                                        $columna="id"; //id consultorio
                                        $valor = $value["id_consultorio"];

                                        $consultorio = ConsultoriosC::VerConsultoriosC($columna, $valor);

                                        echo'<td>'.$consultorio["nombre"].'</td>
                                        <td>
                                            <div class="btn-group">

                                                <button class="btn btn-danger btnEliminarCita" idCita="'.$value["id"].'"><i class="fa fa-times"></i>Cancelar Cita</button> 

                                            </div>
                                        </td>
                                    
                                    </tr>';
                                }



                            }
 
                        ?>


                    </tbody>
                
                </table>

            </div>

        </div>

    </section>

</div>

<footer class="main-footer">

  <strong>Copyright &copy; 2023 <a href="" target="_blank">Desarrollador --> Kevin Tello Arévalo</a>
  </strong>

</footer>
