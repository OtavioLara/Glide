<?php

class TabelaIntegrantesItem {

    const nomeTabela = "Distribuicao";
    const idContaItem = "IdItem";
    const idUsuario = "IdUsuario";
    const valor = "Valor";

    public static function getAliasesDistribuicao() {
        return [
            TabelaIntegrantesItem::valor => "ValorDistribuicao",
        ];
    }

}

?>
