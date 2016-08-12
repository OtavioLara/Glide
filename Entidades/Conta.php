<?php
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'ItemConjunto.php';
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'ItemUnico.php';

abstract class Conta {

    private $nome;
    private $data;
    private $informacoesAdicionais;
    private $valorTotal;
    private $itens;
    private $id;

    public function Conta($nome, $valorTotal, $data, $informacoesAdicionais, $itens, $id) {
        $this->setNome($nome);
        $this->setValorTotal($valorTotal);
        $this->setData($data);
        $this->setInformacoesAdicionais($informacoesAdicionais);
        $this->setId($id);
        $this->setItens($itens);
    }

    public function adicionaItem(Item $item) {
        $this->itens[$item->getId()] = $item;
    }

    public function possuiItem($idItem) {
        return isset($this->itens[$idItem]);
    }

    public function getData() {
        return $this->data;
    }

    private function setData($data) {
        $this->data = $data;
    }

    public function getInformacoesAdicionais(){
        return $this->informacoesAdicionais;
    }
    
    private function setInformacoesAdicionais($inf){
        $this->informacoesAdicionais = $inf;
    }
    public function getItem($idItem) {
        return $this->itens[$idItem];
    }

    public function getItens() {
        return $this->itens;
    }

    private function setItens($itens) {
        if (isset($itens)) {
            $this->itens = $itens;
        } else {
            $this->itens = array();
        }
    }

    public function getNome() {
        return $this->nome;
    }

    private function setNome($nome) {
        $this->nome = $nome;
    }

    public function getValorTotal() {
        return $this->valorTotal;
    }

    private function setValorTotal($valorTotal) {
        $this->valorTotal = $valorTotal;
    }

    public function getId() {
        return $this->id;
    }

    private function setId($id) {
        $this->id = $id;
    }

    
}
