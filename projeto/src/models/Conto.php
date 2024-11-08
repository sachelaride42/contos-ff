<?php
namespace Src\models;
class Conto {
    private $id;
    private $usuario_id;
    private $titulo;
    private $data_publicacao;
    private $texto;

    public function __construct($id = null, $usuario_id = null, $titulo = null, $data_publicacao = null, $texto = null) {
        $this->id = $id;
        $this->usuario_id = $usuario_id;
        $this->titulo = $titulo;
        $this->data_publicacao = $data_publicacao;
        $this->texto = $texto;
    }
    public function setId($id){
        $this->id = $id;
    }
    public function getId() {
        return $this->id;
    }
    public function getUsuarioId() {
        return $this->usuario_id;
    }
    public function getTitulo() {
        return $this->titulo;
    }
    public function setTitulo($titulo){
        $this->titulo = $titulo;
    }
    public function getDataPublicacao() {
        return $this->data_publicacao;
    }
    public function getTexto() {
        return $this->texto;
    }
    public function setTexto($texto){
        $this->texto = $texto;
    }

    public function validarConto(){
        if(empty($this->usuario_id) || empty($this->titulo) || empty($this->texto) || empty($this->data_publicacao)){
            return false;
        }else{
            return true;
        }
    }


}