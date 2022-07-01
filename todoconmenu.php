<?php
include "Viaje.php";
include "Empresa.php";
include "Responsable.php";


include "Pasajero.php";

function separacion(){
    echo "###################################\n";
}


function menu(){
    separacion();
    echo "    viaje feliz    \n";
    separacion();
    echo "1. responsable\n";
    echo "2. empresa\n";
    echo "3. viaje\n";
    echo "4. pasajero\n";
    echo "opcion: ";
    $resp= trim(fgets(STDIN));
    return $resp;
}

function submenu(){
    separacion();
    echo "1. modificar\n";
    echo "2. buscar\n";
    echo "3. agregar\n";
    echo "4. listar\n";
    echo "5. eliminar\n";
    echo "opcion: ";
    $respsubmenu= trim(fgets(STDIN));
    return $respsubmenu;
};



$menu= menu();

switch ($menu) {
    case 1://esto es para responsable
        $submenu= submenu();
        
        switch ($submenu) {//ESTE ES EL SUBMENU DE RESPONSABLE
            case 1://MODIFICAR
                echo separacion();
                echo "que empleado quiere modificar?\n";
                echo "numero empleado= ";
                $numempleado= trim(fgets(STDIN));
                $numempleado= intval($numempleado);

                

                //empiezo el proceso creativo
                $responsablePrueba= new Responsable();

                
                
                
                if ($responsablePrueba->buscar($numempleado)) {
                   $numeroempleadoaux= $responsablePrueba->getRnumeroempleado(); 

                    separacion();
                    echo $responsablePrueba;
                    separacion();
                    echo "DATOS NUEVOS A EDITAR\n";
                    echo "numero de licencia: ";
                    $numerodelicencia= intval(trim(fgets(STDIN))) ;
                    echo "nombre: ";
                    $nombre= trim(fgets(STDIN));
                    echo "apellido: ";
                    $apellido= trim(fgets(STDIN));

                    $responsablePrueba->cargar($numeroempleadoaux, $numerodelicencia, $nombre, $apellido);
                    if ($responsablePrueba->modificar()) {
                        echo "\nDATOS MODIFICADOS!\n";
                    } else {
                        echo "error: no se pudo modificar datos?\n";
                    }
                } else {
                    echo "ERROR responsable no encontrado";
                }

               
                break;
            
            case 2:// es es buscar responsable
                separacion();
                echo "que empleado estas buscando?('por numero de empleado'):";
                $numeroempleadoaux= intval(trim(fgets(STDIN)));
                
                $objresponsable= new Responsable;

                if ($objresponsable->Buscar($numeroempleadoaux)) {//validacion
                    echo $objresponsable;
                    separacion();
                } else {
                    echo "error: responsable no encontrado\n";
                    separacion();
                }
                break;

                case 3://AGREGAR

                    separacion();
                    echo "Ingresar datos de su nuevo empleado responsable:\n";
                    

                    echo "numerolicencia: ";
                    $numLicencia= intval(trim(fgets(STDIN)));
                    echo "nombre: ";
                    $nombre= trim(fgets(STDIN));
                    echo "apellido: ";
                    $apellido= trim(fgets(STDIN));
                    
                    $objresponsable= new Responsable;
                    $objresponsable->cargar("", $numLicencia, $nombre, $apellido);
                    var_dump($nombre);
                    
                    if ((is_numeric($numLicencia)) && (!is_numeric($nombre)) && (!is_numeric($apellido))) {
                        

                        if ($objresponsable->insertar()) {
                            echo "\ndatos cargados exitosamente\n";
    
    
                            separacion();
                            echo "lista de responsables actualizada\n";
                            separacion();
                            $arrayresponsable= $objresponsable->listar();
    
                            foreach ($arrayresponsable as $key) {
                            echo $key;
                            echo "\n-------------------------\n";
    
                        }
    
                        } else {
                            echo "\n error: no se puedo agregar responsable\n";
                        }

                    } else {
                        echo "\nerror: ingrese datos correctamente\n";
                    }


                    



                    separacion();
                    echo "lista de responsables actualizada\n";
                    separacion();
                    $arrayresponsable= $objresponsable->listar();

                    foreach ($arrayresponsable as $key) {
                        echo $key;
                        echo "\n-------------------------\n";

                    }
              
                    break;

                    case 4://LISTAR
                        separacion();
                        $responsablePrueba= new Responsable;


                        echo "quiere que su listar tenga alguna condicion? si/no:";

                        $resp= strtoupper(trim(fgets(STDIN)));
                        separacion();
                        if ($resp == "SI") {//EN CASO DE QUERER PONER UNA CONDICION
                            echo "Escriba su condicion SQL para listar: ";
                            $condicionSQL= trim(fgets(STDIN));
                            separacion();
    
                            if (!is_numeric($condicionSQL)) {
                                
                                $arrayresponsable= $responsablePrueba->listar($condicionSQL);

                                foreach ($arrayresponsable as $key) {
                                    
                                    echo $key;
                                    separacion();
                                }

                            } else {
                                echo "ERROR: Ingrese los datos correctamente: \n";
                            } 
                        } elseif ($resp == "NO") {
                            
                            $arrayresponsable= $responsablePrueba->listar();

                            foreach ($arrayresponsable as $key) {    
                                echo $key;
                                separacion();
                            }

                        } else {
                            echo "error: ingrese si o no";
                        }

                        break;
                    
                    
                    case 5://ELIMINAR RESPONSABLE
                        $responsablePrueba= new Responsable();
                        separacion();
                        echo "que responsable quiere eliminar?\n";
                        echo "ingrese su numero de empleado: ";
                        $numResponsableEliminar= trim(fgets(STDIN));
                        separacion();


                        if (is_numeric($numResponsableEliminar)) {
                            $numResponsableEliminar= intval($numResponsableEliminar);
                            if ($responsablePrueba->Buscar($numResponsableEliminar)) {
                                echo $responsablePrueba;
                                separacion();
                                echo "QUIERE ELIMINAR ESTE RESPONSABLE? SI/NO:";//VALIDACION POR SI NO QUIERE BORRAR

                                $resp= strtoupper(trim(fgets(STDIN)));
                                if ($resp == "SI") {
                                    if ($responsablePrueba->eliminar()) {//validacion en caso de que no funcione eliminar
                                        echo "eliminado correctamente :D";
                                    } else {
                                        echo "ERROR: no se elimino D:";
                                    }
                                } elseif ($resp == "NO") {
                                    echo "entonces no se elimina :C";
                                } else {
                                    echo "error: elija si o no;";
                                }

                            } else {
                                echo "pasajero no encontrado";
                            }
                        } else {
                            echo "ERROR: ingrese bien el numero\n";
                        }
                        
                        
                        break;
        }

        break;// ACA TERMINA LO DE RESPONSABLE

        
    
    case 2://esto es para empresa
        $submenu= submenu();
        switch ($submenu) {
            case 1:// modificar
                separacion();
                echo "que empresa quiere modificar?: \n";
                echo "idempresa:";
                $idempresaAUX= trim(fgets(STDIN));
                $empresaAUX= new Empresa;

                if (is_numeric($idempresaAUX)) {
                    $idempresaAUX=intval($idempresaAUX);
                    if ($empresaAUX->buscar($idempresaAUX)) {//validacion si encuentra el pasajero
                        separacion();
                        echo $empresaAUX;
                        separacion();
                        echo "DATOS NUEVOS A MODIFICAR: \n";
                        echo "Nombre nuevo: ";
                        $nombre= trim(fgets(STDIN));
                        echo "Direccion nueva: ";
                        $direccion= trim(fgets(STDIN));
                        $idempresaAUX= $empresaAUX->getIdempresa();
                        
                        
                        if (!is_numeric($nombre) && !is_numeric($direccion)) {
                            $empresaAUX->cargar($idempresaAUX, $nombre, $direccion);
                            
                            if ($empresaAUX->modificar()) {
                                echo "DATOS MODIFICADOS CORRECTAMENTE\n";
                            }
                        } else {
                            echo "ERROR: ingrese datos correctos\n";
                        }
                        


                    } else {
                        echo "ERROR: empresa no encontrada";//en caso de no encontrarlo
                    }
                } else {
                    echo "ERROR: ingrese un numero correcto";
                }
                break;
            



            case 2;// esto es para buscar
                separacion();
                echo "id de la empresa que quiera buscar: ";
                $empresaAUX= new Empresa;
                $idempresaAUX= trim(fgets(STDIN));

                if (is_numeric($idempresaAUX)) {
                    $idempresaAUX= intval($idempresaAUX);

                    if ($empresaAUX->buscar($idempresaAUX)) {
                        echo "DATOS ENCONTRADOS!!!\n";
                        separacion();
                        echo $empresaAUX;
                        separacion();

                    } else {
                        echo "ERROR: no existe esa empresa.";

                    }
                }else {
                    echo "ERROR: ingrese un id correcto";
                }
                
                break;

                case 3://ESTO ES PARA AGREGAR
                    $empresaAUX= new Empresa;
                    separacion();
                    echo "DATOS QUE QUIERE INGRESAR\n";
                    separacion();
                    echo "Nombre: ";
                    $nombre= trim(fgets(STDIN));
                    echo "Direccion: ";
                    $direccion= trim(fgets(STDIN));

                    if (!is_numeric($nombre) && !is_numeric($direccion)) {
                        separacion();
                        $empresaAUX->cargar("", $nombre, $direccion);
                        if ($empresaAUX->modificar()) {
                            echo "NUEVA EMPRESA AGREGADA CON EXITO!!!\n";
                        } else {
                            echo "ERROR: no se pudo agregar la nueva empresa\n";
                        }

                    } else {
                        echo "ERROR: ingrese datos correctos\n";
                    }
                    break; // ACA TERMINA



                    case 4: //listar
                        $empresaAUX= new Empresa();
                        separacion();
                        echo "quiere listar con alguna condicion?(si/no): ";
                        $resp= strtoupper(trim(fgets(STDIN)));
                        separacion();
                        if ($resp == "SI") {//validacion para si
                            echo "escriba su condicion SQL: ";
                            $condicionSQL= trim(fgets(STDIN));
                            separacion();
                            //preparo el array y el foreach
                            $arrayempresa= $empresaAUX->listar($condicionSQL);

                            foreach ($arrayempresa as $key) {
                                echo $key;
                                separacion();
                            }
                        } elseif ($resp == "NO") {
                            $arrayempresa= $empresaAUX->listar();

                            foreach ($arrayempresa as $key) {
                                echo $key;
                                separacion();
                            }
                        } else {
                            echo "ERROR: ingrese si o no";
                        }
                        break;


                        case 5: //eliminar
                            $empresaAUX=  new Empresa();
                            separacion();
                            echo "Ingrese la empresa que quiere borrar\n";
                            echo "ingrese idempresa: ";
                            $idempresaAUX= trim(fgets(STDIN));
                            if (is_numeric($idempresaAUX)) {
                                $idempresaAUX= intval($idempresaAUX);


                                if ($empresaAUX->buscar($idempresaAUX)) {
                                    separacion();
                                    echo $empresaAUX;
                                    echo "quiere eliminar esta empresa?si/no:";
                                    $resp= strtoupper(trim(fgets(STDIN)));
                                    if ($resp == "SI") {
                                        if ($empresaAUX->eliminar()) {
                                            echo "se elimino correctamente\n";
                                        }else {
                                            echo "ERROR al eliminar\n";
                                        }
                                    }
                                } else {
                                    echo "ERROR: empresa no encontrada";
                                }
                                
                                
                                
                            } else {
                                echo "ERROR: ingrese un valor valido 'numero'";
                            }
                            break;

        }
        break;

    case 3://ESTO ES PARA viaje
        $submenu= submenu();
        switch ($submenu) {
            case 1://modificar
                $viajeAUX= new viaje;
                separacion();
                echo "cual es el viaje que quiere modificar?\n";
                echo "ingrese el idviaje: ";
                $idviajeAUX= trim(fgets(STDIN));

                if (is_numeric($idviajeAUX)) {
                    $idviajeAUX= intval($idviajeAUX);
                    if ($viajeAUX->buscar($idviajeAUX)) {
                        $cantmaxima= $viajeAUX->getVcantmaxpasajeros();
                        $cantmaxima= intval($cantmaxima);
                        separacion();
                        echo $viajeAUX;
                        separacion();
                        echo "ingrese los datos nuevos a modificar: \n";
                        echo "destino: ";
                        $destino= trim(fgets(STDIN));
                        
                        do {//validacion para cantidad maxima
                            echo "cantidad maxima de pasajeros(no puede ser menos a la actual): ";
                            $cantmaxPasajeros= trim(fgets(STDIN));
                        } while ($cantmaxPasajeros < $cantmaxima || !is_numeric($cantmaxPasajeros));
                        echo "idempresa: ";
                        $idempresa= intval(trim(fgets(STDIN)));
                        echo "N° empleado: ";
                        $nnumeroempleado= intval(trim(fgets(STDIN)));
                        echo "importe: ";
                        $importe= trim(fgets(STDIN));
                        echo "Tipo Asiento: primera clase cama/ turista semicama:";
                        $tipoasiento= trim(fgets(STDIN));
                        do {//validacion para si o no
                            echo "Ida y vuelta: si/no: ";
                            $idayvuelta= strtoupper(trim(fgets(STDIN)));
                        } while (!($idayvuelta == "SI") && !($idayvuelta == "NO"));

                        if (!is_numeric($destino) && is_numeric($cantmaxPasajeros) && is_numeric($idempresa) && is_numeric($nnumeroempleado) && is_numeric($importe) && !is_numeric($tipoasiento)) {
                            $responsablePrueba= new Responsable();
                            $empresaPrueba= new Empresa();

                            $idviajeAUXx= $viajeAUX->getIdviaje();


                            if ($responsablePrueba->Buscar($nnumeroempleado) && $empresaPrueba->buscar($idempresa)) {
                                
                                $viajeAUX->cargar($idviajeAUX, $destino, $cantmaxPasajeros, $empresaPrueba, $responsablePrueba, $importe, $tipoasiento, $idayvuelta);

                                if ($viajeAUX->modificar()) {
                                    echo "modificado correctamente";
                                }else {
                                    echo "ERROR: no se pudo modificar";
                                }
                            } else {
                                echo "ERROR: no existe responsable o empresa que se quiere referenciar";
                            }
                        } else {
                            echo "ERROR: ingrese bien sus datos";
                        }
                        
                    
                    } else {
                        echo "ERROR: viaje no encontrado";
                    }
                }else {
                    echo "ERROR: un numero de idviaje";
                }
                break;
            
            case 2://ESTE ES PARA BUSCAR VIAJE
                $viajeAUX= new Viaje();
                separacion();
                echo "Ingrese el id del viaje que quiere buscar: ";
                $idviajeAUX= trim(fgets(STDIN));
                if (is_numeric($idviajeAUX)) {
                    $idviajeAUX= intval($idviajeAUX);

                    if ($viajeAUX->buscar($idviajeAUX)) {
                        echo $viajeAUX;
                    }else {
                        echo "ERROR no se encontro viaje";
                    }

                } else {
                    echo "ERROR: ingrese un numero";
                }
                break;

                case 3://AGREGAR
                    $viajeAUX= new Viaje;
                    $empresaAUX= new Empresa();
                    $responsablePrueba= new Responsable();

                    separacion();
                    echo "ingrese los datos que quiere ingresar\n no se puede agregar 2 viajes con el mismo destino\n";
                    separacion();
                    
                    //pido los datos
                    echo "destino: ";
                    
                    
                    do {
                        $destino= trim(fgets(STDIN));
                        $arrayviajes= $viajeAUX->listar("vdestino='{$destino}'");
                        $count= count($arrayviajes);
                        if ($count <> 0) {
                            echo "ERROR: ya existe un viaje con este destino: \ningrese un destino diferente: ";
                        }
                    } while ($count <> 0);
                

                    
                    do {//validacion para cantidad maxima
                        echo "cantidad maxima de pasajeros: ";
                        $cantmaxPasajeros= trim(fgets(STDIN));
                        if (!is_numeric($cantmaxPasajeros)) {
                            echo "ERROR: ingrese un numero";
                        }
                    } while (!is_numeric($cantmaxPasajeros));


                    echo "idempresa: ";
                    $idempresa= intval(trim(fgets(STDIN)));
                    while (!$empresaAUX->buscar($idempresa)) {
                        echo "ERROR: empresa no encontrada.";
                        echo "por favor ingrese otra: ";
                        $idempresa= trim(fgets(STDIN));

                    }
                    $idempresa= $empresaAUX;

                    echo "N° empleado: ";
                    $nnumeroempleado= intval(trim(fgets(STDIN)));

                    while (!$responsablePrueba->Buscar($nnumeroempleado)) {
                        echo "ERROR: este respónsable no existe.";
                        
                        echo "ingrese otro numero de empleado: ";

                        $nnumeroempleado= trim(fgets(STDIN));
                    }

                    echo "importe: ";
                    $importe= trim(fgets(STDIN));

                    echo "Tipo Asiento: primera clase cama/ turista semicama:";
                    $tipoasiento= trim(fgets(STDIN));
                    do {//validacion para si o no
                        echo "Ida y vuelta: si/no: ";
                        $idayvuelta= strtoupper(trim(fgets(STDIN)));
                    } while (!($idayvuelta == "SI") && !($idayvuelta == "NO"));

                    $viajeAUX->cargar("", $destino, $cantmaxPasajeros,$idempresa, $responsablePrueba, $importe, $tipoasiento, $idayvuelta);

                    if ($viajeAUX->insertar()) {
                        echo "el viaje se cargo exitosamente.";
                    } else {
                        echo "ERROR: el viaje no se pudo agregar.";
                    }




                    break;
        }
        break;
}

/*




switch ($resp) {
    case 1: //menu de responsable
        


        break
    
    default:
        # code...
        break;
}

*/
