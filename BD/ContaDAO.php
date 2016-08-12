<?php

require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'DAO.php';
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Entidades' . DIRECTORY_SEPARATOR . 'ContaGrupo.php';
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Entidades' . DIRECTORY_SEPARATOR . 'ContaUnica.php';

require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Tabelas' . DIRECTORY_SEPARATOR . 'TabelaConta.php';
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Tabelas' . DIRECTORY_SEPARATOR . 'TabelaItem.php';
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Tabelas' . DIRECTORY_SEPARATOR . 'TabelaIntegrantesItem.php';

class ContaDAO extends DAO {

    static public function getSQL($innerJoinIntegranteConta, $innerJoinItem, $innerJoinDistribuicao) {
        $innerJoin = "";
        $select = "";

        $select = "Select " . DAO::getLinhaAliases("C", TabelaConta::getAliasesConta());

        if ($innerJoinIntegranteConta) {
            $select.= "," . DAO::getLinhaAliases("IC", TabelaIntegranteConta::getAliasesIntegranteConta());
            $select.= "," . DAO::getLinhaAliases("UIC", TabelaUsuario::getAliasesUsuarioIntegranteDespesa());

            $innerJoin.= " inner join " . TabelaIntegranteConta::nomeTabela . " IC on IC." . TabelaIntegranteConta::idConta . " = C."
                    . TabelaConta::id;
            $innerJoin.= " inner join " . TabelaUsuario::nomeTabela . " UIC on UIC." . TabelaUsuario::id . " = IC."
                    . TabelaIntegranteConta::idUsuario;
        }

        if ($innerJoinItem) {
            $select.= "," . DAO::getLinhaAliases("I", TabelaItem::getAliasesItem());
            $innerJoin.= " inner join " . TabelaItem::nomeTabela . " I on I." . TabelaItem::idConta . " = C."
                    . TabelaConta::id;
            if ($innerJoinDistribuicao) {
                $select.= "," . DAO::getLinhaAliases("D", TabelaIntegrantesItem::getAliasesDistribuicao());
                $select.= "," . DAO::getLinhaAliases("UI", TabelaUsuario::getAliasesUsuarioDistribuicao());

                $innerJoin.= " inner join " . TabelaIntegrantesItem::nomeTabela . " D on D." . TabelaIntegrantesItem::idContaItem . " = I."
                        . TabelaItem::id;
                $innerJoin.= " inner join " . TabelaUsuario::nomeTabela . " UI on UI." . TabelaUsuario::id . " = D."
                        . TabelaIntegrantesItem::idUsuario;
            }
        }
        return $select . " from " . TabelaConta::nomeTabela . " C " . $innerJoin;
    }

    static private function getContas($clausulaWhere, $innerJoinIntegranteConta, $innerJoinItem, $innerJoinDistribuicao, $conexao) {
        if ($clausulaWhere != "") {
            $clausulaWhere = " where " . $clausulaWhere;
        }
        $sqlGeral = ContaDAO::getSQL($innerJoinIntegranteConta, $innerJoinItem, $innerJoinDistribuicao) . $clausulaWhere;
        echo $sqlGeral;
        $rs = DAO::executaSQL($sqlGeral, $conexao);
        $reg = mysqli_fetch_assoc($rs);
        $contas = array();

        /* vetores de aliases */
        $aliasesUsuarioDistribuicao = TabelaUsuario::getAliasesUsuarioDistribuicao();
        $aliasesUsuarioIntegranteConta = TabelaUsuario::getAliasesUsuarioIntegranteDespesa();
        $aliasesConta = TabelaConta::getAliasesConta();
        $aliasesItem = TabelaItem::getAliasesItem();

        while (isset($reg)) {

            //Se não foi recuperado a conta
            $idConta = $reg[$aliasesConta[TabelaConta::id]];
            if (!isset($contas[$idConta])) {
                $conta = DAO::getContaResultQuerry($reg, $aliasesConta);
                $contas[$idConta] = $conta;
            }

            /* Obtem item */
            if ($innerJoinItem) {
                $idItem = $reg[$aliasesItem[TabelaItem::id]];
                if (!$contas[$idConta]->possuiItem($idItem)) {
                    $item = DAO::getItemResultQuerry($reg, $aliasesItem);
                    $contas[$idConta]->adicionaItem($item);
                }

                if ($innerJoinDistribuicao) {
                    $idUsuario = $reg[$aliasesUsuarioDistribuicao[TabelaUsuario::id]];
                    if (!$contas[$idConta]->getItem($idItem)->possuiUsuario($idUsuario)) {
                        $distribuicao = DAO::getIntegranteItemResultQuerry($reg, TabelaIntegrantesItem::getAliasesDistribuicao());
                        $contas[$idConta]->getItem($idItem)->adicionaUsuario($distribuicao);
                    }
                }
            }

            if ($innerJoinIntegranteConta) {
                $idUsuario = $reg[$aliasesUsuarioIntegranteConta[TabelaUsuario::id]];
                if (!$contas[$idConta]->possuiIntegrante($idUsuario)) {
                    //get Integrante Conta QUERRY!
                    $integrante = DAO::getIntegranteContaResultQuerry($reg, TabelaIntegranteConta::getAliasesIntegranteConta());
                    $contas[$idConta]->adicionaIntegrante($integrante);
                }
            }
            $reg = mysqli_fetch_assoc($rs);
        }
        return $contas;
    }

    static public function getContaCompletaPorId($idConta, $conexao = null) {
        $clausulaWhere = "C." . TabelaConta::id . "='$idConta'";
        $contas = ContaDAO::getContas($clausulaWhere, true, true, true, $conexao);
        return DAO::getPrimeiraPosicao($contas);
    }

    static public function inserirIntegranteItem(IntegranteItem $integrante, $idItem, $conexao = null) {
        $sql = "insert into " . TabelaIntegrantesItem::nomeTabela . "(" .
                TabelaIntegrantesItem::idContaItem . "," . TabelaIntegrantesItem::idUsuario .
                "," . TabelaIntegrantesItem::valor . ") values(" .
                "'" . $idItem . "'," .
                "'" . $integrante->getPessoa()->getId() . "'," .
                "'" . $integrante->getValor() . "')";
        echo $sql . "<br/>";
    }

    static public function inserirItem(ItemConjunto $item, $idDespesa, $conexao = null) {
        $sql = "insert into " . TabelaItem::nomeTabela . "(" .
                TabelaItem::nome . "," . TabelaItem::valor . "," . TabelaItem::idConta;
        if ($item->getId() != null) {
            $sql.= "," . TabelaItem::id;
        }
        $sql .= ")";
        $sql .= " values (" .
                "'" . $item->getNome() . "'," .
                "'" . $item->getValor() . "'," .
                "'" . $idDespesa . "'";
        if ($item->getId() != null) {
            $sql.= "," . $despesa->getId();
        }
        $sql .= ")";
        echo $sql . "<br/>";

        foreach ($item->getIntegrantesItem() as $integrante) {
            ContaDAO::inserirIntegranteItem($integrante, 1);
        }
    }

    static public function inserirDespesa(ContaGrupo $despesa, $idGrupo, $conexao = null) {
        if ($despesa->getDataAlerta() != null) {
            $dataAlerta = $despesa->getDataAlerta();
        }
        $sql = "insert into " . TabelaConta::nomeTabela . "(" .
                TabelaConta::nome . "," . TabelaConta::valor . "," .
                TabelaConta::data . "," . TabelaConta::dataAlerta . "," .
                TabelaConta::descAdicional . "," . TabelaConta::idRepublica;
        if ($despesa->getId() != null) {
            $sql.= "," . TabelaConta::id;
        }
        $sql .= ")";
        $sql .= " values (" .
                "'" . $despesa->getNome() . "'," .
                "'" . $despesa->getValorTotal() . "'," .
                "'" . $despesa->getData() . "'," .
                "'" . $dataAlerta . "'," .
                "'" . $despesa->getInformacoesAdicionais() . "'," .
                "'" . $idGrupo . "'";
        if ($despesa->getId() != null) {
            $sql.= "," . $despesa->getId();
        }
        $sql .= ")";
        echo $sql . "<br/>";

        foreach ($despesa->getItens() as $item) {
            ContaDAO::inserirItem($item, 2);
        }
    }

}
