<?php

require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Controle' . DIRECTORY_SEPARATOR . 'ControleUsuario.php';

if (isset($_POST["comando"])) {
    $comando = $_POST["comando"];
    if ($comando == "cadastrarUsuario") {
        $sucesso = ControleUsuario::cadastrarUsuario($_POST);
        if ($sucesso) {
            header("Location: ../Login.php?msg=cadastro_sucesso");
        }
    } else if ($comando == "login") {
        $usuario = ControleUsuario::login($_POST);
        if (isset($usuario)) {
            session_start();
            $_SESSION['logado'] = true;
            $_SESSION['Usuario'] = base64_encode(serialize($usuario));
            header("Location: ../Index.php");
        } else {
            header("Location: ../Login.php?msg=login_falha");
        }
    }
}
?>
