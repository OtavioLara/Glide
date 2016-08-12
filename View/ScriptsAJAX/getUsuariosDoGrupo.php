<?php
if (isset($_GET['idGrupo'])) {
    require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'BD' . DIRECTORY_SEPARATOR . 'GrupoDAO.php';
    $idGrupo = $_GET['idGrupo'];
    $usuarios = GrupoDAO::getUsuariosDoGrupo($idGrupo);
    echo json_encode($usuarios);
}
?>
