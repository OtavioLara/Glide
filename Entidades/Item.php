<?php

abstract class Item {

    private $nome;
    private $valor;
    private $id;

    public function Item($nome, $valor, $id) {
        $this->setNome($nome);
        $this->setValor($valor);
        $this->setId($id);
    }

    public function getId() {
        return $this->id;
    }

    private function setId($id) {
        $this->id = $id;
    }

    public function getValor() {
        return $this->valor;
    }

    private function setValor($valor) {
        $this->valor = $valor;
    }

    public function getNome() {
        return $this->nome;
    }

    private function setNome($nome) {
        $this->nome = $nome;
    }

}
