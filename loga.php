<?php
include("config.php");
session_start();
$_SESSION["nome"] = $_POST["login"];
$_SESSION["senha"] = $_POST["senha"];
$_SESSION["tipo"] = $_POST["tipo"];

$pesquisausu=$conn->prepare("SELECT * FROM usuarios 
WHERE (loginUsuario = :loginUsuario) AND (tipoUsuario = :tipoUsuario)");

$pesquisausu->bindParam(':loginUsuario', $_SESSION['nome']);
$pesquisausu->bindParam(':tipoUsuario', $_SESSION['tipo']);

$pesquisausu->execute();

$usu=$pesquisausu->fetch(PDO::FETCH_ASSOC);

if (($_SESSION["nome"]==$usu['loginUsuario'])&&($_SESSION["senha"]==$usu['senhaUsuario'])&&($_SESSION["tipo"]=="aluno")) {
	unset($_SESSION["acesso-negado"]);
	header('Location: solicitar.php');
}else if(($_SESSION["nome"]==$usu['loginUsuario'])&&($_SESSION["senha"]==$usu['senhaUsuario'])&&($_SESSION["tipo"]=="professor")) {
	unset($_SESSION["acesso-negado"]);
	header('Location: leitura.php');
} else {
	unset($_SESSION["nome"]);
	unset($_SESSION["senha"]);
	unset($_SESSION["tipo"]);
	$_SESSION["acesso-negado"] = true;
	header('Location: login.php');
}

?>