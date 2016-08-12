<?php

class TabelaConta {

    const nomeTabela = "despesa";
    const id = "Id";
    const nome = "Nome";
    const valor = "ValorTotal";
    const idRepublica = "IdGrupo";
    const data = "Data";
    const dataAlerta = "DataAlerta";
    const descAdicional = "DescricaoAdicional";

    public static function getAliasesConta() {
        return [
            TabelaConta::id => "IdConta",
            TabelaConta::nome => "NomeConta",
            TabelaConta::valor => "ValorConta",
            TabelaConta::data => "DataConta",
            TabelaConta::dataAlerta => "DataAlerta",
            TabelaConta::descAdicional => "DescricaoAdicional",
        ];
    }

}
