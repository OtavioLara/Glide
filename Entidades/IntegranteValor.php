<?php
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'Integrante.php';
abstract class IntegranteValor extends Integrante{

    private $valor;

    public function IntegranteValor(Pessoa $pessoa, $valor) {
        parent::Integrante($pessoa);
        $this->setValor($valor);
    }

    private function setValor($valor) {
        $this->valor = $valor;
    }

    public function getValor() {
        return $this->valor;
    }

}
