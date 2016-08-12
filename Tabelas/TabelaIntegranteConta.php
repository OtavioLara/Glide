<?php

class TabelaIntegranteConta {

    const nomeTabela = "IntegranteConta";
    const idUsuario = "IdUsuario";
    const idConta = "IdConta";
    const valorDeEntrada = "ValorDeEntrada";
    const valorTotal = "ValorTotal";
    const valorPago = "ValorPago";

    public static function getAliasesIntegranteConta() {
        return [
            TabelaIntegranteConta::valorDeEntrada => "ValorDeEntrada",
            TabelaIntegranteConta::valorTotal => "ValorTotal",
            TabelaIntegranteConta::valorPago => "ValorPago"
        ];
    }

}
