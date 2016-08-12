<?php

require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'DAO.php';
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Tabelas' . DIRECTORY_SEPARATOR . 'TabelaUsuario.php';
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Entidades' . DIRECTORY_SEPARATOR . 'Usuario.php';

class UsuarioDAO extends DAO {

    static private function getSQL() {
        $sql = "Select " . DAO::getLinhaAliases("U", TabelaUsuario::getAliasesUsuario())
                . " from " . TabelaUsuario::nomeTabela . " U ";
        return $sql;
    }

    static private function getUsuarios($clausulaWhere, $conexao) {
        if ($clausulaWhere != "") {
            $clausulaWhere = " where " . $clausulaWhere;
        }
        $sqlGeral = UsuarioDAO::getSQL() . $clausulaWhere;
        $rs = DAO::executaSQL($sqlGeral, $conexao);
        $reg = mysqli_fetch_assoc($rs);
        $usuarios = array();
        while (isset($reg)) {
            $usuario = DAO::getUsuarioResultQuery($reg, TabelaUsuario::getAliasesUsuario());
            $usuarios[$usuario->getId()] = $usuario;
            $reg = mysqli_fetch_assoc($rs);
        }
        return $usuarios;
    }

    static public function getUsuarioPorUsernameESenha($username, $senha, $conexao = null) {
        $clausulaWhere = "U." . TabelaUsuario::username . "='$username' " .
                "and U." . TabelaUsuario::senha . "='$senha'";
        $usuarios = UsuarioDAO::getUsuarios($clausulaWhere, $conexao);
        return DAO::getPrimeiraPosicao($usuarios);
    }

    static public function getUsuarioPorUserName($username, $conexao = null) {
        $clausulaWhere = "U." . TabelaUsuario::username . "='$username' ";
        $usuarios = UsuarioDAO::getUsuarios($clausulaWhere, $conexao);
        return DAO::getPrimeiraPosicao($usuarios);
    }

    static public function insereUsuario(Usuario $usuario, $senha, $conexao = null) {
        if (!isset($conexao)) {
            $conexao = DAO::getConexao();
        }
        $sql = "insert into " . TabelaUsuario::nomeTabela .
                "(" . TabelaUsuario::email . "," .
                TabelaUsuario::nome . "," .
                TabelaUsuario::senha . "," .
                TabelaUsuario::username . ") values ('" .
                mysqli_real_escape_string($conexao, $usuario->getEmail()) . "','" .
                mysqli_real_escape_string($conexao, $usuario->getNome()) . "','" .
                mysqli_real_escape_string($conexao, $senha) . "','" .
                mysqli_real_escape_string($conexao, $usuario->getUsername()) . "')";
        DAO::executaSQL($sql, $conexao);
    }

}
