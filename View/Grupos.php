<?php
include "../ScriptLogin.php";
require_once './ControlesView/ControleViewGrupos.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Glide</title>

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

        <!-- DataTables -->
        <link href="Componentes/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">
        <script src="Componentes/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
        <script src="Componentes/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

        <script>
            $(function () {
                $('#dataTableGrupos').DataTable({
                    responsive: true
                });
            });
            
            function btSairGrupo(podeSair) {
                if (podeSair == 0) {
                    $('#modalGrupoAviso').modal('show');
                    return false;
                } else {
                    return true;
                }
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
                            <h1 class="page-header">Gerenciador de grupos</h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->

                    <?php ControleViewGrupos::escreveMsg($_GET) ?>

                    <!-- Tabela Grupo -->
                    <div class="row">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Meus Grupos
                            </div>
                            <!-- /.panel-heading -->

                            <div class="panel-body">
                                <div class="dataTable_wrapper">
                                    <table class="table table-striped table-bordered table-hover" id="dataTableGrupos">
                                        <thead>
                                            <tr>
                                                <th width="80%">Grupo</th>
                                                <th>Sair</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php ControleViewGrupos::escreveGruposUsuario($usuario->getId()); ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /TabelaGrupo -->
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /#page-wrapper -->
        </div>
        <!-- /#wrapper -->

        <!-- modal Grupo Aviso -->
        <div class="modal fade" id="modalGrupoAviso" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        Aviso
                    </div>
                    <div class="modal-body ">
                        Você é o único administrador desse grupo, deixe alguém como administrador para sair.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Okay</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- /. Modal Grupo Aviso -->

    </body>

</html>
