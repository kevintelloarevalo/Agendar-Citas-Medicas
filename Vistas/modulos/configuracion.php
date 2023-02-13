<?php //abrimos PHP
    if($_SESSION["rol"] != "Administrador" ){

        echo '<script>
           window.location "inicio";    
        </script>'; //no olvidar el punto ;
     return;
   }

?>


<!--MAQUETACIÓN DE DATOS DE LA EMPRESA-->
<div class="content-wrapper"><!--Para abrir una interfaz---->
    <section class="content-header"><!--Para el encabezado de la interfaz--->
        <h1>Datos de la Empresa</h1><!--Titulo--->
        <ol class="breadcrumb">

            <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
            
            <li class="active">Empresa</li>
        
        </ol>
    </section>
    <section class="content"><!--Contenido---->
        
        <div class="box">

            <div class="box-body"><!---Cuerpo de la caja--->
                <!--Creo ua tabla-->
                <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
                    <thead>
                        <tr>
                            <td>Nombre</td>
                            <td>RUC</td>
                            <td>Télefono</td>
                            <td>Dirección</td>
                            <td>Correo</td>
                            <td>Foto</td>
                            <td>HorarioE</td>
                            <td>HorarioS</td>
                            <td>Acciones</td>
                        </tr>
                    </thead>
                    
                    <tbody>
                    <?php
                        $columna = null;
                        $valor = null;

                        $respuesta = OrganizacionC::VerOrganizacionC($columna, $valor);
                        
                        foreach ($respuesta as $key => $value) {

                            echo'<tr>
                                    <td>'.$value["nombre"].'</td>
                                    <td>'.$value["ruc"].'</td>
                                    <td>'.$value["telefono"].'</td>
                                    <td>'.$value["direccion"].'</td>
                                    <td>'.$value["correo"].'</td>';
                                    if($value["logo"] != ""){ //si logo es diferente a null (mostrar foto)

                                        echo '<td><img src="'.$value["logo"].'" class="img-thumbnail" width="40px"></td>';
                          
                                    }else{ //sino la por defecto
                          
                                        echo '<td><img src="Vistas/img/usuario.png" class="img-thumbnail" width="40px"></td>';
                          
                                    }
                                    echo'<td>'.$value["horarioE"].'</td>
                                        <td>'.$value["horarioS"].'</td>
                                        <td>
                                            <div class="btn-group">
                                                    
                                                <button class="btn btn-success btnEditarOrganizacion" idOrganizacion="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarOrganizacion"><i class="fa fa-pencil"></i>Editar</button> 


                                            </div>
                                        </td>

                                </tr>';

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
<!--=====================================
MODAL EDITAR EMPRESA
======================================-->

<div class="modal fade" role="dialog" id="modalEditarOrganizacion">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form class="needs-validation" role="form" enctype="multipart/form-data" method="post" novalidate> 

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Empresa</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">

              <div class="input-group">
              
                <span class="input-group-text"><i class="fa fa-code fa-fw"></i></span> 

                <input type="text" class="form-control input-lg form-control-lg" id="editarNombre" name="editarNombre" pattern="" required>
                <input type="hidden" id="idOrganizacion" name="idOrganizacion"> <!--ID organizacion->
                <!-- Mensajes para validación   
                <div class="valid-feedback">¡Campo válido!</div>
                <div class="invalid-feedback">Solo se acepta ##-00000</div>-->
              
              </div>

            </div>

            <!-- ENTRADA PARA EL RUC -->

            <div class="form-group">
            
              
              <div class="input-group">
              
                <span class="input-group-text"><i class="fa fa-code fa-fw"></i></span> 

                <input type="text" class="form-control input-lg form-control-lg" id="editarRuc" name="editarRuc"pattern="" required>
                    <!-- Mensajes para validación 
                <div class="valid-feedback">¡Campo válido!</div>
                <div class="invalid-feedback">Solo se acepta letras máximo 20 dígitos.</div>-->
              </div>

            </div>

            <!-- ENTRADA PARA EL TELEFONO -->
            
            <div class="form-group">
            
              <div class="input-group">
              
                <span class="input-group-text"><i class="fa fa-code fa-fw"></i></span> 

                <input type="text" class="form-control input-lg form-control-lg" id="editarTelefono" name="editarTelefono" pattern="" required>

                <!-- Mensajes para validación   
                <div class="valid-feedback">¡Campo válido!</div>
                <div class="invalid-feedback">Solo se acepta ##-00000</div>-->
              
              </div>

            </div>
            <!-- ENTRADA PARA LA DIRECCION -->

            <div class="form-group">
                
              
              <div class="input-group">
              
                <span class="input-group-text"><i class="fa fa-code fa-fww"></i></span> 

                <input type="text" class="form-control input-lg form-control-lg" id="editarDireccion" name="editarDireccion" pattern="" required>
                    <!-- Mensajes para validación 
                <div class="valid-feedback">¡Campo válido!</div>
                <div class="invalid-feedback">Solo se acepta letras máximo 20 dígitos.</div>-->
              
              </div>

            </div>
            <!-- ENTRADA PARA EL CORREO -->
            <div class="form-group">
                
              <div class="input-group">
              
                <span class="input-group-text"><i class="fa fa-code fa-fw"></i></span> 

                <input type="text" class="form-control input-lg form-control-lg" id="editarCorreo" name="editarCorreo" pattern="" required>
                <!-- Mensajes para validación 
                <div class="valid-feedback">¡Campo válido!</div>
                <div class="invalid-feedback">Solo se acepta letras máximo 20 dígitos.</div>-->
              
              </div>

            </div>            
            <!-- ENTRADA PARA EL HORA ENTRADA -->
            <div class="form-group">
                
              <div class="input-group">
              
                <span class="input-group-text"><i class="fa fa-code fa-fw"></i></span> 

                <input type="time" class="form-control input-lg form-control-lg" id="editarHoraE" name="editarHoraE" pattern="" required>
                <!-- Mensajes para validación 
                <div class="valid-feedback">¡Campo válido!</div>
                <div class="invalid-feedback">Solo se acepta letras máximo 20 dígitos.</div>-->
              
              </div>

            </div>
            <!-- ENTRADA PARA LA HORA SALIDA -->
            <div class="form-group">
                
              <div class="input-group">
              
                <span class="input-group-text"><i class="fa fa-code fa-fw"></i></span> 

                <input type="time" class="form-control input-lg form-control-lg" id="editarHoraS" name="editarHoraS" pattern="" required>
                <!-- Mensajes para validación 
                <div class="valid-feedback">¡Campo válido!</div>
                <div class="invalid-feedback">Solo se acepta letras máximo 20 dígitos.</div>-->
              
              </div>

            </div>

            <!-- ENTRADA PARA SUBIR LOGO -->

            <div class="form-group">
                
                <div class="panel">SUBIR FOTO</div>

                <input type="file" class="nuevaFoto" name="editarFoto" required>

                <p class="help-block">Peso máximo de la foto 2MB</p>

                <div class="invalid-feedback">Debes seleccionar una imagén.</div>

                <img src="Vistas/img/usuario.png" class="img-thumbnail previsualizar" width="100px">

                <input type="hidden" name="fotoActual" id="fotoActual">

            </div>   

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-success pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Editar Datos</button>

        </div>

      </form>

      <?php

        $editarOrganización = new OrganizacionC();
        $editarOrganización -> EditarOrganizacionC();

      ?>  

    </div>

  </div>

</div>

