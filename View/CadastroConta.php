<?php
include "../ScriptLogin.php";
require_once './ControlesView/ControleViewCadastroDespesa.php';
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

        <!-- JS Glide -->
        <script src="jsFinancas/Usuario.js"></script>
        <script src="jsFinancas/Util.js"></script>

        <style>
            .checkbox-inline.no_indent,
            .checkbox-inline.no_indent+.checkbox-inline.no_indent {
                margin-left: 0;
                margin-right: 10px;
            }
            .checkbox-inline.no_indent:last-child {
                margin-right: 0;
            }
        </style>
        <script>

            $(function () {
                $("#btAdicionaItem").click(function () {
                    /* Obtem dados dos itens */
                    var nomeItem = $("#nomeItem").val();
                    var valorUnit = parseFloat($("#valorItem").val());
                    var qtdItem = parseInt($("#qtdItem").val());
                    var valorTotal = Util.multiplica(valorUnit, qtdItem);

                    /* Obtem os usuários do item e realiza a distribuição */
                    var checkBoxIntegrantesItem = $("input[name='integrantesDespesa[]']:checked");
                    var distribuicao = Util.geraDistribuicao(valorTotal, checkBoxIntegrantesItem.length, 0);
                    var integrantesItem = [];
                    for (var i = 0; i < checkBoxIntegrantesItem.length; i++) {
                        var atributosUsuario = checkBoxIntegrantesItem[i].value.split(";");
                        integrantesItem[i] = {id: atributosUsuario[0], nome: atributosUsuario[1], valor: distribuicao[i]};
                    }

                    /* Cria Item */
                    var item = {nome: nomeItem, valor: valorUnit, qtd: qtdItem, integrantes: integrantesItem};

                    /* Adiciona item na tabela */
                    adicionaItem(item);
                });

                function adicionaItem(item) {
                    var html = "<tr><td>" + item.nome + "</td>";
                    html += "<td>" + item.qtd + "</td>";
                    html += "<td> R$ " + item.valor + "</td>";
                    var htmlDistribuicao = "<td><ul>";
                    var integrantes = item.integrantes;
                    for (var i = 0; i < integrantes.length; i++) {
                        htmlDistribuicao += "<li>" + integrantes[i].nome + ": R$ " + integrantes[i].valor + "</li>" +
                                "<input type='hidden' name='idIntegranteItem[]' value='" + integrantes[i].id + "' />" +
                                "<input type='hidden' name='valorIntegranteItem[]' value='" + integrantes[i].valor + "' />";
                    }
                    htmlDistribuicao += "</ul></td>";
                    html += htmlDistribuicao;
                    html += "<td><input type='button' onclick='removeLinha(this)' value='remover' /></td>";
                    html += "<input type='hidden' name='totalIntegrantes[]' value='" + integrantes.length + "' />";
                    html += "<input type='hidden' name='nomeItem[]' value='" + item.nome + "' />";
                    html += "<input type='hidden' name='valorItem[]' value='" + item.valor + "' />";
                    html += "<input type='hidden' name='qtdItem[]' value='" + item.qtd + "' />";
                    html += "</tr>";
                    $("#tabelaItens").append(html);
                }

                $("#btAdicionaContribuinte").click(function () {
                    var contribuinteSelecionado = $("#selectContribuinte option:selected");
                    var atributosUsuario = contribuinteSelecionado.attr("value").split(";");
                    var idContribuinte = atributosUsuario[0];
                    var nomeContribuinte = atributosUsuario[1];
                    var valorDeEntrada = $("#valorDeEntrada").val();
                    if (idContribuinte > 0) {
                        adicionaContribuinte({nome: nomeContribuinte, id: idContribuinte}, valorDeEntrada);
                    }
                });

                function adicionaContribuinte(usuario, valorDeEntrada) {
                    var html = "<tr>" +
                            "<td>" + usuario.nome + "</td>" +
                            "<td>" + valorDeEntrada + "</td>" +
                            "<td><input type='button' value='remover' onclick='removeLinha(this)' /></td>" +
                            "<input type='hidden' name='idContribuinte[]' value='" + usuario.id + "' />" +
                            "<input type='hidden' name='valorContribuicao[]' value='" + valorDeEntrada + "' />" +
                            "</tr>";
                    $("#valorDeEntrada").val("");
                    $("#tabelaContribuintes").append(html);
                }

                $("#gruposUsuario").change(function () {
                    var grupoSelecionado = $("#gruposUsuario option:selected");
                    var idGrupoSelecionado = grupoSelecionado.attr("id");
                    idGrupoSelecionado = parseInt(idGrupoSelecionado.replace("grupo", ""));
                    if (idGrupoSelecionado > 0) {
                        var nomeGrupoSelecionado = grupoSelecionado.text();
                        carregaUsuariosDoGrupo(idGrupoSelecionado, nomeGrupoSelecionado);
                    } else {
                        $("#integrantesGrupo").html("");
                    }

                });

                $("#btSelecionaGrupo").click(function () {
                    var integrantesDespesa = $("input[name='filtro[]']:checked");
                    var htmlSelect = "<option>Selecione um contribuinte</option>";
                    var htmlItem = "";
                    for (var i = 0; i < integrantesDespesa.length; i++) {
                        var valor = integrantesDespesa[i].value;
                        var valores = valor.split(";");
                        var nomeUsuario = valores[1];
                        htmlItem += "<div class='col-md-3'>" +
                                "<label class='checkbox-inline no_indent'>" +
                                "<input type='checkbox' name='integrantesDespesa[]' value='" + valor + "' checked>" + nomeUsuario +
                                "</label>" +
                                "</div>";
                        htmlSelect += "<option value='" + valor + "'>" + nomeUsuario + "</option>";
                    }
                    var grupoSelecionado = $("#gruposUsuario option:selected");
                    var idGrupoSelecionado = grupoSelecionado.attr("id");
                    idGrupoSelecionado = parseInt(idGrupoSelecionado.replace("grupo", ""));
                    $("#idGrupo").val(idGrupoSelecionado);
                    $("#selectContribuinte").html(htmlSelect);
                    $("#listaIntegrantesItem").html(htmlItem);
                    $("#modalSelecionaGrupo").modal("hide");
                });

                function carregaUsuariosDoGrupo(idGrupo, nomeGrupo) {
                    $("#integrantesGrupo").html("Carregando integrantes do grupo " + nomeGrupo);
                    var f = function (usuarios) {
                        var html = "<legend> Selecione os integrantes que participaram da despesa:</legend>" +
                                "<div class='row'>";
                        for (var i = 0; i < usuarios.length; i++) {
                            var valorCheckBox = usuarios[i].id + ";" + usuarios[i].nome;
                            html += "<div class='col-md-3'>" +
                                    "<label class='checkbox-inline no_indent'>" +
                                    "<input type='checkbox' name='filtro[]' value='" + valorCheckBox + "' checked>" + usuarios[i].nome +
                                    "</label>" +
                                    "</div>";
                        }
                        html += "</div>";
                        $("#integrantesGrupo").html(html);
                    }
                    Usuario.getUsuariosDoGrupo(idGrupo, f);
                }
            });

            function removeLinha(bt) {
                var cell = bt.parentNode;
                var linha = cell.parentNode;
                var tabela = linha.parentNode;
                tabela.removeChild(linha);
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
                            <h1 class="page-header">Cadastro Despesa</h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->

                    <form action="ControlesScript/ControleDespesaScript.php" method="post">
                        <input type='hidden' value='cadastrarDespesa' name='comando' />
                        <!-- Informações da conta -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    Informações da despesa
                                </h4>
                            </div>
                            <div class="panel-body">
                                <div class="row form-group">
                                    <div class="col-md-12 " >
                                        <label class="control-label" for="nomeConta">Nome da despesa: </label>
                                        <input type="text" class="form-control" id="nomeConta" name="nomeConta" value="" />
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-md-3">
                                        <label>Data: </label>
                                        <input type="date" class="form-control" name="dataConta" value=""/>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Data alerta:
                                            <a href="#" data-toggle="tooltip" data-placement="top" 
                                               title="A partir de qual data os integrantes devedores desta despesa
                                               serão notificados regularmente da dívida"
                                               >
                                                <font style="padding-left: 1.5em;" size="2">O que é isso?</font>
                                            </a>
                                        </label>
                                        <input type="date" class="form-control" name="dataAlerta" />
                                    </div>
                                    <div class="col-md-6">
                                        <label>Grupo:</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="nomeGrupo" value=""  readonly>
                                            <input type="hidden" id="idGrupo" name="idGrupo" value='-1'/>
                                            <span class="input-group-btn">
                                                <button class="btn btn-default" type="button"  data-toggle="modal" data-target="#modalSelecionaGrupo">Selecionar grupo</button>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <div class="col-md-12">
                                        <label>Informações adicionais:</label>
                                        <textarea class="form-control" rows="5" id="comment" name="informacoesAdicionais"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>




                        <!-- ./Informações da conta -->


                        <!-- Proprietários -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="panel-title">
                                    Contribuintes
                                    <label>
                                        <a href="#" data-toggle="tooltip" data-placement="top" 
                                           title="Contribuientes são as pessoas que já contribuiram com uma quantia
                                           de dinheiro até o momento"
                                           >
                                            <font style="padding-left: 1.5em;" size="2">O que é isso?</font> 
                                        </a>
                                    </label>
                                </div>

                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="form-group">
                                        <div class="col-md-4">
                                            <label>Integrante: </label>
                                            <select class="form-control" id='selectContribuinte'>
                                                <option value='-1;-1;'>Selecione um contribuinte</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <label>Valor: </label>
                                            <input type="text" id='valorDeEntrada' class="form-control" placeholder="R$">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="btAdicionaContribuinte">&nbsp;</label>
                                            <input type="button" class="btn btn-success form-control" id="btAdicionaContribuinte" value="Adicionar" />
                                        </div>


                                        <div class="col-md-12">
                                            <table class="table" id="tabelaContribuintes" >
                                                <thead>
                                                    <tr>
                                                        <th width="30%">Nome</th>
                                                        <th width="30%">Valor</th>
                                                        <th>Remover</th>
                                                    </tr>
                                                </thead>
                                                <tbody id='tabelaProprietarios'>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ./ Proprietários -->

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    Itens da despesa
                                </h4>
                            </div>
                            <div class="panel-body">
                                <!-- Itens da conta -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="col-md-4">
                                                <label>Nome item: </label>
                                                <input type="text" class="form-control" id="nomeItem">
                                            </div>
                                            <div class="col-md-2">
                                                <label>Quantidade: </label>
                                                <input type="number" class="form-control" id="qtdItem">
                                            </div>
                                            <div class="col-md-2">
                                                <label>Valor Unit: </label>
                                                <input type="text" class="form-control" placeholder="R$" id="valorItem">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="btAdicionaItem">&nbsp;</label>
                                                <input type="button" class="btn btn-success form-control" id="btAdicionaItem" value="Adicionar" />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Integrantes Distribuição -->
                                <br/>
                                Integrantes do grupo que participaram da compra deste item:
                                <div class="row" id="listaIntegrantesItem">

                                </div>
                                <!-- ./Integrantes Distribuição -->
                                <br/>
                                <div class="row">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <strong>Total: R$ <span id="valorTotalItens"></span></strong>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table" >
                                            <thead>
                                                <tr>
                                                    <th width="30%">Nome</th>
                                                    <th width="10%">Quantidade</th>
                                                    <th width="10%">Valor</th>
                                                    <th width="50%">Distribuição</th>
                                                    <th>Remover</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tabelaItens">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ./Itens da conta -->

                        <center><input type="submit" class="btn btn-default" value="" id='btCadastrarConta' /></center>
                    </form>
                    <!-- /.container-fluid -->
                </div>
                <!-- /#page-wrapper -->
            </div>
            <!-- /#wrapper -->
        </div>


        <!-- Modal Grupos -->
        <div class="modal fade" id="modalSelecionaGrupo" tabindex="-1" role="dialog"  aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">
                            Meus grupos
                        </h4>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="integranteParaAdicionar">Grupo:</label>
                            <select class="form-control" id="gruposUsuario">
                                <option id="grupo-1">Selecione um grupo</option>
                                <?php ControleViewCadastroDespesa::escreveGruposDoUsuario($gruposUsuario) ?>
                            </select>
                        </div>
                        <div id="integrantesGrupo" class="form-group">
                        </div>
                    </div>

                    <!-- Modal Footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default"
                                data-dismiss="modal" id="btCancelaSelecionaGrupo">
                            Cancelar
                        </button>
                        <button type="button" class="btn btn-primary" id="btSelecionaGrupo">
                            Selecionar
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- ./Modal Grupos -->

        <!-- modal Erro -->
        <div class="modal fade" id="modalErroAviso" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        Erro
                    </div>
                    <div class="modal-body" id='avisoModal'>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Okay</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- /. Modal Erro -->

    </body>
</html>
