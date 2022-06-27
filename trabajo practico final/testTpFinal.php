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

/* $empresaasumar=  new Empresa();

$empresaasumar->setEnombre("hola");
$empresaasumar->setEdireccion("brazil");

$empresaasumar->insertar(); */

/* 
idempresa;
enombre;
edireccion */
$base= new BaseDatos();
$base->Ejecutar("INSERT INTO empresa(enombre, edireccion) VALUES ('brazil' , 'tucuman')");


