<?php
$servername = "localhost";//endere�o do servidor
$username = "root";//usu�rio do servidor
$password = "1234";//senha
$dbname = "teste2";//nome do database/schema
/*
LOGINS DE ACESSO PARA TESTE NO SITE

ana
TIPO:Professor
USUARIO:ana1
SENHA:ana
TIPO:Aluno
USUARIO:hum
SENHA:123
TIPO:Aluno
USUARIO:ana
SENHA:123


*/
try {
    //cria objeto $conn com valores para conex�o
	$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);//set das vari�veis de erro
} catch(PDOException $e) {
    echo 'Erro de Banco de Dados: ' . $e->getMessage();
}
?>
