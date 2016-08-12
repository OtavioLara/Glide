<?php
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'Conta.php';
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'IntegranteConta.php';
class ContaGrupo extends Conta {

    private $integrantes; //array de IntegrantesConta
    private $dataAlerta;

    public function ContaGrupo($nome, $valorTotal, $data, $dataAlerta, $informacoesAdicionais, $itens = null, $integrantesConta = null, $id = null) {
        parent::Conta($nome, $valorTotal, $data, $informacoesAdicionais, $itens, $id);
        $this->setIntegrantes($integrantesConta);
        $this->setDataAlerta($dataAlerta);
    }

    

    public function getDataAlerta() {
        return $this->dataAlerta;
    }

    private function setDataAlerta($dataAlerta) {
        $this->dataAlerta = $dataAlerta;
    }

    public function adicionaIntegrante(IntegranteConta $integranteConta) {
        $this->integrantes[$integranteConta->getPessoa()->getId()] = $integranteConta;
    }

    public function possuiIntegrante($idIntegrante) {
        return isset($this->integrantes[$idIntegrante]);
    }

    public function getIntegrantes() {
        return $this->integrantes;
    }

    private function setIntegrantes($integrantesConta) {
        if (isset($integrantesConta)) {
            $this->integrantes = $integrantesConta;
        } else {
            $this->integrantes = array();
        }
    }

    public function escreve() {
        echo "Nome Conta: " . $this->getNome()."<br/>";
        echo "Valor: ".$this->getValorTotal()."<br/>";
        echo "Data: " . $this->getData()."<br/>";
        echo "Data Alerta: " . $this->getDataAlerta()."<br/>";
        echo "Inf. Adicionais:: " . $this->getInformacoesAdicionais()."<br/>";

        echo "Integrantes: ";
        echo "<ul>";
        foreach ($this->getIntegrantes() as $integrante) {
            echo "<li> Pessoa: " . $integrante->getPessoa()->getId() . "</li>";
            echo "<ul>";
            echo "<li> Valor total na despesa: " . $integrante->getValor() . "</li>";
            echo "<li> Valor de Entrada: " . $integrante->getValorDeEntrada() . "</li>";
            echo "<li> Valor a pagar: " . $integrante->getValorAPagar() . " / " . $integrante->getValorTotalAPagar() . "</li>";
            echo "<li> Valor a receber: " . $integrante->getValorAReceber() . " / " . $integrante->getValorTotalAReceber() . "</li>";
            echo "</ul>";
        }
        echo "</ul>";

        echo "Itens: ";
        echo "<ul>";
        foreach($this->getItens() as $item){
            echo "<li>Item: ".$item->getNome()."</li>";
            echo "<li>Valor: ".$item->getValor()."</li>";
            echo "<ul>";
            foreach($item->getIntegrantesItem() as $integrante){
                echo "<li> Pessoa: " . $integrante->getPessoa()->getId() . "</li>";
                echo "<ul>";
                echo "<li> Valor: " . $integrante->getValor() . "</li>";
                echo "</ul>";
            }
            echo "</ul>";
        }
        echo "</ul>";
    }

}
