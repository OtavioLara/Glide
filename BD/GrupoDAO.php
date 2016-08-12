<?php

require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'DAO.php';
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Tabelas' . DIRECTORY_SEPARATOR . 'TabelaGrupo.php';
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Tabelas' . DIRECTORY_SEPARATOR . 'TabelaIntegranteGrupo.php';
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Tabelas' . DIRECTORY_SEPARATOR . 'TabelaUsuario.php';
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Entidades' . DIRECTORY_SEPARATOR . 'Grupo.php';
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Entidades' . DIRECTORY_SEPARATOR . 'Usuario.php';
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Entidades' . DIRECTORY_SEPARATOR . 'IntegranteGrupo.php';

class GrupoDAO extends DAO {

    static private function getSQL($innerJoinUsuario) {
        $innerJoin = "";
        $select = "";

        $select = "Select " . DAO::getLinhaAliases("G", TabelaGrupo::getAliasesGrupo());

        if ($innerJoinUsuario) {
            $select .= "," . DAO::getLinhaAliases("IG", TabelaIntegranteGrupo::getAliasesIntegranteGrupo());
            $select .= "," . DAO::getLinhaAliases("UG", TabelaUsuario::getAliasesUsuarioIntegranteGrupo());
            $innerJoin .= " inner join " . TabelaIntegranteGrupo::nomeTabela . " IG on IG." .
                    TabelaIntegranteGrupo::idGrupo . " = G." . TabelaGrupo::id;
            $innerJoin .= " inner join " . TabelaUsuario::nomeTabela . " UG on UG." .
                    TabelaUsuario::id . " = IG." . TabelaIntegranteGrupo::idUsuario;
        }
        return $select . " from " . TabelaGrupo::nomeTabela . " G " . $innerJoin;
    }

    static private function getGrupos($clausulaWhere, $innerJoinUsuario, $conexao) {
        if ($clausulaWhere != "") {
            $clausulaWhere = " where " . $clausulaWhere;
        }
        $sqlGeral = GrupoDAO::getSQL($innerJoinUsuario) . $clausulaWhere;
        $rs = DAO::executaSQL($sqlGeral, $conexao);
        $reg = mysqli_fetch_assoc($rs);
        $grupos = array();

        /* Aliases */
        $aliasesGrupo = TabelaGrupo::getAliasesGrupo();
        $aliasesUsuario = TabelaUsuario::getAliasesUsuarioIntegranteGrupo();
        while (isset($reg)) {
            $idGrupo = $reg[$aliasesGrupo[TabelaGrupo::id]];
            if (!isset($grupos[$idGrupo])) {
                $grupos[$idGrupo] = DAO::getGrupoResultQuerry($reg, $aliasesGrupo);
            }
            if ($innerJoinUsuario) {
                $idUsuario = $reg[$aliasesUsuario[TabelaUsuario::id]];
                if (!$grupos[$idGrupo]->possuiIntegrante($idUsuario)) {
                    $integrante = DAO::getIntegranteGrupoResultQuerry($reg, TabelaIntegranteGrupo::getAliasesIntegranteGrupo());
                    $grupos[$idGrupo]->adicionaIntegrante($integrante);
                }
            }
            $reg = mysqli_fetch_assoc($rs);
        }
        return $grupos;
    }

    static public function getGrupoCompletoPorId($idGrupo, $conexao = null) {
        $clausulaWhere = "G." . TabelaGrupo::id . " = '$idGrupo'";
        $grupos = GrupoDAO::getGrupos($clausulaWhere, true, $conexao);
        return DAO::getPrimeiraPosicao($grupos);
    }

    static public function getUsuariosDoGrupo($idGrupo, $conexao = null) {
        $sql = "Select " . DAO::getLinhaAliases("U", TabelaUsuario::getAliasesUsuario()) .
                " from " . TabelaUsuario::nomeTabela . " U inner join " .
                TabelaIntegranteGrupo::nomeTabela . " IG on U." . TabelaUsuario::id . " = IG." .
                TabelaIntegranteGrupo::idUsuario . " ORDER BY U." . TabelaUsuario::nome;
        $rs = DAO::executaSQL($sql, $conexao);
        $reg = mysqli_fetch_assoc($rs);
        $usuarios = array();
        $index = 0;
        while (isset($reg)) {
            $usuario = DAO::getUsuarioResultQuery($reg, TabelaUsuario::getAliasesUsuario());
            $usuarios[$index] = $usuario;
            $index++;
            $reg = mysqli_fetch_assoc($rs);
        }
        return $usuarios;
    }

    static public function getGruposDoUsuario($idUsuario, $conexao = null) {
        $clausulaWhere = "G." . TabelaGrupo::id . " in " .
                "(Select " . TabelaIntegranteGrupo::idGrupo .
                " from " . TabelaIntegranteGrupo::nomeTabela .
                " where " . TabelaIntegranteGrupo::idUsuario . "='$idUsuario')";
        return GrupoDAO::getGrupos($clausulaWhere, false, $conexao);
    }

    static public function getGruposCompletosDoUsuario($idUsuario, $conexao = null) {
        $clausulaWhere = "G." . TabelaGrupo::id . " in " .
                "(Select " . TabelaIntegranteGrupo::idGrupo .
                " from " . TabelaIntegranteGrupo::nomeTabela .
                " where " . TabelaIntegranteGrupo::idUsuario . "='$idUsuario')";
        return GrupoDAO::getGrupos($clausulaWhere, true, $conexao);
    }

    static public function insereIntegranteGrupo(IntegranteGrupo $integrante, $idGrupo, $conexao = null) {
        $admin = $integrante->isAdmin() ? 1 : 0;
        $sql = "insert into " . TabelaIntegranteGrupo::nomeTabela .
                "(" . TabelaIntegranteGrupo::idGrupo . "," .
                TabelaIntegranteGrupo::idUsuario . "," .
                TabelaIntegranteGrupo::administrador . ") values (" .
                "'" . $idGrupo . "'," .
                "'" . $integrante->getPessoa()->getId() . "'," .
                "'" . $admin . "')";

        DAO::executaSQL($sql, $conexao);
    }

    static public function insereGrupo(Grupo $grupo, $conexao = null) {
        if (!isset($conexao)) {
            $conexao = DAO::getConexao();
        }
        $sql = "insert into " . TabelaGrupo::nomeTabela .
                "(" . TabelaGrupo::nome . ") values ('" .
                mysqli_real_escape_string($conexao, $grupo->getNome()) . "')";
        DAO::executaSQL($sql, $conexao);
        $idGrupo = mysqli_insert_id($conexao);
        foreach ($grupo->getIntegrantesGrupo() as $integrante) {
            GrupoDAO::insereIntegranteGrupo($integrante, $idGrupo, $conexao);
        }
        return $idGrupo;
    }

    static public function removeIntegranteGrupo($idUsuario, $idGrupo, $conexao = null) {
        $sql = "delete from " . TabelaIntegranteGrupo::nomeTabela .
                " where " . TabelaIntegranteGrupo::idGrupo . "='$idGrupo'" .
                " and " . TabelaIntegranteGrupo::idUsuario . "='$idUsuario'";
        DAO::executaSQL($sql, $conexao);
    }

}
