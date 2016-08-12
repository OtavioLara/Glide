<?php

require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'IntegranteGrupo.php';

class Grupo {

    private $nome;
    private $integrantesGrupo; // array de IntegranteGrupo
    private $contas;
    private $id;

    public function Grupo($nome, $id = null, $integrantesGrupo = null, $contas = null) {
        $this->setNome($nome);
        $this->setId($id);
        $this->setIntegrantesGrupo($integrantesGrupo);
        $this->setContas($contas);
    }

    public function isUsuarioPodeSair($idUsuario){
        if(count($this->integrantesGrupo) > 1 && $this->possuiIntegrante($idUsuario)){
            $integrante = $this->getIntegranteGrupo($idUsuario);
            if($integrante->isAdmin() && $this->getTotalAdministradores() == 1){
                return false;
            }
        }
        return true;
    }
    
    public function getTotalAdministradores(){
        $total = 0;
        foreach($this->integrantesGrupo as $integrante){
            if($integrante->isAdmin()){
                $total++;
            }
        }
        return $total;
    }
    public function possuiIntegrante($idUsuario) {
        return isset($this->integrantesGrupo[$idUsuario]);
    }

    public function adicionaIntegrante(Integrante $integrante) {
        $idUsuario = $integrante->getPessoa()->getId();
        $this->integrantesGrupo[$idUsuario] = $integrante;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getContas() {
        return $this->contas;
    }

    private function setContas($contas) {
        if (isset($contas)) {
            $this->contas = $contas;
        } else {
            $this->contas = array();
        }
    }

    public function getNome() {
        return $this->nome;
    }

    private function setNome($nome) {
        $this->nome = $nome;
    }

    public function getIntegranteGrupo($idUsuario){
        if($this->possuiIntegrante($idUsuario)){
            return $this->integrantesGrupo[$idUsuario];
        }else{
            return null;
        }
    }
    
    public function getIntegrantesGrupo() {
        return $this->integrantesGrupo;
    }

    private function setIntegrantesGrupo($integrantesGrupo) {
        if (isset($integrantesGrupo)) {
            $this->integrantesGrupo = $integrantesGrupo;
        } else {
            $this->integrantesGrupo = array();
        }
    }

}
