<?php

class Nave {

    // Propiedades
    public $id;
    public $tipo;
    public $municion;
    public $salto;
    public $foto;

    // Constructor
    public function __construct($id, $tipo, $municion, $salto, $foto){
        $this->id = $id;
        $this->tipo = $tipo;
        $this->municion = $municion;
        $this->salto = $salto;
        $this->foto = $foto;
    }

    // Getter & Setter
    public function setID($id){
        $this->id = $id;
    }
    public function getID(){
        return $this->id;
    }

    public function setTipo($tipo){
        $this->tipo = $tipo;
    }
    public function getTipo(){
        return $this->tipo;
    }
    public function setMunicion($municion){
        $this->municion = $municion;
    }
    public function getMunicion(){
        return $this->municion;
    }
    public function setSalto($salto){
        $this->salto = $salto;
    }
    public function getSalto(){
        return $this->salto;
    }

    public function setFoto($foto){
        $this->foto = $foto;
    }
    public function getFoto(){
        return $this->foto;
    }


}

?>