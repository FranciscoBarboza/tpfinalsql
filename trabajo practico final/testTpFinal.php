<?php

include "Viaje.php";
include "Empresa.php";
include "Responsable.php";


include "Pasajero.php";

$empresa= new Empresa();

$colEmpresas= $empresa->listar();

foreach ($colEmpresas as $unaEmpresa){
    echo $unaEmpresa;
    echo "---------------------------------";
}
//nueva empresa a sumar

$empresaasumar=  new Empresa();

$empresaasumar->cargar("", "columbia", "santa");

$empresaasumar->setEnombre("hawaii");
$empresaasumar->setEdireccion("santa fe");

$empresaasumar->insertar();

//      $prueba= new BaseDatos;

//$prueba->Ejecutar("INSERT INTO empresa VALUES ( default , 'DRAGON BALL',  'HYRULE')");
/*
rnumeroempleado;
rnumerolicencia;
rnombre;
rapellido;
*/


/* if ($prueba->Iniciar()) {
    $prueba->Ejecutar("INSERT INTO empresa VALUES (default, 'koko', 'santa fe 240')");
} else {
    echo "esto es una mierda";
}
 */

