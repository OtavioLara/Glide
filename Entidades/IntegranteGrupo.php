<?php
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'Integrante.php';
class IntegranteGrupo extends Integrante{

    private $admin;
    
    public function IntegranteGrupo(Pessoa $pessoa, $admin = false) {
        parent::Integrante($pessoa);
        $this->setAdmin($admin);
    }
    
    public function isAdmin(){
        return $this->admin;
    }
    
    private function setAdmin($admin){
        $this->admin = $admin;
    }
}
