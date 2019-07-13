<?php

//Iniciando sessão no PHP
session_start();

//Caso os parametros "usuario" e "senha" ou apenas a variavel de sessão "userLogado" forem detectados
if(isset($_POST['usuario']) && isset($_POST['senha']) || isset($_SESSION['userLogado'])) {
    
    //chamando o script que estabelece a conexão com o banco de dados
    require('conectarBanco.php');

    //caso os parametros "usuario" e "senha" forem detectados
    if(isset($_POST['usuario']) && isset($_POST['senha'])) {

        //definindo variaveis
        $usuario = $_POST['usuario'];
        $senha = $_POST['senha'];
        
        //criando uma funcao responsavel pela checagem das credenciais
        function verificandoExistencia() {
            //chamando o script que estabelece a conexão com o banco de dados
            require('conectarBanco.php');

            //chamando as variaveis "usuario" e "senha", pois foram declaradas fora da função
            global $usuario;
            global $senha;

            //realizando uma consulta no banco de dados, buscando um usuario que tenha a senha inserida pelo usuario
            $consulta = mysqli_query($mysqli, "SELECT * FROM userinfos WHERE usuario='$usuario' and senha='$senha'");
            //calculando o numero de linhas gerado pela consulta feita
            $linha = mysqli_num_rows($consulta);

            //caso retorne 0 linhas, credenciais incorretas
            if($linha == 0) {
                echo "credenciais incorretas";
                //encaminha para a tela de login
                header('Location: ../login.html');
            //caso algum registro for encontrado, credenciais corretas
            } else {
                if($consulta2 = mysqli_fetch_assoc($consulta)) {
                    //criando a variavel de sessão "userLogado", colocando como valor o nome do usuario
                    $_SESSION['userLogado'] = $consulta2["usuario"];
                    //encaminhando denovo para esse mesmo script
                    header('Location: entrarConta.php');
                }
            }
        }
        
        //chamando a funcao que verifica existencia
        verificandoExistencia();
    
    //caso o parametro de sessão for detectado
    } else {
        //encaminha para a tela do index, ja que o usuário ja fez o login corretamente
        header('Location: ../index.php');
    }

//caso nenhum dos parametros de login for detectado (usuario tentando entrar direto pela URL sem fazer login)
} else {
    //encaominha para a tela de login
    header('Location: ../login.html');
}
?>