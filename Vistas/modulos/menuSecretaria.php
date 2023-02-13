<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <?php
          if($_SESSION["foto"] == ""){  //Si la foto viene vacia 

            echo '<img src="Vistas/img/usuario.png" class="user-image" alt="User Image">';

          }else{  //Si el usuario tiene foto o la sesión tiene foto

            //se hace asi solo cuando esta en una propiedad html '.SESION[""].' <--- SINTAXIS
            echo '<img src="'.$_SESSION["foto"].'" class="user-image" alt="User Image">';// CONTANER UNA VARIABLE DE SESSIÓN EN HTML
          }
          ?>
        </div>
        <div class="pull-left info">
          <p>
            <?php //abri php
              echo $_SESSION["nombre"]; echo " "; // se hace asi cuando es php puro
            ?>
          </p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <ul class="sidebar-menu">

        <li>  <!----para la lista---->
          <a href="inicio">  <!--ancor para la ruta-->
            <i class="fa fa-home"></i>  <!--para el icono-->
            <span>Inicio</span>  <!--Texto-->
          </a>
        </li>

      </ul>

      <ul class="sidebar-menu">

        <li>  <!----para la lista---->
          <a href="doctores">  <!--ancor para la ruta-->
            <i class="fa fa-user-md"></i>  <!--para el icono-->
            <span>Doctores</span>  <!--Texto-->
          </a>
        </li>

      </ul>

      <ul class="sidebar-menu">

        <li>  <!----para la lista---->
          <a href="consultorios">  <!--ancor para la ruta-->
            <i class="fa fa-medkit"></i>  <!--para el icono-->
            <span>Consultorios</span>  <!--Texto-->
          </a>
        </li>

      </ul>

      <ul class="sidebar-menu">

        <li>  <!----para la lista---->
          <a href="pacientes">  <!--ancor para la ruta-->
            <i class="fa fa-users"></i>  <!--para el icono-->
            <span>Pacientes</span>  <!--Texto-->
          </a>
        </li>

      </ul> 

      <ul class="sidebar-menu">

        <li>  <!----para la lista---->
          <a href="historial-total">  <!--ancor para la ruta-->
            <i class="fa fa-file-text"></i>  <!--para el icono-->
            <span>Historial de Citas</span>  <!--Texto-->
          </a>
        </li>

      </ul> 

  </aside>