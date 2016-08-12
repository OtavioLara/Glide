<?php

class TabelaIntegranteGrupo {

    const nomeTabela = "integrantes_grupo";
    const id = "Id";
    const idGrupo = "IdGrupo";
    const idUsuario = "IdUsuario";
    const administrador = "Administrador";

    public static function getAliasesIntegranteGrupo() {
        return [
            TabelaIntegranteGrupo::administrador => "Administrador"
        ];
    }

}
