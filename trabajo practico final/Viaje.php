<?php
include_once "BaseDatos.php";
/* 
CREATE TABLE viaje (
    idviaje bigint AUTO_INCREMENT,
	vdestino varchar(150),
    vcantmaxpasajeros int,
    rdocumento varchar(15),
	idempresa bigint,
    rnumeroempleado bigint,
    vimporte float,
    tipoAsiento varchar(150), /*primera clase o no, semicama o cama
    idayvuelta varchar(150), /*si no
    PRIMARY KEY (idviaje),
    FOREIGN KEY (idempresa) REFERENCES empresa (idempresa),
	FOREIGN KEY (rnumeroempleado) REFERENCES responsable (rnumeroempleado) */

class Viaje{
    private $idviaje;
    private $vdestino;
    private $vcantmaxpasajeros;
    private $idempresa; //referencia a empresa
    private $rnumeroempleado; //referencia a responsable
    private $vimporte;
    private $tipoasiento; //primera clase o no
    private $idayvuelta; // si no

    private $mensajeoperacion;
    private $arrayPasajeros;

    public function __construct()
    {
        $this->idviaje= '';
        $this->vdestino='';
        $this->vcantmaxpasajeros='';
        $this->idempresa='';
        $this->rnumeroempleado='';
        $this->vimporte='';
        $this->tipoasiento='';
        $this->idayvuelta='';

        $this->arrayPasajeros= array();
    }

    public function cargar($idviaje ,$vdestino, $vcantmaxpasajeros, $idempresa, $rnumeroempleado, $vimporte, $tipoasiento, $idayvuelta){
        $this->idviaje= $idviaje;
        $this->vdestino=$vdestino;
        $this->vcantmaxpasajeros= $vcantmaxpasajeros;
        $this->idempresa= $idempresa;
        $this->rnumeroempleado= $rnumeroempleado;
        $this->vimporte= $vimporte;
        $this->tipoasiento=$tipoasiento;
        $this->idayvuelta= $idayvuelta;
    }
    

    public function getIdviaje(){
        return $this->idviaje;
    }

    public function setIdviaje($idviaje){
        $this->idviaje = $idviaje;
    }

    public function getVdestino(){
        return $this->vdestino;
    }

    public function setVdestino($vdestino){
        $this->vdestino = $vdestino;
    }

    public function getVcantmaxpasajeros(){
        return $this->vcantmaxpasajeros;
    }

    public function setVcantmaxpasajeros($vcantmaxpasajeros){
        $this->vcantmaxpasajeros = $vcantmaxpasajeros;
    }

    public function getIdempresa(){
        return $this->idempresa;
    }

    public function setIdempresa($idempresa){
        $this->idempresa = $idempresa;
    }

    public function getRnumeroempleado(){
        return $this->rnumeroempleado;
    }

    public function setRnumeroempleado($rnumeroempleado){
        $this->rnumeroempleado = $rnumeroempleado;
    }

    public function getVimporte(){
        return $this->vimporte;
    }

    public function setVimporte($vimporte){
        $this->vimporte = $vimporte;
    }

    public function getTipoasiento(){
        return $this->tipoasiento;
    }

    public function setTipoasiento($tipoasiento){
        $this->tipoasiento = $tipoasiento;
    }

    public function getIdayvuelta(){
        return $this->idayvuelta;
    }

    public function setIdayvuelta($idayvuelta){
        $this->idayvuelta = $idayvuelta;
    }

    public function getMensajeoperacion(){
        return $this->mensajeoperacion;
    }

    public function setMensajeoperacion($mensajeoperacion){
        $this->mensajeoperacion = $mensajeoperacion;
    }

    public function getArrayPasajeros(){
        return $this->arrayPasajeros;
    }

    public function setArrayPasajeros($arrayPasajeros){
        $this->arrayPasajeros = $arrayPasajeros;
    }
    
/* 
idviaje;
vdestino;
vcantmaxpasajeros;
idempresa; //referenc
rnumeroempleado; //re
vimporte;
tipoasiento; //primer
idayvuelta; // si no
*/   

    public function buscar($idviaje){
        $base= new BaseDatos();
        $consultaviaje= "SELECT * FROM Viaje WHERE idviaje=". $idviaje;
        $resp= false;
        if ($base->Iniciar()) {
            if($base->Ejecutar($consultaviaje)){
                if ($row2= $base->Registro()) {
                    $this->setIdviaje($idviaje);
                    $this->setVdestino($row2['vdestino']);
                    $this->setVcantmaxpasajeros($row2['vcantmaxpasajeros']);
                    $this->setIdempresa($row2['idempresa']);
                    $this->setRnumeroempleado($row2['rnumeroempleado']);
                    $this->setVimporte($row2['vimporte']);
                    $this->setTipoasiento($row2['tipoasiento']);
                    $this->setIdayvuelta($row2['idayvuelta']);
                    $resp=true;
                }
            } else {
                $this->setMensajeoperacion($base->getError());
            }
        }else {
            $this->setMensajeoperacion($base->getError());
        }
        return $resp;
    }

/* 
idviaje;
vdestino;
vcantmaxpasajeros;
idempresa; //referenc
rnumeroempleado; //re
vimporte;
tipoasiento; //primer
idayvuelta; // si no
*/
    public function listar($condicion=""){
        $arregloViaje= null;
        $base= new BaseDatos();
        $consultaviaje= "SELECT * FROM Viaje";
        if ($condicion!="") {
            $consultaviaje= $consultaviaje . ' WHERE '. $condicion;
        }
        $consultaviaje.= " ORDER BY destino ";
        //echo $consultaviaje
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consultaviaje)) {
                $arregloViaje= array();
                while ($row2= $base->Registro()) {
                    
                    $idviaje= $row2['idviaje'];
                    $vdestino= $row2['vdestino'];
                    $vcantmaxpasajeros= $row2['vcantmaxpasajeros'];
                    $idempresa= $row2['idempresa'];
                    $rnumeroempleado= $row2['idempresa'];
                    $vimporte= $row2['vimporte'];
                    $tipoasiento= $row2['tipoasiento'];
                    $idayvuelta= $row2['idayvuelta'];
    
                    $viajenuevo= new Viaje();
                    $viajenuevo->cargar($idviaje, $vdestino, $vcantmaxpasajeros, $idempresa, $rnumeroempleado, $vimporte, $tipoasiento, $idayvuelta);
                    array_push($arregloViaje, $viajenuevo);
                }

            } else {
                $this->setMensajeoperacion($base->getError());
            }
            
        } else {
            $this->setMensajeoperacion($base->getError());
        }
        return $arregloViaje;
    }
/* 
idviaje;
vdestino;
vcantmaxpasajeros;
idempresa; //referenc
rnumeroempleado; //re
vimporte;
tipoasiento; //primer
idayvuelta; // si no
*/
    public function insertar(){
        $base=new BaseDatos();
        $resp= false;
        $consultaInsertar= "INSERT INTO Viaje(vdestino, vcantmaxpasajeros, idempresa, rnumeroempleado)
        VALUES (". $this->getVdestino() ." , ". $this->getVcantmaxpasajeros() . " , ". $this->getVcantmaxpasajeros(). " , ". $this->getRnumeroempleado(). ")";

        if ($base->Iniciar()) {
            if ($base->Ejecutar($consultaInsertar)) {
                $resp= true;
            } else {
                $this->setMensajeoperacion($base->getError());
            }

        } else {
            $this->setMensajeoperacion($base->getError());
        }
        return $resp;
    }
/* 
idviaje;
vdestino;
vcantmaxpasajeros;
idempresa; //referenc
rnumeroempleado; //re
vimporte;
tipoasiento; //primer
idayvuelta; // si no
*/
    public function modificar(){
        $base= new BaseDatos();
        $resp= false;
        $consultaModifica= "UPDATE Viaje SET vdestino=". $this->getIdviaje() . 
        ", vcantmaxpasajeros=". $this->getVcantmaxpasajeros() . 
        ", idempresa=". $this->getIdempresa() . 
        ", rnumeroempleado=". $this->getRnumeroempleado().
        ", vimporte=". $this->getVimporte().
        ", tipoasiento=". $this->getTipoasiento().
        ", idayvuelta=". $this->getIdayvuelta() . 
        " WHERE idviaje=". $this->getIdviaje();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consultaModifica)) {
                $resp= true;
            }else {
                $this->setMensajeoperacion($base->getError());
            }
        } else {
            $this->setMensajeoperacion($base->getError());
        }
        return $resp;
    }
/* 
idviaje;
vdestino;
vcantmaxpasajeros;
idempresa; //referenc
rnumeroempleado; //re
vimporte;
tipoasiento; //primer
idayvuelta; // si no
*/
    public function __toString()
    {
        return "\nId Viaje: ". $this->getIdviaje().
        "\nDestino: ". $this->getVdestino().
        "\nCantidad Max Pasajeros: ". $this->getVcantmaxpasajeros().
        "\nId Empresa: ". $this->getIdempresa().
        "\nN° Empleado: ". $this->getRnumeroempleado().
        "\nImporte: ". $this->getVimporte().
        "\nTipo Asiento: ". $this->getTipoasiento().
        "\nIda y Vuelta: ". $this->getIdayvuelta(). "\n"; 
    }
}