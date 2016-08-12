<?php

class TabelaGrupo {

    const nomeTabela = "grupo";
    const id = "Id";
    const nome = "Nome";

    public static function getAliasesGrupo() {
        return [
            TabelaGrupo::id => "Id",
            TabelaGrupo::nome => "Nome"
        ];
    }

}
