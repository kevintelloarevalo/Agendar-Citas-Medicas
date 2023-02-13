<?php
    if($_SESSION ["rol"] != "Doctor"){ // si la variable de sessión es diferente Secretaria 

        echo '<script>

        window.location = "inicio";
        
        </script>';
        
        return;

    }

?>

<div class="content-wrapper">
    
    <section class="content-header">  <!---Contenedor del titulo-->
        <h1>Gestor de perfil</h1>

            <ol class="breadcrumb">

                <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
            
            </ol>
    </section>

    <section class="content">
        <div class="box">

            <div class="box-body">

                <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
                    <thead>  <!---Cabezera de la tabla---->
                        <tr>
                            <td></td>
                            <td>Nombre</td>
                            <td>Apellido</td>
                            <td>Género</td>
                            <td>Foto</td>
                            <td>Consultorio</td>
                            <td>Usuario</td>
                            <td>Clave</td>
                            <td>Horario</td>
                            <td>Editar</td>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                            $key=null;
                            $doctor = DoctoresC::VerPerfilDoctorC();
                            
                            echo'<tr>
                                <td>'.($key+1).'</td>
                                <td>'.$doctor["nombre"].'</td>
                                <td>'.$doctor["apellido"].'</td>
                                <td>'.$doctor["sexo"].'</td>';
                                
                                if($doctor["foto"]!= ""){// osea que la foto es diferente a vacio
                                    echo '<td><img src="'.$doctor["foto"].'" class="img-thumbnail" width="40px"></td>';
                  
                                }else{
                      
                                    echo '<td><img src="Vistas/img/usuario.png" class="img-thumbnail" width="40px"></td>';
                                }

                                $columna="id";
                                $valor = $doctor["id_consultorio"];
                                
                                $consultorio = ConsultoriosC::VerConsultoriosC($columna, $valor);
                                
                                echo'<td>'.$consultorio["nombre"].'</td>
                                <td>'.$doctor["usuario"].'</td>
                                <td>'.$doctor["clave"].'</td>
                                <td>
                                    Desde: '.$doctor["horarioE"].'
                                    <br>
                                    Hasta: '.$doctor["horarioS"].'
                                </td>
                                <td>

                                    <div class="btn-group">
                        
                                    <button class="btn btn-warning btnEditarDoctorModal" idDoctor="'.$doctor["id"].'" data-toggle="modal" data-target="#modalEditarDoctor"><i class="fa fa-pencil"></i></button>
                                    
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

<!--=====================================
MODAL EDITAR DOCTOR DESDE SU PERFIL
======================================-->

<div id="modalEditarDoctor" class="modal fade" role="dialog">

<div class="modal-dialog">

  <div class="modal-content">

    <form  class="needs-validation" role="form" method="post" enctype="multipart/form-data" novalidate>

      <!--=====================================
      CABEZA DEL MODAL
      ======================================-->

      <div class="modal-header" style="background:#3c8dbc; color:white">

        <h4 class="modal-title">Editar Doctor</h4>

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
                <input type="text" class="form-control input-lg form-control-lg" id="editarUsuario" name="editarUsuario" value=" " required><!-- Sivalida solo se aceptara letrasmayusominus-->
                <input type="hidden" id="idDoctor" name="idDoctor">
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
        
        <!-- ENTRADA PARA SELECCIONAR Consultorio -->

        <div class="form-group">

                <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-th fa-fw"></i></span> 

                        <select class="form-control input-lg form-control-lg"  name="editarConsultorio" required>
                            
                            <?php
                            echo '<option value="'.$consultorio["id"].'">'.$consultorio["nombre"].'</option>';

                                

                                $columna = null;
                                $valor = null;

                                $consultorios = ConsultoriosC::VerConsultoriosC($columna, $valor);

                                foreach ($consultorios as $key => $value) {
                                        
                                    echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
                                }

                                ?>

                        </select>

                            <!--<div class="valid-feedback">¡Campo válido!</div>
                            <div class="invalid-feedback">Debes seleccionar una categoría.</div>--->
                </div>
        </div>
     

        <!-- ENTRADA PARA SELECCIONAR SEXO -->

        <div class="form-group">

                <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-th fa-fw"></i></span> 

                        <select class="form-control input-lg form-control-lg" name="editarGenero" required>
                        
                            <option id="editarGenero">Selecionar Género</option>    
                            <option value="Masculino">Masculino</option>
                            <option value="Femenino">Femenino</option>

                        </select>

                            <!--<div class="valid-feedback">¡Campo válido!</div>
                            <div class="invalid-feedback">Debes seleccionar una categoría.</div>--->
                </div>
        </div>
        
        <!-- ENTRADA PARA La hora Entrada -->
          
        <div class="form-group">
            
            <div class="input-group">

                <span class="input-group-text"><i class="fa fa-user fa fa-fw"></i></span>
                <input type="time" class="form-control input-lg form-control-lg" id="editarHoraE" name="editarHoraE" required><!-- Sivalida solo se aceptara letrasmayusominus-->
                <!---
                <div class="valid-feedback">¡Campo válido!</div>
                <div class="invalid-feedback">El nombre puede tener mayúsculas, minúsculas, tildes.</div>
                - Mensajes para validación   -->
              
            </div>

        </div>

        <!-- ENTRADA PARA La hora SALIDA -->
          
        <div class="form-group">
            
            <div class="input-group">

                <span class="input-group-text"><i class="fa fa-user fa fa-fw"></i></span>
                <input type="time" class="form-control input-lg form-control-lg" id="editarHoraS" name="editarHoraS" required><!-- Sivalida solo se aceptara letrasmayusominus-->
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

            <img src="Vistas/img/doctor.png" class="img-thumbnail previsualizar" width="100px">

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

        $editarDoctor = new DoctoresC();
        $editarDoctor -> EditarDoctorRolC();
      ?> 

    </form>

  </div>

</div>

</div>