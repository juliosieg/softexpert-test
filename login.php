<!--Bootstrap 3.3.6 -->
<link rel = "stylesheet" href = "bootstrap/css/bootstrap.min.css">
<!--Font Awesome -->
<link rel = "stylesheet" href = "plugins/font-awesome-4.6.3/css/font-awesome.css">
<!--Ionicons -->
<link rel = "stylesheet" href = "plugins/ionicons-2.0.1/css/ionicons.min.css">
<!--jQuery 2.2.0 -->
<script src = "plugins/jQuery/jQuery-2.2.0.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- Bootbox Alert -->
<script src="js/bootbox.js"></script>

<!-- Login -->
<script src="js/login.js"></script>


<body class="hold-transition" style='align: center'>
    <style type='text/css'>
        body {
            background: rgba(0, 0, 0, 0.25);
            background-size:     cover;        
            background-repeat:   no-repeat;
            background-position: center center; 
        }
    </style>

    <div class='col-xs-4'>
    </div>

    <div class="col-xs-4" style='text-align: center; margin-top: 15%'>
        <div class="login-logo" style='color: white'>
            <a style='color: black; font-size: 22px; text-decoration: none'>
                <b>Gerenciamento</b> de Vendas
            </a>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">Faça login para iniciar sua sessão</p>

            <form>
                <div class="form-group has-feedback">
                    <input type="email" name='email' id='email' class="form-control" placeholder="E-mail">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input  type="password" id="senha" name='senha' class="form-control" placeholder="Senha">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
          
                    <div class="col-xs-4">

                    </div>

                    <div class="col-xs-4">
                        <input type="button" onclick="efetuarLogin()" class="btn btn-primary btn-block btn-flat" style='background: #bfbfbf;    border: 1px solid white' value="Entrar">
                    </div>

                    <div class="col-xs-4">

                    </div>
                    <h4 id="aviso-login"></h4>

                </div>
            </form>

        </div>
    </div>

    <div class='col-xs-4'>
    </div>

</body>
</html>