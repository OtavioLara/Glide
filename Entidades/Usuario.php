<?php

require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'Pessoa.php';

class Usuario extends Pessoa implements JsonSerializable {

    private $username;
    private $email;
    private $id;

    public function Usuario($nome, $username, $email, $id = null) {
        parent::Pessoa($nome, $id);
        $this->setUsername($username);
        $this->setEmail($email);
    }

    public function getUsername() {
        return $this->username;
    }

    private function setUsername($username) {
        $this->username = $username;
    }

    public function getEmail() {
        return $this->email;
    }

    private function setEmail($email) {
        $this->email = $email;
    }

    public function jsonSerialize() {
        $atributos = array(
            "id" => $this->getId(),
            "nome" => $this->getNome(),
            "email" => $this->getEmail(),
            "username" => $this->getUsername()
        );
        return json_encode($atributos);
    }

}
