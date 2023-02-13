<?php

$columna = null;
$valor = null;

//Contar todos los doctores
$doctores = DoctoresC::VerDoctorC($columna, $valor);
$totalDoctores = count($doctores);

//Contar todos los pacientes
$pacientes = PacientesC::VerPacienteC($columna, $valor);
$totalPacientes = count($pacientes);

//Contar todos los Consultorios
$consultorios = ConsultoriosC::VerConsultoriosC($columna, $valor);
$totalConsultorios = count($consultorios);

//Contar todas las Secretarias
$secretarias = SecretariasC::DatosSecretariaModal($columna, $valor);
$totalSecretarias = count($secretarias);
//number_format($totalSecretarias)

//Contar todos las Citas
  $citas = CitasC::VerCitasC($columna, $valor);
  $totalCitas = count($citas);



   
  $citasDoctor = CitasC::VerCitasC($columna,$valor);
  //totalCitasDoctor = count($citas);
  
  foreach ($citasDoctor as $key => $value) {

    if($_SESSION["id"] == $value["id_doctor"]){

      //echo count($value["id"]);
      $totalCitasDoctor = count($citasDoctor);

    }
  }

?>
  
  
<?php
if($_SESSION["rol"] =="Secretaria"){
    
  echo'<div class="col-lg-3 col-xs-6">

        <div class="small-box bg-info">
          
          <div class="inner">
            
            <h3>'.number_format($totalCitas).'</h3>

            <p>Citas Agendadas</p>
          
          </div>
          
          <div class="icon">
            
            <i class="ion ion-social"></i>
          
          </div>
          
          <a href="historial-total" class="small-box-footer">
            
            Más info <i class="fa fa-arrow-circle-right"></i>
          
          </a>

        </div>

      </div>';
}if($_SESSION["rol"] =="Administrador"){
echo'<div class="col-lg-3 col-xs-6">

      <div class="small-box bg-info">
        
        <div class="inner">
          
          <h3>'.number_format($totalCitas).'</h3>

          <p>Citas Agendadas</p>
        
        </div>
        
        <div class="icon">
          
          <i class="ion ion-social"></i>
        
        </div>
        
        <a href="historial-total" class="small-box-footer">
          
          Más info <i class="fa fa-arrow-circle-right"></i>
        
        </a>

      </div>

    </div>

    <div class="col-lg-3 col-xs-6">

        <div class="small-box bg-green">
          
          <div class="inner">
          
            <h3>'.number_format($totalSecretarias).'</h3>

            <p>Secretarias</p>
          
          </div>
          
          <div class="icon">
          
            <i class="ion ion-person"></i>
          
          </div>
          
          <a href="secretarias" class="small-box-footer">
            
            Más info <i class="fa fa-arrow-circle-right"></i>
          
          </a>

      </div>

    </div>';
}if(($_SESSION["rol"] =="Secretaria")){

    echo'<div class="col-lg-3 col-xs-6">

          <div class="small-box bg-yellow">
            
            <div class="inner">
            
              <h3>'.number_format($totalConsultorios).'</h3>
        
              <p>Consultorios</p>
          
            </div>
            
            <div class="icon">
            
              <i class="ion ion-person"></i>
            
            </div>
            
            <a href="consultorios" class="small-box-footer">
        
              Más info <i class="fa fa-arrow-circle-right"></i>
        
            </a>
        
          </div>
        
        </div>';

}if (($_SESSION["rol"] =="Administrador" || $_SESSION["rol"] =="Secretaria")){

    echo '<div class="col-lg-3 col-xs-6">

          <div class="small-box bg-red">
          
            <div class="inner">
            
              <h3>'.number_format($totalPacientes).'</h3>

              <p>Pacientes</p>
            
            </div>
            
            <div class="icon">
              
              <i class="ion ion-person"></i>
            
            </div>
            
            <a href="pacientes" class="small-box-footer">
              
              Más info <i class="fa fa-arrow-circle-right"></i>
            
            </a>

          </div>

        </div>
        <div class="col-lg-3 col-xs-6">

          <div class="small-box bg-yellow">
                  
            <div class="inner">
                  
              <h3>'.number_format($totalDoctores).'</h3>
              
              <p>Doctores</p>
                
            </div>
                  
            <div class="icon">
                  
              <i class="ion ion-person"></i>
                  
            </div>
                  
              <a href="doctores" class="small-box-footer">
              
                Más info <i class="fa fa-arrow-circle-right"></i>
              
              </a>
              
            </div>
              
        </div>';


}

if($_SESSION["rol"] =="Doctor"){

  echo'<div class="col-lg-6 col-xs-6">

        <div class="small-box bg-info">
          
          <div class="inner">
            
            <h3>  </h3>

            <p>Agendar Citas</p>
          
          </div>
          
          <div class="icon">
            
            <i class="ion ion-social"></i>
          
          </div>
          
          <a href="Citas" class="small-box-footer">
            
            Más info <i class="fa fa-arrow-circle-right"></i>
          
          </a>

        </div>

      </div>


      <div class="col-lg-6 col-xs-6">

      <div class="small-box bg-info">
        
        <div class="inner">
          
          <h3></h3>

          <p>Ver Citas</p>
        
        </div>
        
        <div class="icon">
          
          <i class="ion ion-social"></i>
        
        </div>
        
        <a href="historialDoctor" class="small-box-footer">
          
          Más info <i class="fa fa-arrow-circle-right"></i>
        
        </a>

      </div>

    </div>';


}
if($_SESSION["rol"] =="Paciente"){

  echo'<div class="col-lg-6 col-xs-6">

        <div class="small-box bg-info">
          
          <div class="inner">
            
            <h3>  </h3>

            <p>Agendar Citas</p>
          
          </div>
          
          <div class="icon">
            
            <i class="ion ion-social"></i>
          
          </div>
          
          <a href="Ver-consultorios" class="small-box-footer">
            
            Más info <i class="fa fa-arrow-circle-right"></i>
          
          </a>

        </div>

      </div>


      <div class="col-lg-6 col-xs-6">

      <div class="small-box bg-info">
        
        <div class="inner">
          
          <h3></h3>

          <p>Ver Citas</p>
        
        </div>
        
        <div class="icon">
          
          <i class="ion ion-social"></i>
        
        </div>
        
        <a href="historial" class="small-box-footer">
          
          Más info <i class="fa fa-arrow-circle-right"></i>
        
        </a>

      </div>

    </div>';


}

