<?php
$pass_error = '';
    if(isset($_GET['error'])) {
        $pass_error = "<div class='alert alert-danger'>As senhas precisam ser iguais</div>";
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar</title>

    <link href="../includes/css/bootstrap.min.css" rel="stylesheet">
    <link href="../includes/css/login.css" rel="stylesheet">



</head>

<body class="bg-dark">

    <main>
        <div class="caixa container my-5" style="width: 500px;">

            <center>
                <h4>Crie uma conta</h4>
                <?=$pass_error;?>
            </center>
            <form action="../controlo/registrarBD.php" method="POST">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" class="form-control" name="nome" id="nome" required>

                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" id="email" required>

                <label for="telefone" class="form-label">Telefone</label>
                <input type="tel" maxlength="7" min="0" class="form-control" name="telefone" id="telefone" >

                <label for="username" class="form-label">Nome utilizador</label>
                <input type="text" class="form-control" name="username" id="username" required>

                <label for="password" class="form-label">Senha</label>
                <input type="password" class="form-control" name="password" id="password" required>

                <label for="conf_password" class="form-label">Confirmar senha</label>
                <input type="password" class="form-control" name="conf_password" id="conf_password" required><br>

                <center>
                    <input type="submit" class="btn btn-primary" name="registrar" value="Registrar">
                </center>
            </form>

            <center>
                <a href="./login.php" style="text-decoration: none;">
                    <p>Já tens uma conta? <span>Login</span></p>
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