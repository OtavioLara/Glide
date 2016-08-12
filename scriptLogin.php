<?php

session_start();
if (!isset($_SESSION['logado']) || $_SESSION['logado'] == false) {
    session_destroy();
    header('Location: Login.php');
} else {
    //date_default_timezone_set('America/Sao_Paulo');
    //$formato = new Formato();
    require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'BD' . DIRECTORY_SEPARATOR . 'DbConexao.php';
    require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'Entidades' . DIRECTORY_SEPARATOR . 'Usuario.php';
    $conexao = DbConexao::getConnection();
    $usuario = unserialize(base64_decode($_SESSION['Usuario']));
}
?>
