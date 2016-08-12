<?php

require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Entidades' . DIRECTORY_SEPARATOR . 'Grupo.php';
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Entidades' . DIRECTORY_SEPARATOR . 'IntegranteGrupo.php';
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Entidades' . DIRECTORY_SEPARATOR . 'Usuario.php';
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'BD' . DIRECTORY_SEPARATOR . 'GrupoDAO.php';

class ControleGrupo {

    public static function cadastrarGrupo($params) {
        $nome = $params["nomeGrupo"];
        $idCriador = $params["idCriador"];
        $integrantes = array();
        foreach ($params["integrantesNovoGrupo"] as $idIntegrante) {
            $usuario = new Usuario("", "", "", $idIntegrante);
            $admin = ($idIntegrante == $idCriador);
            $integrantes[$idIntegrante] = new IntegranteGrupo($usuario, $admin);
        }
        $grupo = new Grupo($nome, null, $integrantes);
        GrupoDAO::insereGrupo($grupo);
        return true;
    }

    public static function sairGrupo($params) {
        if (isset($params["idUsuario"]) && isset($params["idGrupo"])) {
            $idUsuario = $params["idUsuario"];
            $idGrupo = $params["idGrupo"];
            $grupo = GrupoDAO::getGrupoCompletoPorId($idGrupo);
            if ($grupo->isUsuarioPodeSair($idUsuario)) {
                GrupoDAO::removeIntegranteGrupo($idUsuario, $idGrupo);
                return true;
            }
        }
        return false;
    }

}
