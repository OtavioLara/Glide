<?php
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'Item.php';
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'IntegranteItem.php';

class ItemConjunto extends Item {

    private $integrantesItem; //Array de IntegranteItem

    public function ItemConjunto($nome, $valor, $integrantesItem = null, $id = null) {
        parent::Item($nome, $valor, $id);
        $this->setIntegrantesItem($integrantesItem);
    }

    public function adicionaUsuario(IntegranteItem $integranteItem) {
        $this->integrantesItem[$integranteItem->getPessoa()->getId()] = $integranteItem;
    }

    public function possuiUsuario($idUsuario) {
        return isset($this->integrantesItem[$idUsuario]);
    }

    public function getIntegrantesItem() {
        return $this->integrantesItem;
    }

    private function setIntegrantesItem($integrantesItem) {
        if (isset($integrantesItem)) {
            $this->integrantesItem = $integrantesItem;
        } else {
            $this->integrantesItem = array();
        }
    }

}

?>
