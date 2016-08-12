<?php

require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'BD' . DIRECTORY_SEPARATOR . 'ContaDAO.php';

class ControleDespesa {

    static public function cadastrarDespesa($params) {
        $nomeConta = $params["nomeConta"];
        $dataConta = $params["dataConta"];
        $dataAlerta = $params["dataAlerta"];
        $idGrupo = $params["idGrupo"];
        $informacoesAdicionais = $params["informacoesAdicionais"];
        if (isset($params["idConta"])) {
            $idConta = $params["idConta"];
        }else{
            $idConta = null;
        }
        //print_r($params["valorIntegranteItem"]);
        //Cria Itens
        $valorTotalPorUsuario = array();
        $itens = array();
        $index = 0;
        for ($i = 0; $i < count($params["nomeItem"]); $i++) {
            $nomeItem = $params["nomeItem"][$i];
            $valorItem = $params["valorItem"][$i];
            $totalIntegrantesItem = $params["totalIntegrantes"][$i];
            $integrantesItem = array();
            for ($j = 0; $j < $totalIntegrantesItem; $j++) {
                $idIntegranteItem = $params["idIntegranteItem"][$index];
                $valorIntegranteItem = $params["valorIntegranteItem"][$index];
                $usuario = new Usuario(null, null, null, $idIntegranteItem);
                $integrantesItem[$idIntegranteItem] = new IntegranteItem($usuario, $valorIntegranteItem);
                if (isset($valorTotalPorUsuario[$idIntegranteItem])) {
                    $valorTotalPorUsuario[$idIntegranteItem] += $valorIntegranteItem;
                } else {
                    $valorTotalPorUsuario[$idIntegranteItem] = $valorIntegranteItem;
                }
                $index++;
            }
            $itens[$i] = new ItemConjunto($nomeItem, $valorItem, $integrantesItem);
        }
        $integrantesConta = array();
        $valorTotal = 0;
        foreach ($valorTotalPorUsuario as $id => $valor) {
            $usuario = new Usuario(null, null, null, $id);
            $integrantesConta[$id] = new IntegranteConta($usuario, $valor, 0);
            $valorTotal += $valor;
        }
        for ($i = 0; $i < count($params["idContribuinte"]); $i++) {
            $idContribuinte = $params["idContribuinte"][$i];
            $valorDeEntrada = $params["valorContribuicao"][$i];
            $usuario = new Usuario(null, null, null, $idContribuinte);
            if (isset($valorTotalPorUsuario[$idContribuinte])) {
                $valor = $valorTotalPorUsuario[$idContribuinte];
            } else {
                $valor = 0;
            }
            $integrantesConta[$idContribuinte] = new IntegranteConta($usuario, $valor, $valorDeEntrada);
        }
        $despesa = new ContaGrupo($nomeConta, $valorTotal, $dataConta, $dataAlerta, $informacoesAdicionais, $itens, $integrantesConta, $idConta);
        $despesa->escreve();
        ContaDAO::inserirDespesa($despesa, $idGrupo);
    }

}
