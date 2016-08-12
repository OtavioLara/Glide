<!-- Navigation -->
<?php
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'BD' . DIRECTORY_SEPARATOR . 'GrupoDAO.php';
$gruposUsuario = GrupoDAO::getGruposDoUsuario($usuario->getId());
?>
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="Index.php">Glide</a>
    </div>
    <!-- /.navbar-header -->

    <!-- Menu -->
    <ul class="nav navbar-top-links navbar-right">

        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="glyphicon glyphicon-exclamation-sign"></i>
                <span class="badge" ><?php //total de contas em alerta          ?></span>
                <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-messages">
                <?php
                //mostrar contas em alerta
                ?>
                <li>
                    <a class="text-center" href="#">
                        <strong>Ver todos as despesas em alerta</strong>
                        <i class="fa fa-angle-right"></i>
                    </a>
                </li>
            </ul>
            <!-- /.dropdown-messages -->
        </li>

        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-envelope fa-fw"></i>  
                <span class="badge" ><?php ?></span>
                <i class="fa fa-caret-down"></i>
            </a>

            <ul class="dropdown-menu dropdown-messages">
                <?php
                //mostrar convites
                ?>
                <li>
                    <a class="text-center" href="Grupos.php">
                        <strong>Ver todos os convites de grupos</strong>
                        <i class="fa fa-angle-right"></i>
                    </a>
                </li>
            </ul>
            <!-- /.dropdown-messages -->
        </li>

        <!-- Notificações -->
        <li class="dropdown" id="liNotificacoes">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-bell fa-fw"></i>
                <span class="badge" id="qtdNotificacoes"><?php //total de notificacoes         ?></span>
                <i class="fa fa-caret-down"></i>
            </a>

            <ul class="dropdown-menu dropdown-messages" id="notificacoes">

            </ul>
            <!-- /.dropdown-messages -->
        </li>
        <!-- /.dropdown -->



        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li><a href="Index.php"><i class="fa fa-user fa-fw"></i> <?php echo $usuario->getNome(); ?></a>
                </li>
                <li class="divider"></li>
                <li><a href="../abort.php"><i class="fa fa-sign-out fa-fw"></i> Encerrar Sessão</a>
                </li>
            </ul>
            <!-- /.dropdown-user -->
        </li>
        <!-- /.dropdown -->
    </ul>
    <!-- /.navbar-top-links -->

    <!-- Menu Lateral -->
    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <li>
                    <a href="Index.php"><i class="glyphicon glyphicon-home"></i> Início</a>
                </li>
                <li>
                    <a href="Historico.php"><i class="fa fa-history"></i> Histórico</a>
                </li>
                <li>
                    <a href="#"><i class="glyphicon glyphicon-usd"></i> Despesas<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="CadastroConta.php" onclick="">Cadastrar Despesa</a>
                        </li>
                        <li>
                            <a href="ContasPendentes.php">Despesas Pendentes</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                <li>
                    <a href="#"><i class="fa fa-group"></i> Grupos <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="CriarGrupo.php">Criar grupo</a></li>
                        <li><a href="Grupos.php">Gerenciador de grupos </a></li>
                        <?php if (count($gruposUsuario) > 0) { ?>
                            <li>
                                <a href="#">Meus Grupos <span class="fa arrow fa-angle-down"></span></a>
                                <ul class="nav nav-second-level">
                                    <?php
                                    foreach ($gruposUsuario as $grupo) {
                                        echo "<li>";
                                        echo "  <a href='#'>";
                                        echo $grupo->getNome();
                                        echo "  </a>";
                                        echo "</li>";
                                    }
                                    ?>
                                </ul>
                                <!-- /.nav-second-level -->
                            </li>
                        <?php } ?>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-exchange"></i> Pagamentos <span class="fa arrow fa-angle-down"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="#" onclick="">Receber Pagamento</a>
                        </li>
                        <li>
                            <a href="#" onclick="">Solicitar Pagamento</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>

            </ul>
        </div>
        <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
</nav>

