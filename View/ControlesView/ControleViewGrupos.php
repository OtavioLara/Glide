<?php

require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'BD' . DIRECTORY_SEPARATOR . 'GrupoDAO.php';

class ControleViewGrupos {

    public static function escreveGruposUsuario($idUsuario) {
        $gruposUsuario = GrupoDAO::getGruposCompletosDoUsuario($idUsuario);
        foreach ($gruposUsuario as $grupo) {
            $podeSair = $grupo->isUsuarioPodeSair($idUsuario) ? 1 : 0;
            $idGrupo = $grupo->getId();
            $nomeGrupo = $grupo->getNome();
            echo "<tr>";
            echo "<td> ".$nomeGrupo ."</td>";
            echo "<td>" .
            "<form action='ControlesScript/ControleGrupoScript.php' method='post'>" .
            "<input type='hidden' name='comando' value='sairGrupo'> " .
            "<input type='hidden' name='idUsuario' value='$idUsuario'> " .
            "<input type='hidden' name='idGrupo' value='$idGrupo'> " .
            "<input type='hidden' name='nomeGrupo' value='$nomeGrupo'> " .
            "<input type='submit' onclick='return btSairGrupo($podeSair)' class='btn btn-danger btn-block' value='Sair' />" .
            "</form>" .
            "</td>";
            echo "</tr>";
        }
    }

    public static function escreveMsg($params) {
        if (isset($params["msg"])) {
            $msg = $params["msg"];
            if ($msg == "grupo_cadastrado") {
                $msg = "Grupo <strong>" . $params["nome"] . "</strong> cadastrado com sucesso";
            } else if ($msg == "saiu_grupo") {
                $msg = "Você saiu do grupo <strong>" . $params["nome"] . "</strong>";
            }
            echo "<div class='alert alert-info alert-dismissable'>" .
            "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>" .
            $msg .
            "</div>";
        }
    }

}
