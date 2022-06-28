<?php
include_once "BaseDatos.php";

/* 
CREATE DATABASE bdviajes; 

CREATE TABLE empresa(
    idempresa bigint AUTO_INCREMENT,
    enombre varchar(150),
    edireccion varchar(150),
    PRIMARY KEY (idempresa)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE responsable (
    rnumeroempleado bigint AUTO_INCREMENT,
    rnumerolicencia bigint,
	rnombre varchar(150), 
    rapellido  varchar(150), 
    PRIMARY KEY (rnumeroempleado)
    )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;;
	
CREATE TABLE viaje (
    idviaje bigint AUTO_INCREMENT,
	vdestino varchar(150),
    vcantmaxpasajeros int,
    rdocumento varchar(15),
	idempresa bigint,
    rnumeroempleado bigint,
    vimporte float,
    tipoAsiento varchar(150), primera clase o no, semicama o cama
    idayvuelta varchar(150), si no
    PRIMARY KEY (idviaje),
    FOREIGN KEY (idempresa) REFERENCES empresa (idempresa),
	FOREIGN KEY (rnumeroempleado) REFERENCES responsable (rnumeroempleado)
    ON UPDATE CASCADE
    ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT = 1;
	
CREATE TABLE pasajero (
    rdocumento varchar(15),
    pnombre varchar(150), 
    papellido varchar(150), 
	ptelefono int, 
	idviaje bigint,
    PRIMARY KEY (rdocumento),
	FOREIGN KEY (idviaje) REFERENCES viaje (idviaje)	
    )ENGINE=InnoDB DEFAULT CHARSET=utf8; 
 
  

*/

class Responsable{
    private $rnumeroempleado;
    private $rnumerolicencia;
    private $rnombre;
    private $rapellido;
    
    private $mensajeoperacion;

    public function __construct()
    {
        $this->rnumeroempleado='';
        $this->rnumerolicencia='';
        $this->rnombre='';
        $this->rapellido='';
        $this->mensajeoperacion='';
    }

    public function cargar($rnumeroempleado, $rnumerolicencia, $rnombre, $rapellido){
        $this->rnumeroempleado= $rnumeroempleado;
        $this->rnumerolicencia= $rnumerolicencia;
        $this->rnombre= $rnombre;
        $this->rapellido= $rapellido;
    }
    

    public function getRnumeroempleado(){
        return $this->rnumeroempleado;
    }

    public function setRnumeroempleado($rnumeroempleado){
        $this->rnumeroempleado = $rnumeroempleado;
    }

    public function getRnumerolicencia(){
        return $this->rnumerolicencia;
    }

    public function setRnumerolicencia($rnumerolicencia){
        $this->rnumerolicencia = $rnumerolicencia;
    }

    public function getRnombre(){
        return $this->rnombre;
    }

    public function setRnombre($rnombre){
        $this->rnombre = $rnombre;
    }

    public function getRapellido(){
        return $this->rapellido;
    }

    public function setRapellido($rapellido){
        $this->rapellido = $rapellido;
    }

    

    public function getMensajeoperacion(){
        return $this->mensajeoperacion;
    }

    public function setMensajeoperacion($mensajeoperacion){
        $this->mensajeoperacion = $mensajeoperacion;
    }

    public function Buscar($rnumeroempleado){
        $base= new BaseDatos();
        $consultaPersona= "SELECT * FROM Responsable WHERE rnumeroempleado= {$rnumeroempleado}";
        $resp= false;
        if ($base->Iniciar()) {
            if ($base->Iniciar()) {
                if ($row2 = $base->Registro()) {
                    $this->setRnumeroempleado($rnumeroempleado);
                    $this->setRnumerolicencia($row2['rnumerolicencia']);
                    $this->setRnombre('rnombre');
                    $this->setRapellido('rapellido');

                    $resp= true;
                }
            } else {
                $this->setMensajeoperacion($base->getError());
            }
        }
        else {
            $this->setMensajeoperacion($base->getError());
        }
        return $resp;
    }

public function listar($condicion=""){
    $arregloResponsable= null;
    $base= new BaseDatos();
    $consultaResponsables= "SELECT * FROM Responsable";
    if ($condicion!="") {
        $consultaResponsables= $consultaResponsables . " WHERE ". $condicion;
    }
    $consultaResponsables.= " ORDER BY rapellido";
    //echo $consultaResponsables
    if ($base->Iniciar()) {
        if ($base->Ejecutar($consultaResponsables)) {
            $arregloResponsable= array();
            while ($row2= $base->Registro()) {
                $rnumeroempleado= $row2['rnumeroempleado'];
                $rnumerolicencia= $row2['rnumerolicencia'];
                $rnombre= $row2['rnombre'];
                $rapellido= $row2['rapellido'];

                $responsable= new Responsable();
                $responsable-> cargar($rnumeroempleado, $rnumerolicencia, $rnombre, $rapellido);

                array_push($arregloResponsable, $responsable);
            }
        } else {

            $this->setMensajeoperacion($base->getError());
        }
    } else {

        $this->setMensajeoperacion($base->getError());
    }

    return $arregloResponsable;
}


public function insertar(){
    $base= new BaseDatos();
    $resp= false;
    $consultaInsertar= "INSERT INTO Responsable( rnumerolicencia, rnombre, rapellido)
    VALUES ( {$this->getRnumerolicencia()} ,  '{$this->getRnombre()}' ,  '{$this->getRapellido()}' )";

    if ($base->Iniciar()) {
        if ($base->Ejecutar($consultaInsertar)) {
            
            $resp=true;
        } else {
            $this->setMensajeoperacion($base->getError());
        }
    } else {
        $this->setMensajeoperacion($base->getError());
    }
    return $resp;
}

public function modificar(){
    $resp= false;
    $base= new BaseDatos();

    $consultaModifica= "UPDATE Responsable SET rnumerolicencia=  {$this->getRnumerolicencia()}, rnombre= '{$this->getRnombre()}' ,rapellido=  '{$this->getRapellido()}' WHERE rnumeroempleado= {$this->getRnumeroempleado()}";
    
    if ($base->Iniciar()) {
        if ($base->Ejecutar($consultaModifica)) {
            $resp= true;
        } else {
            $this->setMensajeoperacion($base->getError());
        }
    }
    return $resp;
    
}


public function eliminar(){
    $base= new BaseDatos();
    $resp= false;
    if ($base->Iniciar()) {
        $consultaborra= "DELETE FROM Responsable WHERE nrodoc= {$this->getRnumeroempleado()}";
        if ($base->Ejecutar($consultaborra)) {
            $resp=true;    
        } else {
            $this->setMensajeoperacion($base->getError());
        }
    } else {
        $this->setMensajeoperacion($base->getError());
    }
    return $resp;
}

public function __toString()
{
    return "\nNumero de Empleado: ". $this->getRnumeroempleado() . 
    "\nNumero de Licencia: " . $this->getRnumerolicencia().
    "\nNombre: ". $this->getRnombre() . 
    "\nApellido: " . $this->getRapellido() ."\n";
}
  		
/*
$rnumeroempleado;
$rnumerolicencia;
$rnombre;
$rapellido;

public static function listar($condicion=""){
    $arregloPersona= null;
    $base= new BaseDatos();
    $consultaPersonas= 'select * from Persona';
    if ($condicion!="") {
        $consultaPersonas= $consultaPersonas. ' where '. $condicion;
    }
    $consultaPersonas.= 'order by papellido';
    //echo $consultaPersonas;
    if ($base->Iniciar()) {
        if ($base->Ejecutar($consultaPersonas)) {
            $arregloPersona= array();
            while($row2= $base->Registro()){
                $rdocumento= $row2['rdocumento'];
                $pnombre= $row2['pnombre'];
                $papellido= $row2['papellido'];
                $ptelefono= $row2['ptelefono'];
                $idviaje= $row2['idviaje'];
                $perso= new Persona();
                $perso->cargar($rdocumento, $pnombre, $papellido, $ptelefono, $idviaje);
                array_push($rdocumento, $perso);
            }
        } else {
            $this->setMensajeoperacion($base->getError());
        }
    } else {
        $this->setMensajeoperacion($base->getError());
    }
    return $arregloPersona;
}
		
    public function Buscar($dni){
		$base=new BaseDatos();
		$consultaPersona="Select * from persona where nrodoc=".$dni;
		$resp= false;
		if($base->Iniciar()){
			if($base->Ejecutar($consultaPersona)){
				if($row2=$base->Registro()){					
				    $this->setNrodoc($dni);
					$this->setNombre($row2['nombre']);
					$this->setApellido($row2['apellido']);
					$this->setEmail($row2['email']);
					$resp= true;
				}				
			
		 	}	else {
		 			$this->setmensajeoperacion($base->getError());
		 		
			}
		 }	else {
		 		$this->setmensajeoperacion($base->getError());
		 	
		 }		
		 return $resp;
	}	 */
}