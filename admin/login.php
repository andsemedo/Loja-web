

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entrar</title>

    <link rel="stylesheet" href="./includes/css/login.css">
    <link rel="stylesheet" href="./includes/icons/icons.css">

</head>

<body>

    <section class="main-container">

        <center>
            <h1>Entre com a sua conta</h1>
        </center>

        <div id="popup" class="popup">
            <center>
                <span class="material-icons-outlined error" style="font-size: 36px;">error</span>
            </center>
            <center>
                <h4 class="error-message">Username ou password incorrecto!</h4>
            </center>
        </div>


        <center>
            <span class="material-icons-outlined" style="font-size: 36px;" >lock</span>
        </center>

        
        
        <form action="#" method="POST" oninput="hide()" >

            <div>
                <input type="text" name="username_admin" id="username_admin" placeholder="Username"  required>

                <input type="password" name="password_admin" id="password_admin" placeholder="Password" required>

                <center>
                    <button type="submit" name="login" id="login">Entrar</button>
                </center>
            </div>

        </form>

    </section>


    <?php

    require_once("../vendor/autoload.php");

    use classes\Utilizador;

    if(isset($_POST['username_admin']) && isset($_POST['password_admin'])) {
        
        $username = $_POST['username_admin'] ?? '';
        $password = $_POST['password_admin'] ?? '';

        $result = Utilizador::validaLogin($username, $password);
        
        session_start();
        
        if($result) {
            foreach ($result as $res) {
                $_SESSION['id_admin'] = $res->id;
                $_SESSION['username_admin'] = $res->username;
                $_SESSION['pass_admin'] = $res->pass;
                $_SESSION['nome_admin'] = $res->nomeFunc;
                $_SESSION['foto_admin'] = $res->foto;
                $_SESSION['tipo_admin'] = $res->tipo;
                header('location: index.php');
                exit();
            }
        } else {
        ?>
        <script>
            let popup = document.getElementById('popup');
            let user = document.getElementById('user');
            let pass = document.getElementById('password');

            popup.classList.add('popup-show');

            function hide() {
                popup.classList.remove('popup-show');
            }
        </script>
        <?php
        }
        
    }

?>
 

    <!-- <script src="./includes/js/login.js"></script> -->

</body>

</html>