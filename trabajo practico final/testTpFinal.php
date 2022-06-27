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

//$empresaasumar=  new Empresa();

//$empresaasumar->cargar('0', "columbia", "santa");

//$empresaasumar->insertar();

$prueba= new BaseDatos;

$prueba->Ejecutar("INSERT INTO empresa VALUES ( default , 'DRAGON BALL',  'HYRULE')");

