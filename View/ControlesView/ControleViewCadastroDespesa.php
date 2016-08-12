<?php

class ControleViewCadastroDespesa {

    static public function escreveGruposDoUsuario($grupos) {
        foreach ($grupos as $grupo) {
            $idGrupo = $grupo->getId();
            echo "<option id='grupo$idGrupo' >".$grupo->getNome()."</option>";
        }
    }

}
