<?php
  session_start();

  if(!isset($_SESSION["userLogado"])) {
    header("Location: login.html");
  }

  require('php/conectarBanco.php');

  $usuario = $_SESSION['userLogado'];

  $query = mysqli_query($mysqli, "SELECT * FROM userinfos WHERE usuario='$usuario'");

  $queryLogado = mysqli_fetch_assoc($query);
  $idade = $queryLogado["idade"];
?>

<html>
    <head>
        <title>Index</title>
    </head>
    <body>
        <h3>Bem-vindo <?php echo $usuario;?>, voce tem <?php echo $idade;?> anos.</h3>
        <br>
        <br>
        <a href="php/desconectar.php">Desconectar</a>
    </body>
</html>