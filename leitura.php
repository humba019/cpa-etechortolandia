<html>
	<head>
		<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Leitura • Ficha Catalográfica</title>

    <!-- CSS -->
    <link rel="stylesheet" href="./css/master.css">
    <link rel="stylesheet" href="./css/forms.css">
    <link rel="stylesheet" media="(max-width: 680px)" href="./css/responsive.css">

    <!-- Font Awesome -->
    <script src="https://use.fontawesome.com/43f21fbb10.js"></script>
	</head>
	<body>
	<?php 
		include('config.php');
	if(isset($_GET["enviar"])){
		$status = $_GET['ok'];	
		$mensagem = $_GET['observacao'];	
		$codigo = $_GET['codigo'];
	//	$status = "autorizado";
	echo "<script>console.log( 'Debug Objects: " . $codigo . "' );</script>";
		
		$atualizausu=$conn->prepare("UPDATE usuarios SET envioUsuario = '$status', mensagemUsuario = '$mensagem' WHERE (idusuarios = $codigo)");


		$atualizausu->execute();

		$envioficha = "<span class='txt-error'>Ficha enviada com sucesso!</span>";
	}else{
		$envioficha = "<span class='txt-error'>Nenhuma ficha enviada.<BR></span>";
		echo "<script>console.log( 'Post enviar não setado' );</script>";

	}
		?>
	<div class='cabecalho'>
	<?php include('menu.php'); ?>
	</div>
	<main class='content-container'>
		<header class="content-header">
			<h1>Fichas para Revisão</h1>
			<?php 
			echo $envioficha;
			?>
		</header>
		<div class="content-body card-container">
		<?php

		if(isset($_SESSION['nome']) && $_SESSION['tipo'] == "professor"){

			//------------Verificações

			//Verificacao Orientador
			$pesquisaorient=$conn->prepare("SELECT * FROM orientador");

			$pesquisaorient->execute();

			$orient=$pesquisaorient->fetch(PDO::FETCH_ASSOC);

			//Verificacao Ficha
			$pesquisaficha=$conn->prepare("SELECT * FROM ficha");

			$pesquisaficha->execute();

			//--------------------------------
		
		while($ficha=$pesquisaficha->fetch(PDO::FETCH_ASSOC)){
		//Verificacao Usuario
			$pesquisausulei=$conn->prepare("SELECT * FROM usuarios WHERE idusuarios = $ficha[idusuarios]");

			$pesquisausulei->execute();

			$usulei=$pesquisausulei->fetch(PDO::FETCH_ASSOC);


		if($usulei["envioUsuario"] == "confirmado" && $usulei["tipoUsuario"] == "aluno"){ ?>
			<form class="card-ficha" action='leitura.php' method='GET'>
				<h1>Ficha Catalografica <?php echo $ficha['idficha']; ?><br> Código Usuario <?php echo $ficha['idusuarios']; ?> </h1>
				<span><?php echo $ficha['tituloFicha']; ?></span>
				<br>
				<br>
				Para acessar a ficha <?php echo " <a href='solicitar.php?Ficha=$ficha[idficha]&Codigo=$ficha[idusuarios]'>Clique Aqui</a>.</h3>" ?></span>
				<br>
				<br>
				<fieldset>
					<legend>Autorização</legend>
					Para acessar ao arquivo do projeto <?php echo " <a href='arquivos/$ficha[idusuarios].pdf'>Clique Aqui.</a></h3>" ?>
				<p>
					<label>
						<input type='radio' onclick='fechaDes("<?php echo $ficha["idficha"] ?>")' name='ok' value='autorizado' required>
						Autorizado
					</label>
				</p>
				<p>
					<label>
						<input type='radio' onclick='exibeDes("<?php echo $ficha["idficha"] ?>")' name='ok' value='desautorizado' >
						Desautorizado
					</label>
				</p>
			</fieldset>
				<div class='fieldDescricaoFicha' data-id-ficha="<?php echo $ficha["idficha"] ?>">
					<p>Inserir Observação<br>*Caso haja descrepancias.</p>
					<textarea type='text' name='observacao' rows='3' cols='53'
													wrap='hard' class="form-control"
													placeholder="Digite a Observação" ></textarea>
					<p>
						<?php echo "<input type=hidden name='codigo' value='$usulei[idusuarios]'>";?>
					</p>
				</div>
				<br>
				<button class="btn btn-card-submit" name='enviar'>
					<i class="fa fa-check"></i>Enviar
				</button>
		</form>
		<?php 
			}
		}
		}else{
			header("location: login.php");
		}

		?>

		<br><br>
		</div>
	</main>
	<?php include_once('./components/MainFooter.php') ?>
	<script>
		
	const getTextArea = function(id) {
		return document.querySelector(".fieldDescricaoFicha[data-id-ficha='" + id + "']");
	}

	function exibeDes(idFicha){
		getTextArea(idFicha).style.display = "block";
	}
	function fechaDes(idFicha){
		getTextArea(idFicha).style.display = "none";
	}
</script>
	</body>
</html>
