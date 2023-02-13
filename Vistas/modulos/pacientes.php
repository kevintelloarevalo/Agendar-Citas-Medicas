<?php //abrimos PHP
    if($_SESSION["rol"] != "Secretaria" && $_SESSION["rol"] != "Administrador" && $_SESSION["rol"] != "Doctor"){

        echo '<script>
           window.location "inicio";    
        </script>'; //no olvidar el punto ;
     return;
   }

?>


<!--MAQUETACIÓN DE GESTOR DE PACIENTES-->
<div class="content-wrapper"><!--Para abrir una interfaz---->
    <section class="content-header"><!--Para el encabezado de la interfaz--->
        <h1>Gestor de Pacientes</h1><!--Titulo--->
        <ol class="breadcrumb">

            <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
            
            <li class="active">Gestor de Pacientes</li>
        
        </ol>
    </section>
    <section class="content"><!--Contenido---->
        
        <div class="box">
        
            <div class="box-header with-border">
                <button type="submit" class="btn btn-success" data-toggle="modal" data-target="#modalAgregarPaciente">Agregar Paciente
                    
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
                            <td>Género</td>
                            <td>DNI</td>
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

                        $respuesta = PacientesC::VerPacienteC($columna, $valor);
                        
                        foreach ($respuesta as $key => $value) {

                            echo'<tr>
                                    <td>'.($key+1).'</td>
                                    <td>'.$value["nombre"].'</td>
                                    <td>'.$value["apellido"].'</td>
                                    <td>'.$value["sexo"].'</td>
                                    <td>'.$value["documento"].'</td>';

                                    if($value["foto"] != ""){ //si foto es diferente a null (mostrar foto)

                                        echo '<td><img src="'.$value["foto"].'" class="img-thumbnail" width="40px"></td>';
                          
                                    }else{ //sino la por defecto
                          
                                        echo '<td><img src="Vistas/img/paciente.png" class="img-thumbnail" width="40px"></td>';
                          
                                    }
                                    echo'<td>'.$value["usuario"].'</td>
                                        <td>'.$value["clave"].'</td>
                                        <td>
                                            <div class="btn-group">
                                                    
                                                <button class="btn btn-success btnEditarPaciente" idPaciente="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarPaciente"><i class="fa fa-pencil"></i>Editar</button> 

                                                <button class="btn btn-danger btnEliminarPaciente" idPaciente="'.$value["id"].'"fotoPaciente="'.$value["foto"].'"><i class="fa fa-times"></i>Borrar</button> 

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
MODAL AGREGAR PACIENTE
======================================-->

<div class="modal fade" role="dialog" id="modalAgregarPaciente">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form class="needs-validation" role="form" enctype="multipart/form-data" method="post" novalidate> 

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Paciente</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL USUARIO CORREO DOCTOR -->
            
            <div class="form-group">

              <div class="input-group">
              
                <span class="input-group-text"><i class="fa fa-code fa-fw"></i></span> 

                <input type="text" class="form-control input-lg form-control-lg" name="nuevoUsuario" placeholder="Ingresar el usuario" pattern="" required>
                <input type="hidden" name="nuevoRol" value="Paciente"> <!--Siempre sea paciente->
                <!-- Mensajes para validación   
                <div class="valid-feedback">¡Campo válido!</div>
                <div class="invalid-feedback">Solo se acepta ##-00000</div>-->
              
              </div>

            </div>

            <!-- ENTRADA PARA LA CONTRASEÑA -->

            <div class="form-group">
            
              
              <div class="input-group">
              
                <span class="input-group-text"><i class="fa fa-lock fa-fw"></i></span> 

                <input type="password" class="form-control input-lg form-control-lg" name="nuevoPassword" placeholder="Ingresar contraseña" pattern="" required>
                    <!-- Mensajes para validación 
                <div class="valid-feedback">¡Campo válido!</div>
                <div class="invalid-feedback">Solo se acepta letras máximo 20 dígitos.</div>-->
              </div>

            </div>

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
            
              <div class="input-group">
              
                <span class="input-group-text"><i class="fa fa-user fa-fw"></i></span> 

                <input type="text" class="form-control input-lg form-control-lg" name="nuevoNombre" placeholder="Ingresar los nombres" pattern="[0-9a-zA-ZáéíñóúüÁÉÍÑÓÚÜ_-]{8}" required>

                <!-- Mensajes para validación   
                <div class="valid-feedback">¡Campo válido!</div>
                <div class="invalid-feedback">Solo se acepta ##-00000</div>-->
              
              </div>

            </div>
            <!-- ENTRADA PARA LOS APELLIDOS -->

            <div class="form-group">
                
              
              <div class="input-group">
              
                <span class="input-group-text"><i class="fa fa-user fa-fw"></i></span> 

                <input type="text" class="form-control input-lg form-control-lg" name="nuevoApellido" placeholder="Ingresar Apellidos" pattern="[a-zA-Z ]{4,25}" required>
                    <!-- Mensajes para validación 
                <div class="valid-feedback">¡Campo válido!</div>
                <div class="invalid-feedback">Solo se acepta letras máximo 20 dígitos.</div>-->
              
              </div>

            </div>
            <!-- ENTRADA PARA EL DOCUMENTO DNI -->
            <div class="form-group">
                
              <div class="input-group">
              
                <span class="input-group-text"><i class="fa fa-user fa-fw"></i></span> 

                <input type="text" class="form-control input-lg form-control-lg" name="nuevoDocumento" placeholder="Ingresar el Dni" pattern="" required>
                <!-- Mensajes para validación 
                <div class="valid-feedback">¡Campo válido!</div>
                <div class="invalid-feedback">Solo se acepta letras máximo 20 dígitos.</div>-->
              
              </div>

            </div>            
            <!-- ENTRADA PARA SELECCIONAR SEXO -->

            <div class="form-group">

                    <div class="input-group">
                    
                        <span class="input-group-addon"><i class="fa fa-th fa-fw"></i></span> 

                            <select class="form-control input-lg form-control-lg" name="nuevoGenero" required>
                        
                                <option value="">Selecionar Género</option>    
                                <option value="Masculino">Masculino</option>
                                <option value="Femenino">Femenino</option>

                            </select>

                            <!--<div class="valid-feedback">¡Campo válido!</div>
                            <div class="invalid-feedback">Debes seleccionar una categoría.</div>--->
                    </div>
            </div>

            <!-- ENTRADA PARA SUBIR FOTO 

            <div class="form-group">
              
              <div class="panel">SUBIR IMAGEN</div>

              <input type="file" class="nuevaImagen" name="nuevaImagen">


              <img src="vistas/img/usuario.png" class="img-thumbnail previsualizar" width="100px">

              
            </div>-->

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-success pull-left" data-bs-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar Paciente</button>

        </div>

      </form>

      <?php

        $crearPaciente = new PacientesC();
        $crearPaciente -> CrearPacienteC();

      ?>  

    </div>

  </div>

</div>


<!--=====================================
MODAL EDITAR PACIENTE
======================================-->

<div class="modal fade" role="dialog" id="modalEditarPaciente">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form class="needs-validation" role="form" enctype="multipart/form-data" method="post" novalidate> 

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Paciente</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL USUARIO CORREO DOCTOR -->
            
            <div class="form-group">

              <div class="input-group">
              
                <span class="input-group-text"><i class="fa fa-code fa-fw"></i></span> 

                <input type="text" class="form-control input-lg form-control-lg" id="editarUsuario" name="editarUsuario" placeholder="Editar el usuario" pattern="" required>
                <input type="hidden" id="idPaciente" name="idPaciente"> <!--ID PACIENTE->
                <!-- Mensajes para validación   
                <div class="valid-feedback">¡Campo válido!</div>
                <div class="invalid-feedback">Solo se acepta ##-00000</div>-->
              
              </div>

            </div>

            <!-- ENTRADA PARA LA CONTRASEÑA -->

            <div class="form-group">
            
              
              <div class="input-group">
              
                <span class="input-group-text"><i class="fa fa-lock fa-fw"></i></span> 

                <input type="password" class="form-control input-lg form-control-lg" id="editarPassword" name="editarPassword" placeholder="Editar contraseña" pattern="" required>
                    <!-- Mensajes para validación 
                <div class="valid-feedback">¡Campo válido!</div>
                <div class="invalid-feedback">Solo se acepta letras máximo 20 dígitos.</div>-->
              </div>

            </div>

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
            
              <div class="input-group">
              
                <span class="input-group-text"><i class="fa fa-user fa-fw"></i></span> 

                <input type="text" class="form-control input-lg form-control-lg" id="editarNombre" name="editarNombre" placeholder="Editar los nombres" pattern="" required>

                <!-- Mensajes para validación   
                <div class="valid-feedback">¡Campo válido!</div>
                <div class="invalid-feedback">Solo se acepta ##-00000</div>-->
              
              </div>

            </div>
            <!-- ENTRADA PARA LOS APELLIDOS -->

            <div class="form-group">
                
              
              <div class="input-group">
              
                <span class="input-group-text"><i class="fa fa-user fa-fw"></i></span> 

                <input type="text" class="form-control input-lg form-control-lg" id="editarApellido" name="editarApellido" placeholder="Editar los Apellidos" pattern="" required>
                    <!-- Mensajes para validación 
                <div class="valid-feedback">¡Campo válido!</div>
                <div class="invalid-feedback">Solo se acepta letras máximo 20 dígitos.</div>-->
              
              </div>

            </div>
            <!-- ENTRADA PARA EL DOCUMENTO DNI -->
            <div class="form-group">
                
              <div class="input-group">
              
                <span class="input-group-text"><i class="fa fa-user fa-fw"></i></span> 

                <input type="text" class="form-control input-lg form-control-lg" id="editarDocumento" name="editarDocumento" placeholder="Editar el Dni" pattern="" required>
                <!-- Mensajes para validación 
                <div class="valid-feedback">¡Campo válido!</div>
                <div class="invalid-feedback">Solo se acepta letras máximo 20 dígitos.</div>-->
              
              </div>

            </div>            
            <!-- ENTRADA PARA SELECCIONAR SEXO -->

            <div class="form-group">

                    <div class="input-group">
                    
                        <span class="input-group-text"><i class="fa fa-th fa-fw"></i></span> 

                            <select class="form-control input-lg form-control-lg" name="editarGenero" required>
                        
                                <option id="editarGenero">Selecionar Género</option>    
                                <option value="Masculino">Masculino</option>
                                <option value="Femenino">Femenino</option>

                            </select>

                            <!--<div class="valid-feedback">¡Campo válido!</div>
                            <div class="invalid-feedback">Debes seleccionar una categoría.</div>--->
                    </div>
            </div>

            <!-- ENTRADA PARA SUBIR FOTO 

            <div class="form-group">
              
              <div class="panel">SUBIR IMAGEN</div>

              <input type="file" class="nuevaImagen" name="nuevaImagen">


              <img src="vistas/img/usuario.png" class="img-thumbnail previsualizar" width="100px">

              
            </div>-->

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-success pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Editar Paciente</button>

        </div>

      </form>

      <?php

        $editarPaciente = new PacientesC();
        $editarPaciente -> EditarPacienteC();

      ?>  

    </div>

  </div>

</div>

<?php

  $eliminarPaciente = new PacientesC();
  $eliminarPaciente -> EliminarPacienteC();

?>  