<?php

require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Controle' . DIRECTORY_SEPARATOR . 'ControleDespesa.php';

if (isset($_POST["comando"])) {
    $comando = $_POST["comando"];
    if ($comando == "cadastrarDespesa") {
        ControleDespesa::cadastrarDespesa($_POST);
    }
}
?>
