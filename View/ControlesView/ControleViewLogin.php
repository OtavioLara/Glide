<?php

class ControleViewLogin {

    public static function getMsg($params) {
        if (isset($params["msg"])) {
            $msg = $params["msg"];
            if ($msg == "cadastro_sucesso") {
                $msg = "Cadastro feito com sucesso";
                $classeDiv = "alert alert-info";
            } else if ($msg == "login_falha") {
                $msg = "Username ou senha incorreta(s)";
                $classeDiv = "alert alert-danger";
            }
            if (isset($classeDiv)) {
                return "<div class='row'>" .
                        "  <div class='col-md-10'>" .
                        "    <div class='$classeDiv'> $msg </div>" .
                        "  </div>" .
                        "</div>";
            }
        }
        return "";
    }

}
