<?php
include_once "BaseDatos.php";
/*
CREATE TABLE empresa(
    idempresa bigint AUTO_INCREMENT,
    enombre varchar(150),
    edireccion varchar(150),
    PRIMARY KEY (idempresa)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
*/
class Empresa{
    private $idempresa;//primary key
    private $enombre;
    private $edireccion;
    private $mensajeoperacion;

    public function __construct()
    {
        $this->idempresa='';
        $this->enombre='';
        $this->edireccion='';
    }

    public function cargar($idempresa, $enombre, $edireccion){
        $this->idempresa= $idempresa;
        $this->enombre= $enombre;
        $this->edireccion= $edireccion;
    }


    public function getIdempresa(){
        return $this->idempresa;
    }

    public function setIdempresa($idempresa){
        $this->idempresa = $idempresa;
    }

    public function getEnombre(){
        return $this->enombre;
    }

    public function setEnombre($enombre){
        $this->enombre = $enombre;
    }

    public function getEdireccion(){
        return $this->edireccion;
    }

    public function setEdireccion($edireccion){
        $this->edireccion = $edireccion;
    }

    public function getMensajeoperacion(){
        return $this->mensajeoperacion;
    }

    public function setMensajeoperacion($mensajeoperacion){
        $this->mensajeoperacion = $mensajeoperacion;
    }
    /**
     * recupera los datos de una empresa por idempresa
     */


/* 
idempresa;//prima
enombre;
edireccion;
mensajeoperacion;
*/
    public function buscar($idempresa){
        $base= new BaseDatos();
        $consultaEmpresa= "SELECT * FROM empresa WHERE idempresa= {$idempresa}";
        $resp= false;
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consultaEmpresa)) {
                if ($row2= $base->Registro()) {
                    $this->setIdempresa($idempresa);
                    $this->setEnombre($row2['enombre']);
                    $this->setEdireccion($row2['edireccion']);
                    $resp=true;
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
        $arregloEmpresa= null;
        $base= new BaseDatos();
        $consultaEmpresas= "SELECT * FROM Empresa ";
        if ($condicion!="") {
            $consultaEmpresas= $consultaEmpresas. " WHERE ". $condicion;
        }
       
        //echo $consultaEmpresas
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consultaEmpresas)) {
                $arregloEmpresa= array();
                while ($row2=$base->Registro()) {
                    
                    $idempresa= $row2['idempresa'];
                    $enombre= $row2['enombre'];
                    $edireccion= $row2['edireccion'];

                    $empre= new Empresa();
                    $empre->cargar($idempresa, $enombre, $edireccion);

                    array_push($arregloEmpresa, $empre);

                }
            } else {
                $this->setMensajeoperacion($base->getError());
            }
        } else {
            $this->setMensajeoperacion($base->getError());
        }
        return $arregloEmpresa;
    }

  

    public function insertar(){
        $base= new BaseDatos();
        $resp= false;
        $consultaInsertar = "INSERT INTO empresa VALUES (default, '{$this->getEnombre()}', '{$this->getEdireccion()}')";

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
idempresa;//prima
enombre;
edireccion;
mensajeoperacion;
*/  
    public function modificar(){
        $resp= false;
        $base= new BaseDatos();
        $consultaModifica= "UPDATE empresa SET enombre= '{$this->getEnombre()}'  ,edireccion= '{$this->getEdireccion()}'  WHERE idempresa= {$this->getIdempresa()}";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consultaModifica)) {
                $resp=  true;
            } else {
                $this->setMensajeoperacion($base->getError());
            }
        } else {
            $this->setMensajeoperacion($base->getError());
        }
        return $resp;
    }

    public function eliminar(){
        $base= new BaseDatos();
        $resp= false;
        if ($base->Iniciar()) {
            $consultaBorra= "DELETE FROM Empresa WHERE idempresa= {$this->getIdempresa()}";
            if ($base->Ejecutar($consultaBorra)) {
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
idempresa;//prima
enombre;
edireccion;
mensajeoperacion;
*/  
    public function __toString()
    {
        return "\nId Empresa: ". $this->getIdempresa() . 
        "\nNombre: ". $this->getEnombre().
        "\nDireccion: ". $this->getEdireccion(). "\n"; 
    }

}