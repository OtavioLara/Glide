<?php
require_once './ControlesView/ControleViewLogin.php';
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Finanças Genérica</title>

        <!-- Bootstrap Core CSS -->
        <link href="Componentes/bower_components/bootstrap/dist/css/bootstrap.css" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="Componentes/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="Componentes/dist/css/sb-admin-2.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="Componentes/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

        <script src="Componentes/bower_components/jquery/dist/jquery.min.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="Componentes/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="Componentes/bower_components/metisMenu/dist/metisMenu.min.js"></script>

        <!-- Custom Theme JavaScript -->
        <script src="Componentes/dist/js/sb-admin-2.js"></script>

        <script src="Componentes/js/matchHeight.js"></script>

        <style>
            .divLogin{
                background-color: #547980;   
            }
            .frase{
                font-size: 25px;
                padding-left: 5px;
            }
            .borda {
                border-radius: 25px;
                border: 2px solid #73AD21;
            }

            .container-principal{
                margin-top: 75px;
            }

            body{
                background-color: #E0E4CC;  
            }



        </style>

        <script>
            var modo = "login";

            function btChange() {
                if (modo == "login") {
                    modo = "cadastro";
                    document.getElementById("divLogin").innerHTML = geraFormCadastro();
                } else {
                    modo = "login";
                    document.getElementById("divLogin").innerHTML = geraFormLogin();
                }
            }

            function geraFormLogin() {
                var form = "<br>" +
                        "<form action='ControlesScript/ControleUsuarioScript.php' method='post'>" +
                        "<input type='hidden' value='login' name='comando' />" +
                        "<div class='form-group'>" +
                        "  <div class='input-group col-md-10'>" +
                        "    <input class = 'form-control' name='username' type = 'text' placeholder = 'Username' required >" +
                        "  </div>" +
                        "</div>" +
                        "<div class = 'form-group' >" +
                        "  <div class = 'input-group col-md-10' >" +
                        "    <input class = 'form-control' name='senha' type = 'password' placeholder = 'Senha' required >" +
                        "  </div>" +
                        "</div>" +
                        "<div class = 'form-group' >" +
                        "  <div class = 'col-md-4' >" +
                        "    <input type = 'submit' class = 'btn btn-success' value = 'Entre' / >" +
                        "  </div>" +
                        "  <div class = 'col-md-3 col-md-offset-1' >" +
                        "    <button type='button' class='btn btn-default' onclick='btChange()' > ou Cadastre-se </button>" +
                        "  </div>" +
                        "  <br/><br/>" +
                        "</div>" +
                        "</form>";
                return form;
            }
            function geraFormCadastro() {
                var form = "<br>" +
                        "<form action='ControlesScript/ControleUsuarioScript.php' method='post'>" +
                        "<input type='hidden' value='cadastrarUsuario' name='comando' />" +
                        "<div class='form-group'>" +
                        "  <div class='input-group col-md-10'>" +
                        "    <input class = 'form-control' name='username' type = 'text' placeholder = 'Username' required >" +
                        "  </div>" +
                        "</div>" +
                        "<div class='form-group'>" +
                        "  <div class='input-group col-md-10'>" +
                        "    <input class = 'form-control' name='nome' type = 'text' placeholder = 'Nome' required >" +
                        "  </div>" +
                        "</div>" +
                        "<div class='form-group'>" +
                        "  <div class='input-group col-md-10'>" +
                        "    <input class = 'form-control' name='email' type = 'text' placeholder = 'E-mail' required >" +
                        "  </div>" +
                        "</div>" +
                        "<div class = 'form-group' >" +
                        "  <div class = 'input-group col-md-10' >" +
                        "    <input class = 'form-control' name='senha' type = 'password' placeholder = 'Senha' required >" +
                        "  </div>" +
                        "</div>" +
                        "<div class='form-group'>" +
                        "  <div class='input-group col-md-10'>" +
                        "    <input class = 'form-control' type = 'password' placeholder = 'Confirmação da senha' required >" +
                        "  </div>" +
                        "</div>" +
                        "<div class = 'form-group' >" +
                        "  <div class = 'col-md-4' >" +
                        "    <input type = 'submit' class = 'btn btn-primary' value = 'Cadastrar' />" +
                        "  </div>" +
                        "  <div class = 'col-md-2 col-md-offset-1' >" +
                        "    <button type = 'button' class = 'btn btn-default' onclick='btChange()' > ou Entrar </button>" +
                        "  </div>" +
                        "  <br/><br/>" +
                        "</div>" +
                        "</form>";
                return form;
            }


        </script>
    </head>
    <body>


        <div class="container container-principal">
            <div class="row">
                <div class="row">
                    <center>
                        <h1>Finanças Genérica</h1>    
                    </center>
                    <div class="login-panel">       
                        <div class='col-md-3 col-md-offset-3 divLogin' id='divLogin'>
                            <form action="ControlesScript/ControleUsuarioScript.php" method='post'>
                                <input type="hidden" name="comando" value="login" />
                                <br>
                                <?php echo ControleViewLogin::getMsg($_GET); ?>
                                <div class='form-group'>
                                    <div class='input-group col-md-10'>
                                        <input class = 'form-control' name='username' type='text' placeholder = 'Username' required >
                                    </div>
                                </div>
                                <div class = 'form-group' >
                                    <div class = 'input-group col-md-10' >
                                        <input class = 'form-control' name='senha' type = 'password' placeholder = 'Senha' required >
                                    </div>
                                </div>
                                <div class = 'form-group' >
                                    <div class = 'col-md-4' >
                                        <input type = 'submit' class = 'btn btn-success' value = 'Entre' /> 
                                    </div>
                                    <div class = 'col-md-3' >
                                        <button type='button' class='btn btn-default' onclick='btChange()' > ou Cadastre-se </button>
                                    </div>
                                    <br/><br/>
                                </div>
                            </form>
                        </div>


                        <div class="col-md-3">
                            <div class="col-md-12">
                                <span class='glyphicon glyphicon-ok' style="font-size: 1.5em" ></span> 
                                <font class="frase" >Funcionalidade 1</font>
                            </div>
                            <div class="col-md-12">
                                <span class='glyphicon glyphicon-ok' style="font-size: 1.5em" ></span> 
                                <font class="frase" >Funcionalidade 2</font>
                            </div>
                            <div class="col-md-12">
                                <span class='glyphicon glyphicon-ok' style="font-size: 1.5em" ></span> 
                                <font class="frase" >Funcionalidade 3</font>
                            </div>
                            <div class="col-md-12">
                                <span class='glyphicon glyphicon-ok' style="font-size: 1.5em" ></span> 
                                <font class="frase" >Funcionalidade 4</font>
                            </div>
                            <div class="col-md-12">
                                <span class='glyphicon glyphicon-ok' style="font-size: 1.5em" ></span> 
                                <font class="frase" >Funcionalidade 5</font>
                            </div>
                        </div>

                        <!-- ./ login Panel -->
                    </div>
                    <!-- ./row Login -->
                </div>

            </div>
        </div>



    </body>
</html>
