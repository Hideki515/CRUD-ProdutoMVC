<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/CRUD-ProdutoMVC/public/css/bootstrap.min.css">

    <link rel="stylesheet" href="/CRUD-ProdutoMVC/public/css/login.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <title>Login</title>
</head>

<body class="text-center">

    <form class="form-login" action="<?php echo 'http://' . APP_HOST . '/usuario/autenticar'; ?>" method="post"
        id="formLogin">
        <img src="/CRUD-ProdutoMVC/public/imagens/CrudLogo.png" style="width:134px;height:86px;" alt="CRUD_logo">
        <br>
        <br>
        <?php 
            use App\Lib\Sessao;

            echo Sessao::retornaMensagem();
            Sessao::limpaMensagem();
        ?>
        <div class="form-row" style="display:flex;">
            <i class="fas fa-user me-2" style="margin-bottom:20px; font-size:25px;color:#012060;"></i>
            <input type="text" name="login" class="form-control" style="margin-bottom:20px; font-size:16px;"
                placeholder="Digite o Login">
        </div>
        <div class="form-row align-items-center" style="margin-right: 8px;display:flex;">
            <i class="fas fa-lock me-2" style="margin-bottom:30px; font-size:25px;color:#012060;"></i>
            <input type="password" name="senha" class="form-control col-10" style="margin-bottom:30px;"
                placeholder="Digite a senha">
        </div>
        <div class="form-row align-items-center">
            <button class="btn btn-lg btn-outline-warning btn-block btn-hover"
                style="margin-left:15px; margin-right: 10px;" type="submit"> <i class="bi bi-door-open"></i>
                Entrar</button>
        </div>
        <!-- <div class="form-row align-items-center">
            <p class="col-12 font-italic text-muted" style="margin-top:30px;">&copy; Bruno Hideki (●'◡'●) | Diogo
                Ferreira ^_^ - 2024</p>
        </div> -->
    </form>
    <script src="/CRUD-ProdutoMVC/public/js/jquery-3.5.1.min.js"></script>
    <script src="/CRUD-ProdutoMVC/public/js/bootstrap.bundle.min.js"></script>
</body>

</html>