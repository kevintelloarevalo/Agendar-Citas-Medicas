<?php //abrimos PHP
    if($_SESSION["rol"] != "Secretaria" && $_SESSION["rol"] != "Administrador"){

        echo '<script>
           window.location "inicio";    
        </script>'; //no olvidar el punto ;
     return;
   }

?>

<div class="content-wrapper"> <!--Para abrir una interfaz---->

    <section class="content-header"> <!--Para los titulos---->
        
        <h1>Gestor de Consultorios</h1>  <!--Titulo------>

        <ol class="breadcrumb">

          <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
            
          <li class="active">Gestor de Consultorios</li>
            
        </ol>

    </section>

    <section class="content"> <!--contenido--->

        <div class="box">  <!--caja -->

            <div class="box-header with-border">  <!--caja cabeza-->

                    <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarConsultorio">Agregar Consultorio

                    </button> <!----Boton para enviar el formulario--->
                
            </div>

            <div class="box-body">

              <table class="table table-bordered table-striped dt-responsive tablas" width="100%">

                    <thead>  
                        <tr>
                            <th style="width:10px">N°</th>
                            <th>Nombre</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        
                        $columna = null;
                        $valor= null;

                        //Que haga una conexión con la función 
                        $resultado = ConsultoriosC::VerConsultoriosC($columna, $valor);
                        
                        foreach ($resultado as $key => $value) {  //ahora al foreach le pasamos el objeto value(ese representa a $resultado)
                            
                            echo '<tr>
                                    <th>'.($key+1).'</th>
                                    <th>'.$value["nombre"].'</th>
                                    <th> 
                                        <div class="btn-group">
                                            
                                            <button class="btn btn-success btnEditarConsultorio" idConsultorio="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarConsultorio"><i class="fa fa-pencil"></i>Editar</button> 
                                            

                                            <!---Propiedades de modal
                                            data-toggle="modal" data-target="#"--->
                                            
                                            
                                            <!---Para iconos es etiqueta <i></i> 
                                            Para colores de botones en BOOTRAP ES class="btn btn-warning" el segundo btn va junto al typo---->
                                            
                                            
                                            <button class="btn btn-danger btnEliminarConsultorio" idConsultorio="'.$value["id"].'"><i class="fa fa-times"></i>Borrar</button> 
                                            
                                            
                                        </div>
                                    </th>
                                </tr>';


                        }

                        ?>

                    </tbody>

                </table>

            </div>

        </div>

    </section > 

</div>

<footer class="main-footer">

  <strong>Copyright &copy; 2023 <a href="" target="_blank">Desarrollador --> Kevin Tello Arévalo</a>
  </strong>

</footer>

<!--=====================================
   MODAL AGREGAR CONSULTORIO
======================================-->
<div id="modalAgregarConsultorio"class="modal fade" tabindex="-1" role="dialog">

    <div class="modal-dialog" role="document">

      <div class="modal-content">

      <form class="needs-validation" role="form" enctype="multipart/form-data" method="post" novalidate> <!--ese ectype esta para sacarlo xd>

      <!--=====================================
          Cabeza DEL MODAL
      ======================================-->

        <div class="modal-header" style="background: #605ca8; color: white">

          <h4 class="modal-title">Agregar Consultorio</h4>

          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">

            <span aria-hidden="true">&times;</span>

          </button>

        </div>
      <!--=====================================
              CUERPO DEL MODAL
      ======================================-->
          <div class="modal-body">

            <div class="box-body">

                  <!-- ENTRADA CONSULTORIO -->

              <div class="form-group">
            
                <div class="input-group">

                  <span class="input-group-text"><i class="fa fa-user fa-fw"></i></span>
                  <input type="text" class="form-control input-lg form-control-lg" name="consultorioN" placeholder="Ingresar consultorio" pattern="[a-zA-Z ]{4,15}" required>
                  <!-- Mensajes para validación   
                  <div class="valid-feedback">¡Campo válido!</div>
                  <div class="invalid-feedback">La categoría solo podra contener letras no mayor a 15 digitos.</div>-->
                  
                </div>

              </div>

            </div> 

          </div>

        <!--=====================================
          PIE DEL MODAL
          ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-success pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar consultorio</button>

        </div>
        <?php

          $consultorios = new ConsultoriosC();  //OBJETO AL CONTROLADOR
          $consultorios -> CrearConsultoriosC();  // OBJETO APUNTANDO ALA FUNCIÓN

        ?>

      </form>

    </div>

  </div>

</div>


 <!--=====================================
 MODAL EDITAR CONSULTORIO
 ======================================-->
 <div id="modalEditarConsultorio"class="modal fade" role="dialog">

<div class="modal-dialog" role="document">

  <div class="modal-content">

    <form class="needs-validation" role="form" enctype="multipart/form-data" method="post" novalidate> 

    <!--=====================================
        Cabeza DEL MODAL
    ======================================-->

      <div class="modal-header" style="background: #605ca8; color: white">

        <h4 class="modal-title">Editar Consultorio</h4>

        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">

          <span aria-hidden="true">&times;</span>

        </button>

      </div>
    <!--=====================================
            CUERPO DEL MODAL
    ======================================-->
        <div class="modal-body">

          <div class="box-body">

                <!-- ENTRADA PARA EDITAR CATEGORIA -->

            <div class="form-group">
          
              <div class="input-group">

                <span class="input-group-text"><i class="fa fa-user fa-fw"></i></span>

                <input type="text" class="form-control input-lg form-control-lg" name="editarConsultorio" id="editarConsultorio" required>
                
                  <input type="hidden"  name="idConsultorio" id="idConsultorio" required>

                <!-- Mensajes para validación 
                <div class="valid-feedback">¡Campo válido!</div>
                <div class="invalid-feedback">La categoría solo podra contener letras no mayor a 15 digitos.</div>
                -->
              </div>

            </div>

          </div> 

        </div>

      <!--=====================================
        PIE DEL MODAL
        ======================================-->

      <div class="modal-footer">

        <button type="button" class="btn btn-success pull-left" data-dismiss="modal">Salir</button>

        <button type="submit" class="btn btn-primary">Guardar Cambios</button>

      </div>

      <?php

          $editarconsultorios = new ConsultoriosC();

          $editarconsultorios -> EditarConsultoriosC();

      ?> 
    </form>

  </div>

</div>

</div>

<?php

    $consultorios = new ConsultoriosC();

    $consultorios -> EliminarConsultoriosC();


?>