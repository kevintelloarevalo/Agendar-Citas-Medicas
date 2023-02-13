<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <?php

          if($_SESSION["rol"] =="Administrador"){

            include "cajas-superiores.php";
            $columna=null;
            $valor=null;

            $resultado=OrganizacionC::VerOrganizacionC($columna, $valor);

            foreach ($resultado as $key => $value) {
              echo'<div class="col-md-6 col-xs-6">
                    <div class="small-box bg-info">
                      <div class="inner">
                        <h2><b>'.$value["nombre"].'</b></h2>
                        <h2><b>'.$value["telefono"].'</b></h2>
                        <h2><b>'.$value["direccion"].'</b></h2>
                      </div>
                    </div>
                  </div>';


            }

          }

      if($_SESSION["rol"] =="Secretaria"){

        include "cajas-superiores.php";

      }

      if($_SESSION["rol"] =="Doctor"){

        include "cajas-superiores.php";

      }

      if($_SESSION["rol"] =="Paciente"){

        include "cajas-superiores.php";

      }
      

      ?>
            <!---<div class="col-md-6" col-xs-3">
                <img src="'.$value["logo"].'" width="60px">

              </div>';--->
    </section>
  </div>


  <footer class="main-footer">

    <strong>Copyright &copy; 2023 <a href="" target="_blank">Desarrollador --> Kevin Tello Arévalo</a>
    </strong>

  </footer>