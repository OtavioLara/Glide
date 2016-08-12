<?php

require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Controle' . DIRECTORY_SEPARATOR . 'ControleGrupo.php';

if (isset($_POST["comando"])) {
    $comando = $_POST["comando"];
    if ($comando == "cadastrarGrupo") {
        $sucesso = ControleGrupo::cadastrarGrupo($_POST);
        if ($sucesso) {
            $nome = $_POST["nomeGrupo"];
            header("Location: ../Grupos.php?msg=grupo_cadastrado&nome=$nome");
        }
    } else if ($comando == "sairGrupo") {
        $sucesso = ControleGrupo::sairGrupo($_POST);
        if ($sucesso) {
            $nome = $_POST["nomeGrupo"];
            header("Location: ../Grupos.php?msg=saiu_grupo&nome=$nome");
        }
    }
}
?>
