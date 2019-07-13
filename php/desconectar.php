<?php
//Iniciando a sessão PHP
session_start();

//Excluindo a variavel de sessão "userLogado"
unset($_SESSION['userLogado']);

//encaminhando usuario para o index
header('Location: ../index.php');