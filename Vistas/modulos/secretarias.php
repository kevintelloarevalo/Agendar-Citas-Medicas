<?php //abrimos PHP
    if($_SESSION["rol"] != "Administrador"){

        echo '<script>
           window.location "inicio";    
        </script>'; //no olvidar el punto ;
     return;
   }

?>


<!--MAQUETACIÓN DE GESTOR DE PACIENTES-->
<div class="content-wrapper"><!--Para abrir una interfaz---->
    <section class="content-header"><!--Para el encabezado de la interfaz--->
        <h1>Gestor de Secretarias</h1><!--Titulo--->
        <ol class="breadcrumb">

            <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
            
            <li class="active">Gestor de Secretarias</li>
        
        </ol>
    </section>
    <section class="content"><!--Contenido---->
        
        <div class="box">
        
            <div class="box-header with-border">
                <button type="submit" class="btn btn-success" data-toggle="modal" data-target="#modalAgregarSecretaria">Agregar Secretaria
                    
                </button> <!----Boton para enviar el formulario--->
            </div>

            <div class="box-body"><!---Cuerpo de la caja--->
                <!--Creo ua tabla-->
                <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
                    <thead>
                        <tr>
                            <td>N°</td>
                            <td>Nombres</td>
                            <td>Apellidos</td>
                            <td>Foto</td>
                            <td>Usuario</td>
                            <td>Contraseña</td>
                            <td>Acciones</td>
                        </tr>
                    </thead>
                    
                    <tbody>
                    <?php
                        $columna = null;
                        $valor = null;

                        $respuesta = SecretariasC::DatosSecretariaModal($columna, $valor);
                        
                        foreach ($respuesta as $key => $value) {

                            echo'<tr>
                                    <td>'.($key+1).'</td>
                                    <td>'.$value["nombre"].'</td>
                                    <td>'.$value["apellido"].'</td>';

                                    if($value["foto"] != ""){ //si foto es diferente a null (mostrar foto)

                                        echo '<td><img src="'.$value["foto"].'" class="img-thumbnail" width="40px"></td>';
                          
                                    }else{ //sino la por defecto
                          
                                        echo '<td><img src="Vistas/img/secretaria.png" class="img-thumbnail" width="40px"></td>';
                          
                                    }
                                    echo'<td>'.$value["usuario"].'</td>
                                        <td>'.$value["clave"].'</td>
                                        <td>
                                            <div class="btn-group">
                                                    
                                                <button class="btn btn-success btnEditarSecretaria" idSecretaria="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarSecretaria"><i class="fa fa-pencil"></i>Editar</button> 

                                                <button class="btn btn-danger btnEliminarSecretaria" idSecretaria="'.$value["id"].'"fotoSecretaria="'.$value["foto"].'"><i class="fa fa-times"></i>Borrar</button> 

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
MODAL AGREGAR SECRETARIA
======================================-->

<div class="modal fade" role="dialog" id="modalAgregarSecretaria">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form class="needs-validation" role="form" enctype="multipart/form-data" method="post" novalidate> 

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Secretaria</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL USUARIO CORREO SECRETARIA -->
            
            <div class="form-group">

              <div class="input-group">
              
                <span class="input-group-text"><i class="fa fa-user fa fa-fw"></i></span> 

                <input type="text" class="form-control input-lg form-control-lg" name="nuevoUsuario" placeholder="Ingresar el usuario" pattern="" required>
                <input type="hidden" name="nuevoRol" value="Secretaria"> <!--Siempre sea Secretaria->
                <!-- Mensajes para validación   
                <div class="valid-feedback">¡Campo válido!</div>
                <div class="invalid-feedback">Solo se acepta ##-00000</div>-->
              
              </div>

            </div>

            <!-- ENTRADA PARA LA CONTRASEÑA -->

            <div class="form-group">
            
              
              <div class="input-group">
              
                <span class="input-group-text"><i class="fa fa-lock fa fa-fw"></i></span> 

                <input type="password" class="form-control input-lg form-control-lg" name="nuevoPassword" placeholder="Ingresar contraseña" pattern="" required>
                    <!-- Mensajes para validación 
                <div class="valid-feedback">¡Campo válido!</div>
                <div class="invalid-feedback">Solo se acepta letras máximo 20 dígitos.</div>-->
              </div>

            </div>

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
            
              <div class="input-group">
              
                <span class="input-group-text"><i class="fa fa-user fa fa-fw"></i></span> 

                <input type="text" class="form-control input-lg form-control-lg" name="nuevoNombre" placeholder="Ingresar los nombres" pattern="" required>

                <!-- Mensajes para validación   
                <div class="valid-feedback">¡Campo válido!</div>
                <div class="invalid-feedback">Solo se acepta ##-00000</div>-->
              
              </div>

            </div>
            <!-- ENTRADA PARA LOS APELLIDOS -->

            <div class="form-group">
                
              
              <div class="input-group">
              
                <span class="input-group-text"><i class="fa fa-user fa fa-fw"></i></span> 

                <input type="text" class="form-control input-lg form-control-lg" name="nuevoApellido" placeholder="Ingresar Apellidos" pattern="[a-zA-Z ]{4,25}" required>
                    <!-- Mensajes para validación 
                <div class="valid-feedback">¡Campo válido!</div>
                <div class="invalid-feedback">Solo se acepta letras máximo 20 dígitos.</div>-->
              
              </div>

            </div>
        
        </div>

    </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-success pull-left" data-bs-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar Secretaria</button>

        </div>

      </form>

      <?php

        $crearSecretaria = new SecretariasC();
        $crearSecretaria -> CrearSecretariaC();

      ?>  

    </div>

  </div>

</div>


<!--=====================================
MODAL EDITAR SECRETARIA
======================================-->

<div id="modalEditarSecretaria" class="modal fade" role="dialog" >
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form class="needs-validation" role="form" enctype="multipart/form-data" method="post" novalidate> 

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Secretaria</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL USUARIO CORREO SECRETARIA -->
            
            <div class="form-group">

              <div class="input-group">
              
                <span class="input-group-text"><i class="fa fa-user fa fa-fw"></i></span> 

                <input type="text" class="form-control input-lg form-control-lg" id="editarUsuario" name="editarUsuario" placeholder="Editar el usuario" pattern="" required>
                <input type="hidden" id="idSecretaria" name="idSecretaria"> <!--ID SECRETARIA->
                <!-- Mensajes para validación   
                <div class="valid-feedback">¡Campo válido!</div>
                <div class="invalid-feedback">Solo se acepta ##-00000</div>-->
              
              </div>

            </div>

            <!-- ENTRADA PARA LA CONTRASEÑA -->

            <div class="form-group">
            
              
              <div class="input-group">
              
                <span class="input-group-text"><i class="fa fa-lock fa fa-fw"></i></span> 

                <input type="password" class="form-control input-lg form-control-lg" id="editarPassword" name="editarPassword" placeholder="Editar contraseña" pattern="" required>
                    <!-- Mensajes para validación 
                <div class="valid-feedback">¡Campo válido!</div>
                <div class="invalid-feedback">Solo se acepta letras máximo 20 dígitos.</div>-->
              </div>

            </div>

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
            
              <div class="input-group">
              
                <span class="input-group-text"><i class="fa fa-user fa fa-fw"></i></span> 

                <input type="text" class="form-control input-lg form-control-lg" id="editarNombre" name="editarNombre" placeholder="Ingresar los nombres" pattern="" required>

                <!-- Mensajes para validación   
                <div class="valid-feedback">¡Campo válido!</div>
                <div class="invalid-feedback">Solo se acepta ##-00000</div>-->
              
              </div>

            </div>
            <!-- ENTRADA PARA LOS APELLIDOS -->

            <div class="form-group">
                
              
              <div class="input-group">
              
                <span class="input-group-text"><i class="fa fa-user fa fa-fw"></i></span> 

                <input type="text" class="form-control input-lg form-control-lg" id="editarApellido" name="editarApellido" name="editarApellido" placeholder="Ingresar Apellidos" pattern="" required>
                    <!-- Mensajes para validación 
                <div class="valid-feedback">¡Campo válido!</div>
                <div class="invalid-feedback">Solo se acepta letras máximo 20 dígitos.</div>-->
              
              </div>

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-success pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Editar Secretaria</button>

        </div>

      </form>

      <?php

        $editarSecretaria = new SecretariasC();
        $editarSecretaria -> EditarSecretariasC();

      ?>  

    </div>

  </div>

</div>

<?php

  $eliminarSecretaria = new SecretariasC();
  $eliminarSecretaria -> EliminarSecretariasC();

?>  