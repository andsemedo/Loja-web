<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link href="../includes/css/bootstrap.min.css" rel="stylesheet">
    <link href="../includes/css/login.css" rel="stylesheet">



</head>

<body class="bg-dark">

    <main>
        <div class="caixa container my-5" style="width: 500px;">

            <?php
            $acao = 'login';
            if (isset($_GET['login'])) {
                if ($_GET['login'] == 'nao_logado') {
                    $acao = 'comprar';
                    echo '
                    <div class="alert alert-danger" role="alert">
                        <strong>Não estás logado!</strong> Inicie a sessão com a sua conta ou crie uma.
                    </div>
                    ' ;
                    
                } else if($_GET['login'] == 'errado'){
                    echo '
                    <div class="alert alert-danger" role="alert">
                        Username ou password incorreto.
                    </div>
                    ';
                }
            }
            ?>



            <center>
                <h4>Entre com a sua conta</h4>
            </center>
            <form action="../controlo/loginBD.php?acao=<?=$acao?>" method="POST">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" name="username" id="username" required>

                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="password" required><br>
                <center>
                    <input type="submit" class="btn btn-primary" name="login" value="Entrar">
                </center>
            </form>

            <center>
                <a href="./registrar.php" style="text-decoration: none;">
                    <p>Não tens uma conta? <span>Registrar</span></p>
                </a>
            </center>

        </div>

    </main>

    <script type="text/Javascript" src="../includes/js/bootstrap.bundle.min.js"></script>

</body>

</html>

<!-- <form action="../controlo/loginBD.php" method="POST">
    
    <div>
        <label>Nome de Utilizador ou Email</label><br>
        <input type="text" name="username" required />
    </div>

    <div>
        <label>Senha</label><br>
        <input type="password" name="password" required />
    </div>

    <div>
        <br><button type="submit">Entrar</button>
    </div>

</form>

<p>Não tens uma conta? <a href="./registrar.php">Criar conta.</a> </p> -->