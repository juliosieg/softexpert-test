<?php
// Sistema para verificar se o usuário já está logado ou não
session_start();
if (!$_SESSION['logado']) {
    header("Location: login.php");
} else {
    $now = time(); 

    if ($now > $_SESSION['expire']) {
        session_destroy();
        echo"<script language='javascript' type='text/javascript'>alert('Sua sessão expirou! É necessário entrar novamente.');window.location.href='login.php';</script>";
    }

    $nomeUsuarioLogado = $_SESSION['nomeLogado'];
}
?>

<html>
    <head>

        <title>SoftExpert - Gerenciamento de Vendas</title>

        <meta charset = "UTF-8">

        <meta http-equiv = "X-UA-Compatible" content = "IE=edge">

        <!--Bootstrap 3.3.6 -->
        <link rel = "stylesheet" href = "bootstrap/css/bootstrap.min.css">
        <!--Font Awesome -->
        <link rel = "stylesheet" href = "plugins/font-awesome-4.6.3/css/font-awesome.css">
        <!--Ionicons -->
        <link rel = "stylesheet" href = "plugins/ionicons-2.0.1/css/ionicons.min.css">
        <!--Theme style -->
        <link rel = "stylesheet" href = "dist/css/AdminLTE.min.css">
        <!--Skin -->
        <link rel = "stylesheet" href = "dist/css/skins/_all-skins.css">
        <!--DataTables -->
        <link rel = "stylesheet" href = "plugins/datatables/dataTables.bootstrap.css">
        <!--Buttons DataTables -->
        <link rel = "stylesheet" href = "plugins/datatables/buttons.dataTables.min.css">
        <!--DataTables Responsive-->
        <link rel = "stylesheet" href = "plugins/datatables/extensions/Responsive/css/dataTables.responsive.css">
        <!-- Text Editor -->
        <link rel="stylesheet" href="plugins/textEditor/editor.css">
        <!-- File input -->
        <link rel="stylesheet" href="plugins/bootstrap-fileinput/css/fileinput.css">
        <!-- Select 2 -->
        <link rel='stylesheet' href='js/select2/css/select2.css'>
        <!-- iCheck -->
        <link rel='stylesheet' href='plugins/iCheck/all.css'>
        <!-- iCheck -->
        <link rel='stylesheet' href='plugins/iCheck/square/_all.css'>
        <!-- Wait Me -->
        <link rel='stylesheet' href='plugins/wait-me/waitMe.min.css'>

        <!--jQuery 2.2.0 -->
        <script src = "plugins/jQuery/jQuery-2.2.0.min.js"></script>
        <!-- Bootstrap 3.3.6 -->
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <!-- AdminLTE App -->
        <script src="dist/js/app.min.js"></script>

        <!-- jQuery Confrim -->
        <script src = "plugins/jquery-confirm/dist/jquery-confirm.min.js"></script>
        <!-- jQuery Confirm CSS -->
        <link rel='stylesheet' href='plugins/jquery-confirm/dist/jquery-confirm.min.css'>
        
        <!-- DataTables -->
        <script src="plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
        <script src="plugins/datatables/dataTables.buttons.min.js"></script>
        <script src="plugins/datatables/buttons.html5.min.js"></script>
        <script src="plugins/datatables/pdfMake.min.js"></script>
        <script src="plugins/datatables/vfs_fonts.js"></script>
        <script src="plugins/datatables/jszip.min.js"></script>
        <script src="plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
        <script src="plugins/datatables/buttons.colVis.min.js"></script>
        
        <!-- FLOT CHARTS -->
        <script src="plugins/flot/jquery.flot.min.js"></script>
        <!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
        <script src="plugins/flot/jquery.flot.resize.min.js"></script>
        <!-- FLOT PIE PLUGIN - also used to draw donut charts -->
        <script src="plugins/flot/jquery.flot.pie.min.js"></script>
        <!-- FLOT CATEGORIES PLUGIN - Used to draw bar charts -->
        <script src="plugins/flot/jquery.flot.categories.min.js"></script>

        <!--Moment-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
        

        <!--Bootstrap Notify -->
        <script src="js/bootstrap-notify-master/bootstrap-notify-master/bootstrap-notify.js"></script>
        <!-- Bootbox Alert -->
        <script src="js/bootbox.js"></script>
        <!-- Text Editor -->
        <script src="plugins/textEditor/editor.js"></script>
        <!-- jQuery file Upload -->
        <script src="plugins/bootstrap-fileinput/js/fileinput.js"></script>
        <!--Bootstrap File Input Locale -->
        <script src="plugins/bootstrap-fileinput/js/locales/pt-BR.js"></script>
        <!--Mask money -->
        <script src="plugins/maskMoney.js"></script>
        <!-- Select2 -->
        <script src='js/select2/js/select2.js'></script>
        <!-- Select 2 language -->
        <script src="js/select2/js/i18n/pt-BR.js"></script>
        <!-- iCheck -->
        <script src="plugins/iCheck/icheck.min.js"></script>
        <!-- Wait Me -->
        <script src="plugins/wait-me/waitMe.min.js"></script>

        <!--Print This-->
        <script src="plugins/printThis/printThis.js"></script>

        <!-- Funções Gerais -->
        <script src="js/funcoes.js"></script>
        
        <style>
            div.container { max-width: 1200px };
        </style>

    </head>
    <body class="hold-transition skin-black sidebar-mini">

        <div class="wrapper">
            <header class="main-header">

                <a href="index.php" class="logo">
                    <span class="logo-mini"><i class="fa fa-money" style="padding-top: 15px"></i></span>
                    <span class="logo-lg"><b>SoftExpert</b> Test</span>
                </a>

                <nav class="navbar navbar-static-top">
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                    </a>
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                        </ul>
                    </div>
                </nav>
            </header>

            <aside class="main-sidebar">
                <section class="sidebar">
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="images/usuarioSemFoto.png" class="img-circle" alt="Imagem de Usuário">
                        </div>
                        <div class="pull-left info">
                            <p><?php echo $nomeUsuarioLogado;?></p>
                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>

                    <ul class="sidebar-menu">
                        <li class="header">MENU ADMINISTRATIVO</li>

                        <li class="<?php echo !$_GET['menu'] ? 'active' : ''?>">
                            <a href="index.php">
                                <i class="fa fa-home"></i> <span>Início</span>
                            </a>
                        </li>

                        <li class="treeview <?php echo ($_GET['menu'] == 'nova_venda' or $_GET['menu'] == 'listar_venda') ? 'active' : ''?>">
                            <a href="#">
                                <i class="fa fa-shopping-cart"></i>
                                <span>Venda</span>
                                <i class="ion-ios-arrow-down pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li class="<?php echo $_GET['menu'] == 'nova_venda' ? 'active' : ''?>"><a href="index.php?menu=nova_venda"><i class="fa fa-plus"></i> Nova Venda</a></li>
                                <li class="<?php echo $_GET['menu'] == 'listar_venda' ? 'active' : ''?>"><a href="index.php?menu=listar_venda"><i class="fa fa-navicon"></i> Listar</a></li>
                            </ul>
                        </li>

                        <li class="<?php echo $_GET['menu'] == 'produtos' ? 'active' : ''?>">
                            <a href="index.php?menu=produtos">
                                <i class="fa fa-archive"></i>
                                <span>Produtos</span>
                            </a>
                        </li>

                        <li class="<?php echo $_GET['menu'] == 'tipos_produto' ? 'active' : ''?>">
                            <a href="index.php?menu=tipos_produto">
                                <i class="fa fa-tag"></i>
                                <span>Tipos de Produtos</span>
                            </a>
                        </li>

                        <li class="<?php echo $_GET['menu'] == 'usuarios' ? 'active' : ''?>">
                            <a href="index.php?menu=usuarios">
                                <i class="fa fa-user"></i>
                                <span>Usuários</span>
                            </a>
                        </li>

                        <li>
                            <a href="logout.php">
                                <i class="fa fa-sign-out"></i>
                                <span>Sair</span>
                            </a>
                        </li>
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>

            <div class="content-wrapper">
            
                <?php

                    switch($_GET['menu']){

                        case '':
                            $include = 'home.php';
                            break;
                        case 'nova_venda':
                            $include = 'nova_venda.php';
                            break;
                        case 'listar_venda':
                            $include = 'listar_venda.php';
                            break;
                        case 'novo_produto':
                            $include = 'novo_produto.php';
                            break;
                        case 'produtos':
                            $include = 'produtos.php';
                            break;
                        case 'tipos_produto':
                            $include = 'tipos_produto.php';
                            break;
                        case 'usuarios':
                            $include = 'usuarios.php';
                            break;
                        case 'imprimir':
                            $include = 'imprimir.php';
                            break;
                        default:
                            $include = 'error404.php';
                    }

                    require_once($include);

                ?>

            </div>
        </div>    
    </body>
</html>

