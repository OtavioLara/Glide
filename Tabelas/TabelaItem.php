<?php

class TabelaItem {

    const nomeTabela = "item";
    const id = "Id";
    const idConta = "IdDespesa";
    const nome = "Nome";
    const valor = "Valor";

    public static function getAliasesItem() {
        return [
            TabelaItem::id => "IdItem",
            TabelaItem::nome => "NomeItem",
            TabelaItem::valor => "ValorItem",
        ];
    }

}
