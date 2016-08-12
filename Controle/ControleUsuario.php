<?php

require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Entidades' . DIRECTORY_SEPARATOR . 'Usuario.php';
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'BD' . DIRECTORY_SEPARATOR . 'UsuarioDAO.php';

class ControleUsuario {

    public static function cadastrarUsuario($params) {
        $email = $params["email"];
        $nome = $params["nome"];
        $username = $params["username"];
        $senha = $params["senha"];
        $usuario = new Usuario($nome, $username, $email);
        UsuarioDAO::insereUsuario($usuario, $senha);
        return true;
    }

    public static function login($params) {
        $username = $params["username"];
        $senha = $params["senha"];
        return UsuarioDAO::getUsuarioPorUsernameESenha($username, $senha);
    }

}
