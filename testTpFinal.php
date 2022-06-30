<?php

include "Viaje.php";
include "Empresa.php";
include "Responsable.php";


include "Pasajero.php";

$empresaaux= new Empresa();

//AGREGAMOS EMPRESAS


 $empresa1= new Empresa();
$empresa2= new Empresa();

$empresa1->cargar("", 'koko', 'San Martin 1200');
$empresa2->cargar('', 'flecha bus', 'Gral Sarmiento 580');

$empresa1->insertar();
$empresa2->insertar(); 

 /*

//veo si se sumaron
$arrayEmpresas= $empresa1->listar("idempresa > 1");

foreach($arrayEmpresas as $empresaaux){
    echo $empresaaux;
    echo "-------------------------------";
}  

//CAMBIO LA DIRECCION DE LA SEGUNDA EMPRESA POR CORDOBA 200
$empresa3= new Empresa();

$empresa3->cargar("2", 'flecha bus' , 'cordoba 200');

$empresa3->modificar();

//uso buscar para ver si se modifico los datos
$empresaaux=  new Empresa;
$empresaaux->buscar(2);

echo $empresaaux;
echo "ejemplo";


// funciono

//voy a eliminar la primer empresa id: 1

$empresaaux->cargar(1 , "", "");
$empresaaux->eliminar();

$arrayEmpresas= $empresaaux->listar();

foreach ($arrayEmpresas as $key ) {
    echo $key;
    echo "--------------------------";
}

//funciono




//AHORA SIGO CON RESPONSABLE
$responsable1= new Responsable();
$responsable1->cargar("", 1111, "carlos", "villagaran");

$responsable1->insertar();


$responsable2= new Responsable();
$responsable2->cargar("",2222, "juan", "carlos");

$responsable2->insertar();

//veo si sse agregaron

$arrayResponsable= $responsable2->listar();

foreach ($arrayResponsable as $key) {
    echo $key;
    echo "------------------------------";
}
//funciono


//voy a modificar el nombre del responsable nro de empleado 2

$auxResponsable= new Responsable;

$auxResponsable->cargar(2, 1111, "mario", "villagran");

$auxResponsable->modificar();

//veo si se modifico
$arrayResponsable= $responsable2->listar();

foreach ($arrayResponsable as $key) {
    echo $key;
    echo "------------------------------";
}



//#########################
//### SIGO CON VIAJE ######
//#########################

$viaje1= new Viaje;
$viaje1->cargar("", "brazil", 4, 2, 1, 10000 , "cama", "si" );
$viaje1->insertar();

$viaje2= new Viaje;
$viaje2->cargar("", "europa", 3, 2, 2, 50000, "semicama", "no" );
$viaje2->insertar();

$viaje2= new Viaje;
$arrayviaje= $viaje2->listar();

foreach ($arrayviaje as $key) {
    echo $key;
    echo "-----------------------------";
}

//elimino el viaje id 2

$viaje2->cargar(2, "europa", 3, 2, 2, 50000, "semicama", "no");
$viaje2->eliminar();


//modifico el viaje id 1 para cambiar el destino a hawaii



$viaje1->cargar( 1 , "hawaii" , 4, 2, 1, 10000 , "cama", "si" );
$viaje1->modificar();

$arrayviaje= $viaje1->listar();
foreach ($arrayviaje as $key) {
    echo $key;
    echo "-----------------------------";
}


// ####################################
// ###### pasajeros ###################
// ####################################

$pasajero1= new Pasajero;
$pasajero1->cargar(42165680, "mario", "bross", 15426847, 1);
$pasajero1->insertar();

$pasajero2= new Pasajero;
$pasajero2->cargar(42165682, "carlos", "monzon", 155468291, 1);
$pasajero2->insertar();

$pasajero3= new Pasajero;
$pasajero3->cargar(32659481, "julian", "weich", 154846231, 1);
$pasajero3->insertar();

$pasajero4= new Pasajero;
$pasajero4->cargar(12458795, "marco","aurelio",154203084, 1);
$pasajero4->insertar();

$pasajero5= new Pasajero;
$pasajero5->cargar(23458621, "carlo", "magno", 154284561, 1);
$pasajero5->insertar();

//hago una validacion para sumar los pasajeros elimina los pasajeros si no entran en el viaje


$arrayPasajeros= $pasajero1->listar();

foreach ($arrayPasajeros as $key) {
    echo (count($arrayPasajeros));
    echo $key;
    echo "------------------------------";
}






$cantidadMaxima= $viaje1->getVcantmaxpasajeros();


$arrayPasajerosaux= $pasajero1->listar();
$cantidadaux= count($arrayPasajerosaux);

$arrayPasajeros= $viaje1->getArrayPasajeros();

$pasajeroaux=new Pasajero;


$i=$cantidadMaxima;



while ($i < $cantidadaux) {
    $aborrar= $arrayPasajerosaux[$i-1];
    echo $aborrar;
    $aborrar->eliminar();

    $cantidadaux= $cantidadaux-1;
}
//ahora agrego los pasajeros al array del viaje

$arrayPasajeros= $pasajero1->listar();

$viaje1->setArrayPasajeros($arrayPasajeros);

//veo que se haya borrado

$arrayPasajeros= $viaje1->getArrayPasajeros();
echo "ultimo listado ---------------------------------------";
foreach ($arrayPasajeros as $key) {
    echo $key;
    echo "------------------------------";
}



*/



