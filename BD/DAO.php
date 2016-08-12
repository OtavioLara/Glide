<?php

require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'DbConexao.php';

abstract class DAO {

    static protected function getConexao() {
        return DbConexao::getConnection();
    }

    static protected function executaSQL($sql, $conexao) {
        if (!isset($conexao)) {
            $conexao = DAO::getConexao();
        }
        return mysqli_query($conexao, $sql);
    }

    /* Funções de Result Querry */

    static protected function getUsuarioResultQuery($reg, $aliases) {
        $nome = $reg[$aliases[TabelaUsuario::nome]];
        $username = $reg[$aliases[TabelaUsuario::username]];
        $email = $reg[$aliases[TabelaUsuario::email]];
        $id = $reg[$aliases[TabelaUsuario::id]];
        return new Usuario($nome, $username, $email, $id);
    }

    static protected function getGrupoResultQuerry($reg, $aliases) {
        $nome = $reg[$aliases[TabelaGrupo::nome]];
        $id = $reg[$aliases[TabelaGrupo::id]];
        return new Grupo($nome, $id);
    }

    static protected function getIntegranteGrupoResultQuerry($reg, $aliases) {
        $admin = $reg[$aliases[TabelaIntegranteGrupo::administrador]];
        $usuario = DAO::getUsuarioResultQuery($reg, TabelaUsuario::getAliasesUsuarioIntegranteGrupo());
        return new IntegranteGrupo($usuario, $admin);
    }

    static protected function getIntegranteContaResultQuerry($reg, $aliases) {
        $pessoa = DAO::getUsuarioResultQuery($reg, TabelaUsuario::getAliasesUsuarioIntegranteDespesa());
        $valorPago = $reg[$aliases[TabelaIntegranteConta::valorPago]];
        $valorTotal = $reg[$aliases[TabelaIntegranteConta::valorTotal]];
        $valorDeEntrada = $reg[$aliases[TabelaIntegranteConta::valorDeEntrada]];
        return new IntegranteConta($pessoa, $valorTotal, $valorPago, $valorDeEntrada);
    }

    static protected function getIntegranteItemResultQuerry($reg, $aliases) {
        $pessoa = DAO::getUsuarioResultQuery($reg, TabelaUsuario::getAliasesUsuarioDistribuicao());
        $valor = $reg[$aliases[TabelaIntegrantesItem::valor]];
        return new IntegranteItem($pessoa, $valor);
    }

    static protected function getItemResultQuerry($reg, $aliases) {
        $id = $reg[$aliases[TabelaItem::id]];
        $nome = $reg[$aliases[TabelaItem::nome]];
        $valor = $reg[$aliases[TabelaItem::valor]];
        return new ItemConjunto($nome, $valor, null, $id);
    }

    static protected function getContaResultQuerry($reg, $aliases) {
        $nome = $reg[$aliases[TabelaConta::nome]];
        $valor = $reg[$aliases[TabelaConta::valor]];
        return new ContaGrupo($nome, $valor);
    }

    /* Funções Adicionais */

    static protected function getPrimeiraPosicao($array) {
        if (count($array) > 0) {
            return reset($array);
        } else {
            return null;
        }
    }

    static protected function getLinhaInnerJoin($aliaseTabela1, $nomeTabela2, $aliaseTabela2, $atr1, $atr2) {
        return "inner join " . $nomeTabela2 . " on " . $aliaseTabela1 . "." . $atr1 .
                " = " . $aliaseTabela2 . "." . $atr2;
    }

    static protected function getLinhaAliases($nomeTabela, $aliases) {
        $linhaAliase = "";
        $index = 0;
        $tamArray = count($aliases);
        foreach ($aliases as $nomeAtributo => $aliaseAtributo) {
            if ($index != $tamArray - 1) {
                $linhaAliase.= $nomeTabela . "." . $nomeAtributo . " as " . $aliaseAtributo . ",";
            } else {
                $linhaAliase.= $nomeTabela . "." . $nomeAtributo . " as " . $aliaseAtributo . "";
            }
            $index++;
        }
        //$linhaAliase[strlen($linhaAliase) - 1] = ""; ERRO ESCROTO DO PHP
        return $linhaAliase;
    }

}
