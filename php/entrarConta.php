<?php
session_start();

require('conectarBanco.php');

if(isset($_POST['usuario']) && isset($_POST['senha']) || isset($_SESSION['userLogado'])) {
    if(isset($_POST['usuario']) && isset($_POST['senha'])) {
        $usuario = $_POST['usuario'];
        $senha = $_POST['senha'];

        $consulta = mysqli_query($mysqli, "SELECT * FROM userinfos WHERE Usuario='$usuario' AND Senha='$senha'");
        $linhas = mysqli_num_rows($consulta);

        if($linhas == 1) {
            $_SESSION['userLogado'] = $usuario;
            header('Location: entrarConta.php');
        } else {
            header('Location: ../login.php');
        }
    } else {
        header('Location: ../index.php');
    }
} else {
    header('Location: ../login.php');
}
?>
