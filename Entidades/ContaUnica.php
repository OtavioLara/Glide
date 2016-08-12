<?php

class ContaUnica extends Conta {

    private $itens; //array de ItemUnico
    
    public function ContaUnica($nome, $valorTotal, $itens = null, $id = null) {
        parent::Conta($nome, $valorTotal, $id);
        $this->setItens($itens);
    }
    
    public function getItens(){
        return $this->itens;
    }
    
    private function setItens($itens){
        if(isset($itens)){
            $this->itens = $itens;
        }else{
            $this->itens = array();
        }
    }
}
