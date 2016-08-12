<?php
include "../ScriptLogin.php";
?>
<!DOCTYPE html>
<html lang="en">
    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Finanças Genérica - Grupos</title>

        <style>
            .dropdown-menu {
                max-height: 390px;
                overflow-y: scroll;
            }
        </style>
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


        <!-- Usuário -->
        <script src="jsFinancas/Usuario.js"></script>

        <script>
            $(function () {
   
                $("#btAdicionarIntegrante").click(function () {
                    var username = $("#integranteParaAdicionar").val();
                    $("#carregandoUsuario").html("Procurando usuário...");
                    $("#modalAdicionarIntegranteAlerta").html("");
                    var funcao = function (usuario) {
                        if (usuario !== false) {
                            adicionaIntegrante(usuario);
                            $('#modalAdicionarIntegrante').modal('hide');
                        } else {
                            var divAlerta = "<div class='alert alert-danger'>" +
                                    "O usuário não foi encontrado" +
                                    "</div>";
                            $("#modalAdicionarIntegranteAlerta").html(divAlerta);
                        }
                        $("#carregandoUsuario").html("");
                    }
                    Usuario.getUsuarioPorUsername(username, funcao);
                });

                $("#btCancelarIntegrante").click(function () {
                    $("#modalAdicionarIntegranteAlerta").html("");
                });

            });

            function adicionaIntegrante(usuario) {
                var inputId = "<input type='hidden' name='integrantesNovoGrupo[]' value='" + usuario.id + "'/>";
                var novaLinha = "<tr>" +
                        "<td>" + usuario.nome + "</td>" +
                        "<td>" + usuario.username + "</td>" +
                        "<td> <button class='btn btn-default' onclick='clickBtRemoverIntegrante(this)'>Remover</button></td>" +
                        inputId +
                        "</tr>";
                $("#integrantesNovoGrupo").append(novaLinha);
            }
            function clickBtRemoverIntegrante(bt) {
                var td = bt.parentNode;
                var tr = td.parentNode;
                var table = tr.parentNode;
                table.removeChild(tr);
            }

        </script>

    </head>

    <body>
        <div id="wrapper">
            <?php include "./menu.php"; ?>

            <!-- Page Content -->
            <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">Criar Grupo</h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->

                    <form action="ControlesScript/ControleGrupoScript.php" id="formCadastrarGrupo" method="post">
                        <input type="hidden" name="comando" value="cadastrarGrupo" />
                        <input type="hidden" name="idCriador" value="<?php echo $usuario->getId(); ?>" />
                        <div class="row">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Criar Grupo
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class=" col-md-12 form-horizontal">
                                            <label class="control-label col-md-1" for="nome">Nome:</label>
                                            <div class="col-md-11">
                                                <input type="text" class="form-control" name="nomeGrupo" required>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-7">
                                            <table class="table" >
                                                <thead>
                                                    <tr>
                                                        <th width="50%">Nome</th>
                                                        <th>Username</th>
                                                        <th>Remover</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="integrantesNovoGrupo">
                                                    <tr>
                                                        <td><?php echo $usuario->getNome(); ?></td>
                                                        <td>
                                                            <?php echo $usuario->getUsername(); ?>
                                                            <input type="hidden" name="integrantesNovoGrupo[]" value="<?php echo $usuario->getId(); ?>"/>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <input type="button" class="btn btn-default" data-toggle="modal" data-target="#modalAdicionarIntegrante"  value='Adicionar integrante' />
                                    <center><input type="submit" class="btn btn-default" value="Cadastrar grupo" id="btCadastrarGrupo" form="formCadastrarGrupo"/></center>

                                </div>
                            </div>

                        </div>
                        <!-- /.col-md-12 -->
                    </form>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /#page-wrapper -->
        </div>
        <!-- /#wrapper -->


        <!-- Modal de integrates grupo -->
        <div class="modal fade" id="modalAdicionarIntegrante" tabindex="-1" role="dialog" 
             aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">
                            Adicionar integrante
                        </h4>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body">
                        <div id="modalAdicionarIntegranteAlerta"></div>
                        <div class="form-group">
                            <label for="integranteParaAdicionar">Username do usuário:</label>
                            <input type="text" class="form-control" id="integranteParaAdicionar" placeholder="Username"/>
                        </div>
                        <div id="carregandoUsuario"></div>
                    </div>

                    <!-- Modal Footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default"
                                data-dismiss="modal" id="btCancelarIntegrante">
                            Cancelar
                        </button>
                        <button type="button" class="btn btn-primary" id="btAdicionarIntegrante">
                            Adicionar
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- .Modal -->

    </body>

</html>
