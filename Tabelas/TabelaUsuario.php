<?php

class TabelaUsuario {

    const nomeTabela = "Usuario";
    const id = "Id";
    const email = "Email";
    const nome = "Nome";
    const senha = "Senha";
    const username = "Username";

    public static function getAliasesUsuario() {
        return [
            TabelaUsuario::nome => "Nome",
            TabelaUsuario::username => "Username",
            TabelaUsuario::email => "Email",
            TabelaUsuario::senha => "Senha",
            TabelaUsuario::id => "Id"
        ];
    }

    public static function getAliasesUsuarioDistribuicao() {
        return [
            TabelaUsuario::nome => "NomeUsuarioDistribuicao",
            TabelaUsuario::username => "UsernameDistribuicao",
            TabelaUsuario::email => "EmailDistribuicao",
            TabelaUsuario::senha => "SenhaDistribuicao",
            TabelaUsuario::id => "IdUsuarioDistribuicao"
        ];
    }

    public static function getAliasesUsuarioIntegranteGrupo() {
        return [
            TabelaUsuario::nome => "NomeIntegranteGrupo",
            TabelaUsuario::username => "UsernameIntegranteGrupo",
            TabelaUsuario::email => "EmailIntegranteGrupo",
            TabelaUsuario::senha => "SenhaIntegranteGrupo",
            TabelaUsuario::id => "IdIntegranteGrupo"
        ];
    }
    
    public static function getAliasesUsuarioIntegranteDespesa() {
        return [
            TabelaUsuario::nome => "NomeIntegranteConta",
            TabelaUsuario::username => "UsernameIntegranteConta",
            TabelaUsuario::email => "EmailIntegranteConta",
            TabelaUsuario::senha => "SenhaIntegranteConta",
            TabelaUsuario::id => "IdIntegranteConta"
        ];
    }

}

?>
