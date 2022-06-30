<?php
include_once "BaseDatos.php";

class Pasajero{
    private $rdocumento;
    private $pnombre;
    private $papellido;
    private $ptelefono;
    private $idviaje;//esto tiene que ser un ubj viaje
    
    private $mensajeoperacion;
    /**
     * constructor persona
     */
    public function __construct()
    {
        $this->rdocumento= '';
        $this->pnombre= '';
        $this->papellido= '';
        $this->ptelefono='';
        $this->idviaje= new Viaje();
    }

    public function cargar($rdocumento, $pnombre, $papellido, $ptelefono, $idviaje){
        $this->setRdocumento($rdocumento);
        $this->setPnombre($pnombre);
        $this->setPapellido($papellido);
        $this->setPtelefono($ptelefono);
        $this->setIdviaje($idviaje);
    }

    public function getRdocumento(){
        return $this->rdocumento;
    }

    public function setRdocumento($rdocumento){
        $this->rdocumento = $rdocumento;
    }

    public function getPnombre(){
        return $this->pnombre;
    }

    public function setPnombre($pnombre){
        $this->pnombre = $pnombre;
    }

    public function getPapellido(){
        return $this->papellido;
    }

    public function setPapellido($papellido){
        $this->papellido = $papellido;
    }

    public function getPtelefono(){
        return $this->ptelefono;
    }

    public function setPtelefono($ptelefono){
        $this->ptelefono = $ptelefono;
    }

    public function getIdviaje(){
        return $this->idviaje;
    }

    public function setIdviaje($idviaje){
        $this->idviaje = $idviaje;
    }

    public function getMensajeoperacion(){
        return $this->mensajeoperacion;
    }

    public function setMensajeoperacion($mensajeoperacion){
        $this->mensajeoperacion = $mensajeoperacion;
    }


    public function buscar($rdocumento){
        $base= new BaseDatos();
        $viaje1= new Viaje();
        $consultaPersona= "select * from pasajero where rdocumento= {$rdocumento}";
        $resp= false;
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consultaPersona)) {
                if ($row2=$base->Registro()) {
                    $this->setRdocumento($rdocumento);
                    $this->setPnombre($row2['pnombre']);
                    $this->setPapellido($row2['papellido']);
                    $this->setPtelefono($row2['ptelefono']);
                    
                    /* busco el viaje con id igual */
                    $idviajeaux= $row2['idviaje'];

                    $viaje1->buscar($idviajeaux);

                    $this->setIdviaje($idviajeaux);

                    $resp= true;
            }

        } else {
            $this->setMensajeoperacion($base->getError());
        }
    } else {
        $this->setMensajeoperacion($base->getError());
    }
    return $resp;
	} 

    public static function listar($condicion=""){
        $arregloPersona= null;

        $viajeaux= new Viaje();

        $base= new BaseDatos();
        $consultaPersonas= 'select * from pasajero';
        if ($condicion!="") {
            $consultaPersonas= $consultaPersonas. ' where '. $condicion;
        }
        $consultaPersonas.= ' order by papellido';
        //echo $consultaPersonas;
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consultaPersonas)) {
                $arregloPersona= array();
                while($row2= $base->Registro()){

                    $rdocumento= $row2['rdocumento'];
                    $pnombre= $row2['pnombre'];
                    $papellido= $row2['papellido'];
                    $ptelefono= $row2['ptelefono'];
                    $idviajeaux= $row2['idviaje'];


                    

                    if ($viajeaux->buscar($idviajeaux)) {
                        //lo hizo correctamente
                    } else {
                        $viajeaux= null;
                    }

                    $perso= new pasajero();
                    $perso->cargar($rdocumento, $pnombre, $papellido, $ptelefono, $viajeaux);

                    array_push($arregloPersona, $perso);
                }
            } else {
                $this->setMensajeoperacion($base->getError());
            }
        } else {
            $this->setMensajeoperacion($base->getError());
        }
        return $arregloPersona;
    }





    public function insertar(){
        $base= new BaseDatos();
        $resp= false;
        $consultaInsertar="INSERT INTO pasajero(rdocumento, pnombre, papellido, ptelefono, idviaje)
        VALUES( {$this->getRdocumento()} ,  '{$this->getPnombre()}' ,  '{$this->getPapellido()}'  ,  {$this->getPtelefono()}  , {$this->getIdviaje()->getIdviaje()}  )";


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
/*$rdocumento;
$pnombre;
$papellido;
$ptelefono;
$idviaje;  */




    public function modificar(){
        $resp= false;
        $objviajeaux= $this->getIdviaje(); 
        $idviajeaux= $objviajeaux->getIdviaje();
        $base= new BaseDatos();
        $consultaModifica= "UPDATE pasajero SET pnombre= '{$this->getPnombre()}'  ,papellido= '{$this->getPapellido()}' ,ptelefono= {$this->getPtelefono()} ,idviaje= {$idviajeaux} 
        WHERE rdocumento= {$this->getRdocumento()}";

        if ($base->Iniciar()) {
            if ($base->Ejecutar($consultaModifica)) {
                $resp= true;
            } else {
                $this->setMensajeoperacion($base->getError());

            }
        } else {
            $this->setMensajeoperacion($base->getError());
        }
        return $resp;
    }


    public function eliminar(){
        $base=  new BaseDatos();
        $resp= false;

        if ($base->Iniciar()) {
            $consultaBorra= "DELETE FROM pasajero WHERE rdocumento= {$this->getRdocumento()}";
            if($base->Ejecutar($consultaBorra)){
                $resp= true;
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
        return "\nDocumento: ". $this->getRdocumento() .
         "\nNombre: " . $this->getPnombre(). 
        "\nApellido: ". $this->getPapellido() .
         "\nTelefono: ". $this->getPtelefono() . 
         "\nIdviaje: ". $this->getIdviaje()->getIdviaje() ."\n" ;
    }

    
}
