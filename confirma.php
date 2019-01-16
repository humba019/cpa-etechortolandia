<html>
	<head>
		<title>Ficha Catalográfica - Confirmação</title>
		<meta charset='utf-8'>

	</head>
	<body>
	<?php
	include('config.php');
	include('menu.php');
	if(isset($_GET["enviar"])){
		$status = $_GET['ok'];	
		$mensagem = $_GET['observacao'];	
		$codigo = $_GET['codigo'];
	//	$status = "autorizado";
	echo "<script>console.log( 'Debug Objects: " . $codigo . "' );</script>";
		
		$atualizausu=$conn->prepare("UPDATE usuarios SET envioUsuario = '$status', mensagemUsuario = '$mensagem' WHERE (idusuarios = $codigo)");


		$atualizausu->execute();

		$envioficha = "Atualizado com sucesso!";

	} else {
		echo "<script>console.log( 'Post enviar não setado' );</script>";

	}

	?>
	</body>
</html>
