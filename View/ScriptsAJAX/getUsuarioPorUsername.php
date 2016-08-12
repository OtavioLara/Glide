<?php

if (isset($_GET['username'])) {
    require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'BD' . DIRECTORY_SEPARATOR . 'UsuarioDAO.php';
    $username = $_GET['username'];
    $usuarioDAO = new UsuarioDAO();
    $usuario = $usuarioDAO->getUsuarioPorUserName($username);
    if (isset($usuario)) {
        echo $usuario->jsonSerialize();
    } else {
        echo "false";
    }
} else {
    echo "false";
}
?>




