<?php
    if($_SESSION ["rol"] != "Secretaria"){ // si la variable de sessión es diferente Secretaria 

        echo '<script>

        window.location = "inicio";
        
        </script>';
        
        return;

    }

?>

<div class="content-wrapper"> <!--clases de ADMI LTE-->

    <section class="content-header"> <!--clases de ADMI LTE-->

        <h1>Gestor de Perfil</h1>  <!--clases de ADMI LTE-->

        <ol class="breadcrumb">
    
            <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
        
        </ol>

    </section>

    <section class="content"><!--clases de ADMI LTE para el contenido-->

        <div class="box">  <!--clases de ADMI LTE Caja-->

            <div class="box-body">

                <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
                
                    <thead>
                        <tr>
                            
                            <td style="width:10px">#</td>
                            <td>Usuario</td>
                            <th>Contraseña</th> <!--le agrege -->
                            <td>Nombre</td>
                            <td>Apellido</td>
                            <td>Foto</td>
                            <td>Editar</td>

                        </tr> 
                    </thead>

                    <tbody>
                    
                    <?php
                    
                    $key= null;

                    $secretaria = SecretariasC::MostrarSecretariasC();
                    

                        echo'<tr>

                                <td>'.($key+1).'</td>
                                <td>'.$secretaria["usuario"].'</td>
                                <td>'.$secretaria["clave"].'</td>
                                <td>'.$secretaria["nombre"].'</td>
                                <td>'.$secretaria["apellido"].'</td>';
                                
                            if($secretaria["foto"] != ""){

                                echo '<td><img src="'.$secretaria["foto"].'" class="img-thumbnail" width="40px"></td>';
                  
                            }else{
                  
                                echo '<td><img src="Vistas/img/secretaria.png" class="img-thumbnail" width="40px"></td>';
                  
                            }                                

                            echo ' <td>

                                    <div class="btn-group">
                        
                                    <button class="btn btn-warning btnEditarSecretariaRol" idSecretaria="'.$secretaria["id"].'" data-toggle="modal" data-target="#modalEditarSecretaria"><i class="fa fa-pencil"></i></button>
                                    
                                    </div>  

                                </td>
                            
                            </tr>';
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
MODAL EDITAR SECRETARIA
======================================-->

<div id="modalEditarSecretaria" class="modal fade" role="dialog">

<div class="modal-dialog">

  <div class="modal-content">

    <form  class="needs-validation" role="form" method="post" enctype="multipart/form-data" novalidate>

      <!--=====================================
      CABEZA DEL MODAL
      ======================================-->

      <div class="modal-header" style="background:#3c8dbc; color:white">

        <h4 class="modal-title">Editar Secretaria</h4>

      </div>

      <!--=====================================
      CUERPO DEL MODAL
      ======================================-->

      <div class="modal-body">

        <div class="box-body">
          <!-- ENTRADA PARA EL USUARIO -->
          
          <div class="form-group">
            
            <div class="input-group">
            <!---text cuando es bootstrap 5--->
                <span class="input-group-text"><i class="fa fa-user fa fa-fw"></i></span>
                <input type="text" class="form-control input-lg form-control-lg" id="editarUsuario" name="editarUsuario" value="Editar usuario" require><!-- Sivalida solo se aceptara letrasmayusominus-->
                <input type="hidden" id="idSecretaria" name="idSecretaria">
                <!-- Mensajes para validación  
                <div class="valid-feedback">¡Campo válido!</div>
                <div class="invalid-feedback">El nombre puede tener mayúsculas, minúsculas, tildes.</div>
               -->
              
            </div>

          </div>          
          
           <!-- ENTRADA PARA LA CONTRASEÑA -->

          <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-text"><i class="fa fa-lock"></i></span> 

                <input type="password" class="form-control input-lg" id="editarPassword" name="editarPassword" placeholder="Escriba la nueva contraseña"required>

                <input type="hidden" id="passwordActual" name="passwordActual">

              </div>

          </div>

          <!-- ENTRADA PARA EL NOMBRE -->
          
          <div class="form-group">
            
            <div class="input-group">

                <span class="input-group-text"><i class="fa fa-user fa fa-fw"></i></span>
                <input type="text" class="form-control input-lg form-control-lg" id="editarNombre" name="editarNombre" value=" " required><!-- Sivalida solo se aceptara letrasmayusominus-->
                <!-- Mensajes para validación   
                <div class="valid-feedback">¡Campo válido!</div>
                <div class="invalid-feedback">El nombre puede tener mayúsculas, minúsculas, tildes.</div>
                -->
              
            </div>

          </div>

        <!-- ENTRADA PARA EL apellido -->
          
        <div class="form-group">
            
            <div class="input-group">

                <span class="input-group-text"><i class="fa fa-user fa fa-fw"></i></span>
                <input type="text" class="form-control input-lg form-control-lg" id="editarApellido" name="editarApellido" value=" "  required><!-- Sivalida solo se aceptara letrasmayusominus-->
                <!---
                <div class="valid-feedback">¡Campo válido!</div>
                <div class="invalid-feedback">El nombre puede tener mayúsculas, minúsculas, tildes.</div>
                - Mensajes para validación   -->
              
            </div>

        </div>

          <!-- ENTRADA PARA SUBIR FOTO -->

          <div class="form-group">
            
            <div class="panel">SUBIR FOTO</div>

            <input type="file" class="nuevaFoto" name="editarFoto" required>

            <p class="help-block">Peso máximo de la foto 2MB</p>

            <div class="invalid-feedback">Debes seleccionar una imagén.</div>

            <img src="Vistas/img/secretaria.png" class="img-thumbnail previsualizar" width="100px">

            <input type="hidden" name="fotoActual" id="fotoActual">

          </div>

        </div>

      </div>


      <!--=====================================
      PIE DEL MODAL
      ======================================-->

      <div class="modal-footer">

        <button type="button" class="btn btn-success pull-left" data-bs-dismiss="modal">Salir</button>

        <button type="submit" class="btn btn-primary">Guardar cambios</button>

      </div>
      <?php

        $editarSecretaria = new SecretariasC();
        $editarSecretaria -> EditarSecretariaRolC();
      ?> 

    </form>

  </div>

</div>

</div>