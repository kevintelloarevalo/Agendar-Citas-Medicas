
  <header class="main-header">
    <!-- Logo -->
    <a href="#" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>C</b>M</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Citas Médicas</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="inicio" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">

          <!-- Tasks: style can be found in dropdown.less -->

          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="inicio" class="dropdown-toggle" data-toggle="dropdown">
              <?php
                if($_SESSION["foto"] == ""){  //Si la foto viene vacia 

                  echo '<img src="Vistas/img/usuario.png" class="user-image" alt="User Image">';

                }else{  //Si el usuario tiene foto o la sesión tiene foto

                  //se hace asi solo cuando esta en una propiedad html '.SESION[""].' <--- SINTAXIS
                  echo '<img src="'.$_SESSION["foto"].'" class="user-image" alt="User Image">';// CONTANER UNA VARIABLE DE SESSIÓN EN HTML
                }

              ?>
              
              <span class="hidden-xs">
                <?php     //  abrimos PHP
                  echo $_SESSION["nombre"]; //mostramos la variable de sesión nombre de la bdd del usuario 
                    //Cerramos PHP                
                ?>  
              </span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <?php
                  if($_SESSION["foto"] == ""){  //Si la foto viene vacia 

                    echo '<img src="Vistas/img/usuario.png" class="user-image" alt="User Image">';

                  }else{  //Si el usuario tiene foto o la sesión tiene foto

                    //se hace asi solo cuando esta en una propiedad html '.SESION[""].' <--- SINTAXIS
                    echo '<img src="'.$_SESSION["foto"].'" class="user-image" alt="User Image">';// CONTANER UNA VARIABLE DE SESSIÓN EN HTML
                  }

                ?>
                <p>
                  <?php     //  abrimos PHP
                    echo $_SESSION["nombre"]; echo " "; echo $_SESSION["apellido"]; //mostramos la variable de sesión nombre y apellidos 
                      //Cerramos PHP                
                  ?>  
                  <small>
                    <?php     //  abrimos PHP
                      echo $_SESSION["rol"]; //mostramos la variable de sesión rol de la bdd del usuario 
                    //Cerramos PHP                
                     ?>  
                  </small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <?php  //Abrimos PHP

                    echo '<a href="perfil-'.$_SESSION["rol"].'" class="btn btn-default btn-flat">Perfil</a>';  // CONTANER UNA VARIABLE DE SESSIÓN EN HTML

                  //cerramos PHP
                  ?> 
                </div>
                <div class="pull-right">
                  <a href="salir" class="btn btn-default btn-flat">Salir</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>