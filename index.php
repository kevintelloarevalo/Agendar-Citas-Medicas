<?php  //abrimos PHP NO CERRAMOS XQ TODO SERA PHP
//CONTROLADORES
//requerimos solo una vez 
require_once "Controladores/plantillaC.php";
require_once "Controladores/SecretariasC.php";
require_once "Controladores/ConsultoriosC.php";
require_once "Controladores/DoctoresC.php";
require_once "Controladores/PacientesC.php";
require_once "Controladores/CitasC.php";
require_once "Controladores/AdministradoresC.php";
require_once "Controladores/OrganizacionC.php";
//MODELOS
require_once "Modelos/ConexionBD.php";
require_once "Modelos/SecretariasM.php";
require_once "Modelos/ConsultoriosM.php";
require_once "Modelos/DoctoresM.php";
require_once "Modelos/PacientesM.php";
require_once "Modelos/CitasM.php";
require_once "Modelos/AdministradoresM.php";
require_once "Modelos/OrganizacionM.php";
$plantilla = new Plantilla();  // creamos objeto  para la clase (la clase estara en el controlador)
$plantilla -> LlamarPLantilla(); //objeto acceda al metodo