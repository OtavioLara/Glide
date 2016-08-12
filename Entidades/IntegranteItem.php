<?php
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'IntegranteValor.php';

class IntegranteItem extends IntegranteValor{
    
    public function IntegranteItem(Pessoa $pessoa, $valor){
        parent::IntegranteValor($pessoa, $valor);
    }
    
}
