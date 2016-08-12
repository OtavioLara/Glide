<?php

class Aliase {

    private $aliases;

    public function Aliase($aliases = array()) {
        $this->setAliases($aliases);
    }

    public function getAliase($chave) {
        if (isset($this->aliases[$chave])) {
            return $this->aliases[$chave];
        } else {
            return null;
        }
    }

    private function setAliases($aliases) {
        $this->aliases = $aliases;
    }

}
