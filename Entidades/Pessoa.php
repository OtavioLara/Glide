<?php

abstract class Pessoa {

    private $id;
    private $nome;

    public function Pessoa($nome, $id = null) {
        $this->setNome($nome);
        $this->setId($id);
    }
    
    public function getId(){
        return $this->id;
    }
    
    private function setId($id){
        $this->id = $id;
    }
    public function getNome(){
        return $this->nome;
    }
    
    private function setNome($nome){
        $this->nome = $nome;
    }

}

?>