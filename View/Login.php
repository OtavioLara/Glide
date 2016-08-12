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

        <title>Glide</title>

        <!-- Bootstrap Core CSS -->
        <link href="Componentes/bower_components/bootstrap/dist/css/bootstrap.css" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="Componentes/dist/css/sb-admin-2.css" rel="stylesheet">

        <script src="Componentes/bower_components/jquery/dist/jquery.min.js"></script>
        <script src="Componentes/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>


        <link href="css/bootstrap-dialog.css" rel="stylesheet">
        <script src="js/bootstrap-dialog.js"></script>

        <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap3-dialog/1.34.5/css/bootstrap-dialog.min.css" rel="stylesheet" type="text/css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap3-dialog/1.34.5/js/bootstrap-dialog.min.js"></script>  

        <script>
            
            BootstrapDialog.show({
                title: 'Example',
                message: 'Write your example here.',
                buttons: [{
                        label: 'Close',
                        action: function (dialog) {
                            dialog.close();
                        }
                    }]
            });
            alert('hi');

        </script>
        <style>
            .divLogin{
                background-color: #547980;   
            }
            .divFuncionalidades{
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
                        "    <input class = 'form-control' name='email' type = 'email' placeholder = 'E-mail' required >" +
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
                        <h1 style="font-size: 6em; font-family: 'Trebuchet MS', Helvetica, sans-serif">Glide</h1>
                        <h2>O seu gerenciador de finanças</h2>
                    </center>
                    <div class="login-panel">       
                        <div class='col-md-3 col-md-offset-3 divLogin' id='divLogin'>
                            <form action="ControlesScript/ControleUsuarioScript.php" method='post'>
                                <input type="hidden" name="comando" value="login" />
                                <br/>
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


                        <div class="col-md-6">
                            <div class="col-md-12">
                                <span class='glyphicon glyphicon-ok' style="font-size: 1.5em" ></span> 
                                <font class="frase" >Mantenha histórico de seus gastos</font>
                            </div>
                            <div class="col-md-12">
                                <span class='glyphicon glyphicon-ok' style="font-size: 1.5em" ></span> 
                                <font class="frase" >Registre suas compras e pagamentos</font>
                            </div>
                            <div class="col-md-12">
                                <span class='glyphicon glyphicon-ok' style="font-size: 1.5em" ></span> 
                                <font class="frase" >Faça divisão de gastos entre pessoas</font>
                            </div>
                            <div class="col-md-12">
                                <span class='glyphicon glyphicon-ok' style="font-size: 1.5em" ></span> 
                                <font class="frase" >Não perca tempo calculando valores</font>
                            </div>
                            <div class="col-md-12">
                                <span class='glyphicon glyphicon-ok' style="font-size: 1.5em" ></span> 
                                <font class="frase" >Mantenha-se informado sobre dívidas</font>
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
