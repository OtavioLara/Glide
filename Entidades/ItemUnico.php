<?php
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'Item.php';
class ItemUnico extends Item{
    
    public function ItemUnico($nome, $valor){
        parent::Item($nome, $valor);
    }
}
