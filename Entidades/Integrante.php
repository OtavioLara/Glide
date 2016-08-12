<?php
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'Usuario.php';
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'Visitante.php';

abstract class Integrante {
    private $pessoa;
    
    public function Integrante(Pessoa $pessoa){
        $this->setPessoa($pessoa);
    }
    
    public function getPessoa(){
        return $this->pessoa;
    }
    private function setPessoa($pessoa){
        $this->pessoa = $pessoa;
    }
}
