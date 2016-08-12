<?php

require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'IntegranteValor.php';

class IntegranteConta extends IntegranteValor {

    private $valorPago; // > 0 (deve pagar) < 0 (deve receber)
    private $valorDeEntrada;

    public function IntegranteConta(Pessoa $pessoa, $valor, $valorDeEntrada, $valorPago = 0) {
        parent::IntegranteValor($pessoa, $valor);
        $this->setValorPago($valorPago);
        $this->setValorDeEntrada($valorDeEntrada);
    }

    public function toString() {
        $descricao = $this->getPessoa()->getNome();
        if (!$this->isContribuinte()) {
            $descricao.= " precisa pagar " . $this->getValorAPagar() . " de " . $this->getValorTotalAPagar();
        } else {
            $descricao.= " precisa receber " . $this->getValorAReceber() . " de " . $this->getValorTotalAReceber();
        }
        return $descricao;
    }

    public function getValorAPagar() {
        if (!$this->isContribuinte()) {
            return $this->getValor() - $this->getValorDeEntrada() - $this->getValorPago();
        } else {
            return 0;
        }
    }

    public function getValorAReceber() {
        if ($this->isContribuinte()) {
            return $this->getValorDeEntrada() - $this->getValor() + $this->getValorPago();
        } else {
            return 0;
        }
    }

    public function isContribuinte() {
        return $this->getValorDeEntrada() > $this->getValorPago();
    }

    public function getValorTotalAPagar() {
        if (!$this->isContribuinte()) {
            return $this->getValor() - $this->getValorDeEntrada();
        } else {
            return 0;
        }
    }

    public function getValorTotalAReceber() {
        if ($this->isContribuinte()) {
            return $this->getValorDeEntrada() - $this->getValor();
        } else {
            return 0;
        }
    }

    public function getValorPago() {
        return $this->valorPago;
    }

    private function setValorPago($valorPago) {
        $this->valorPago = $valorPago;
    }

    public function getValorDeEntrada() {
        return $this->valorDeEntrada;
    }

    private function setValorDeEntrada($valorDeEntrada) {
        $this->valorDeEntrada = $valorDeEntrada;
    }

}
