<html>
	<head>
		<meta charset="UTF-8">
	<link rel="icon" href="images/brasao-sp.png"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Solicitar • Ficha Catalográfica</title>

    <!-- CSS -->
    <link rel="stylesheet" href="./css/master.css">
    <link rel="stylesheet" media="(max-width: 680px)" href="./css/responsive.css">

    <!-- Font Awesome -->
    <script src="https://use.fontawesome.com/43f21fbb10.js"></script>
	</head>
	<body>
		<?php
		include('menu.php');
		include('config.php');
		?>

		<main class="content-container content-ficha">
			<header class="content-header">
				<h1>Leitura da Ficha Catalográfica</h1>
			</header>
			<div class="content-body">
				<?php if($_SESSION['tipo'] != "professor" && $usu["envioUsuario"]):
					$status = $usu["envioUsuario"];
					$color = "gray";

					if($status == "confirmado"){
						$color = "#e0d01f";
					} else if ($status == "autorizado") {
						$color = "#24cc8e";
					} else if ($status == "desautorizado") {
						$color = "#e01e5c";
					}
				
				?>
					<h3>Status da Ficha: 
						<span style="color: <?php echo $color ?>">
							<?php echo ucfirst($status) ?>
						</span>
					</h3>
				<?php endif ?>
				<br>
				<?php
				if(isset($_SESSION['nome'])){
				/*echo "Curso:".$_POST['curso'];
				echo "Genero:".$_POST['genero'];
				echo "Nome Direto:".$_POST['nomesD'];
				echo "Nome Indireto:".$_POST['nomesI'];
				echo "Titulo:".$_POST['tituloP'];
				echo "Titulo ingles:".$_POST['tituloI'];
				echo "Nota:".$_POST['nota'];
				echo "Palavras Chave:".$_POST['palavraC'];
				echo "Area:".$_POST['area'];
				echo "Folhas:".$_POST['folhas'];
				echo "Orientador".$_POST['orientador'];
				echo "Nome orientador Indireto:".$_POST['orientadorI'];
				echo "Nome orientador Direto:".$_POST['orientadorD'];
				echo "Data:".$_POST['dataDM'];
				echo "Unidade de Enino:".$_POST['uniensino'];
				echo "Tipo de Publicacao:".$_POST['publica'];
				echo "Resumo:".$_POST['resumo'];
				echo "Abstract:".$_POST['abstract'];
				echo "Referencia:".$_POST['referencia'];
				echo "Email:".$_POST['email'];
				echo "Telefone:".$_POST['telefone'];
				echo "Sujestão/ Critica:".$_POST['sc'];
				echo "Atestado:".$_POST['sim'];*/

				//------------Verificações



				//Verificacao Ficha
				$pesquisaficha=$conn->prepare("SELECT * FROM ficha
				WHERE (idficha = :idficha) OR (idusuarios = :idusuarios)");

				$pesquisaficha->bindParam(':idusuarios', $usu['idusuarios']);
				$pesquisaficha->bindParam(':idficha', $_GET['Ficha']);

				$pesquisaficha->execute();


				$ficha=$pesquisaficha->fetch(PDO::FETCH_ASSOC);

				//Verificacao Usuario
				$pesquisaususoli=$conn->prepare("SELECT * FROM usuarios
				WHERE (idusuarios = '$usu[idusuarios]') OR (loginUsuario = '$usu[loginUsuario]')");

				$pesquisaususoli->execute();

				$ususoli=$pesquisaususoli->fetch(PDO::FETCH_ASSOC);

				//Verificacao Orientador 1
				$pesquisaorient=$conn->prepare("SELECT * FROM orientador
				WHERE (idusuarios = $ususoli[idusuarios]) OR (idusuarios = :idusuarios)");

				$pesquisaorient->bindParam(':idusuarios', $_GET['Codigo']);

				$pesquisaorient->execute();

				$orient=$pesquisaorient->fetch(PDO::FETCH_ASSOC);

				//Verificacao Orientador 2
				$pesquisaorient2=$conn->prepare("SELECT * FROM orientador ");

				$pesquisaorient2->execute();

				$orient2=$pesquisaorient2->fetch(PDO::FETCH_ASSOC);
				//---------------------------------------------------

				//-------------------Inserções/Atualizações

				if(isset($_POST["enviar"])){
					
				// INSERÇÃO DA FICHA

				$insereusu=$conn->prepare("UPDATE usuarios SET envioUsuario = 'confirmado', emailUsuario = :emailUsuario,  telefone = :telefone, nomedUsuario = :nomedUsuario, nomeiUsuario = :nomeiUsuario WHERE (idusuarios = $usu[idusuarios])");

				//Usuario
				$insereusu->bindParam(':emailUsuario', $_POST['email']);
				$insereusu->bindParam(':telefone', $_POST['telefone']);
				$insereusu->bindParam(':nomedUsuario', $_POST['nomesD']);
				$insereusu->bindParam(':nomeiUsuario', $_POST['nomesI']);


				$insereusu->execute();


				//Orientador
				$insereori=$conn->prepare("INSERT INTO orientador (nomedOrientador,nomeiOrientador, titulacaoOrientador, idusuarios) VALUES ( :nomedOrientador, :nomeiOrientador, :titulacaoOrientador, $usu[idusuarios])");


				$insereori->bindParam(':nomedOrientador', $_POST['orientadorD']);
				$insereori->bindParam(':nomeiOrientador', $_POST['orientadorI']);
				$insereori->bindParam(':titulacaoOrientador', $_POST['orientador']);

				$insereori->execute();

				//Ficha Catalografica
				$insereficha=$conn->prepare("INSERT INTO ficha (cursoFicha,generoFicha,tituloFicha, notaFicha, palavrascFicha, areaFicha, folhasFicha, dataFicha, resumoFicha, sujestaoFicha, idusuarios, uniensinoFicha, tipoFicha, abstractFicha, referenciaFicha, tituloIFicha) VALUES (:cursoFicha, :generoFicha,:tituloFicha, :notaFicha, :palavrascFicha, :areaFicha, :folhasFicha, :dataFicha, :resumoFicha, :sujestaoFicha, $usu[idusuarios],  :uniensinoFicha, :tipoFicha, :abstractFicha, :referenciaFicha, :tituloIFicha)");


				$insereficha->bindParam(':cursoFicha', $_POST['curso']);
				$insereficha->bindParam(':generoFicha', $_POST['genero']);
				$insereficha->bindParam(':tituloFicha', $_POST['tituloP']);
				$insereficha->bindParam(':notaFicha', $_POST['nota']);
				$insereficha->bindParam(':palavrascFicha', $_POST['palavraC']);
				$insereficha->bindParam(':areaFicha', $_POST['area']);
				$insereficha->bindParam(':folhasFicha', $_POST['folhas']);
				$insereficha->bindParam(':dataFicha', $_POST['dataDM']);
				$insereficha->bindParam(':resumoFicha', $_POST['resumo']);
				$insereficha->bindParam(':sujestaoFicha', $_POST['sc']);
				$insereficha->bindParam(':uniensinoFicha', $_POST['uniensino']);
				$insereficha->bindParam(':tipoFicha', $_POST['publica']);
				$insereficha->bindParam(':abstractFicha', $_POST['abstract']);
				$insereficha->bindParam(':referenciaFicha', $_POST['referencia']);
				$insereficha->bindParam(':tituloIFicha', $_POST['tituloI']);

				$insereficha->execute();


				//------------------------------------------------

				?>
				

				<p>Código do Usuário: <?php echo $ficha['idusuarios']; ?></p>
				<p>Código da Ficha: <?php echo $ficha['idficha']; ?><br></p>
				<p><?php echo $_POST['nomesI']; ?><br>Titulo da monografia: <?php echo $_POST['tituloP']; ?> / <?php echo $_POST['nomesD']; ?> , <?php echo $_POST['dataDM']; ?>.<br>Total de folhas: <?php echo $_POST['folhas']; ?><br><br>Orientador: <?php echo $_POST['orientadorD']; ?><br><br>Monografia (<?php echo $_POST['genero']; ?>) - <?php echo $_POST['uniensino']; ?> , <?php echo $_POST['curso']; ?> , <?php echo $_POST['dataDM']; ?><br><br><?php echo $_POST['palavraC']; ?><br><?php echo $_POST['uniensino']; ?> , <?php echo $_POST['curso']; ?>.</p>

				<?php

				//-----------------------------------
				
				
				}else if(isset($_POST["atualizar"])){
				// ATUALIZAÇÃO DE FICHA

				$atualizausu=$conn->prepare("UPDATE usuarios SET envioUsuario = 'confirmado', emailUsuario = :emailUsuario,  telefone = :telefone, nomedUsuario = :nomedUsuario, nomeiUsuario = :nomeiUsuario WHERE (idusuarios = $usu[idusuarios])");

				//Usuario
				$atualizausu->bindParam(':emailUsuario', $_POST['email']);
				$atualizausu->bindParam(':telefone', $_POST['telefone']);
				$atualizausu->bindParam(':nomedUsuario', $_POST['nomesD']);
				$atualizausu->bindParam(':nomeiUsuario', $_POST['nomesI']);


				$atualizausu->execute();


				//Orientador
				$atualizaori=$conn->prepare("UPDATE orientador SET nomedOrientador = :nomedOrientador,nomeiOrientador = :nomeiOrientador, titulacaoOrientador = :titulacaoOrientador WHERE (idusuarios = $usu[idusuarios])");


				$atualizaori->bindParam(':nomedOrientador', $_POST['orientadorD']);
				$atualizaori->bindParam(':nomeiOrientador', $_POST['orientadorI']);
				$atualizaori->bindParam(':titulacaoOrientador', $_POST['orientador']);

				$atualizaori->execute();

				//Ficha Catalografica
				$atualizaficha=$conn->prepare("UPDATE ficha   SET cursoFicha = :cursoFicha,generoFicha = :generoFicha,tituloFicha = :tituloFicha, notaFicha = :notaFicha, palavrascFicha = :palavrascFicha, areaFicha = :areaFicha, folhasFicha = :folhasFicha, dataFicha = :dataFicha, resumoFicha = :resumoFicha, sujestaoFicha = :sujestaoFicha, uniensinoFicha = :uniensinoFicha, tipoFicha = :tipoFicha, abstractFicha = :abstractFicha, referenciaFicha = :referenciaFicha, tituloIFicha = :tituloIFicha WHERE (idusuarios = $usu[idusuarios])");


				$atualizaficha->bindParam(':cursoFicha', $_POST['curso']);
				$atualizaficha->bindParam(':generoFicha', $_POST['genero']);
				$atualizaficha->bindParam(':tituloFicha', $_POST['tituloP']);
				$atualizaficha->bindParam(':notaFicha', $_POST['nota']);
				$atualizaficha->bindParam(':palavrascFicha', $_POST['palavraC']);
				$atualizaficha->bindParam(':areaFicha', $_POST['area']);
				$atualizaficha->bindParam(':folhasFicha', $_POST['folhas']);
				$atualizaficha->bindParam(':dataFicha', $_POST['dataDM']);
				$atualizaficha->bindParam(':resumoFicha', $_POST['resumo']);
				$atualizaficha->bindParam(':sujestaoFicha', $_POST['sc']);
				$atualizaficha->bindParam(':uniensinoFicha', $_POST['uniensino']);
				$atualizaficha->bindParam(':tipoFicha', $_POST['publica']);
				$atualizaficha->bindParam(':abstractFicha', $_POST['abstract']);
				$atualizaficha->bindParam(':referenciaFicha', $_POST['referencia']);
				$atualizaficha->bindParam(':tituloIFicha', $_POST['tituloI']);

				$atualizaficha->execute();


				//------------------------------------------------

				?>


					<p><span class='txt-error'>Atualização Bem Sucedida!</span><br><br><b>Código do Usuário:</b> <?php echo $ficha['idusuarios'];?></p>
					<p><b>Código da Ficha:</b> <?php echo $ficha['idficha']; ?><br></p>
					<p><?php echo $_POST['nomesI']; ?>.<br>Titulo da monografia:<?php echo $_POST['tituloP']; ?>/<?php echo $_POST['nomesD']; ?>, <?php echo $_POST['dataDM']; ?>.<br>Total de folhas: <?php echo $_POST['folhas']; ?><br><br><b>Orientador:</b> <?php echo $_POST['orientadorD']; ?><br><br>Monografia (<?php echo $_POST['genero']; ?>) - <?php echo $_POST['uniensino'];?>. <?php echo $_POST['curso']; ?>, <?php echo $_POST['dataDM']; ?><br><br><?php echo $_POST['palavraC']; ?><br> <?php echo $_POST['uniensino']; ?>. <?php echo $_POST['curso']; ?>.</p>
				
				<?php

				//-------------------
				}else if($ususoli["envioUsuario"] == "autorizado" || $ususoli["envioUsuario"] == "confirmado"){

				?>
					<p><b>Código do Usuário:</b> <?php echo $ficha['idusuarios']; ?></p>
					<p><b>Código da Ficha:</b> <?php echo $ficha['idficha']; ?><br></p>
					<p><?php $ususoli['nomeiUsuario']; ?>.<br>Titulo da monografia:<?php echo $ficha['tituloFicha']; ?>/<?php echo $ususoli['nomedUsuario']; ?>, <?php echo $ficha['dataFicha']; ?>.<br>Total de folhas: <?php echo $ficha['folhasFicha']; ?><br><br><b>Orientador:</b> <?php echo $orient['nomedOrientador']; ?><br><br>Monografia (<?php echo $ficha['generoFicha']; ?>) - <?php echo $ficha['uniensino']; ?> , <?php echo $ficha['cursoFicha']; ?>, <?php echo $ficha['dataFicha']; ?><br><br><?php echo $ficha['palavrascFicha']; ?><br><?php echo $ficha['uniensino']; ?>. <?php echo $ficha['cursoFicha']; ?>.</p>
					
				<?php 

				}else if($ususoli["envioUsuario"] == "desautorizado"){

				?>
					<p><b>Código do Usuário:</b> <?php echo $ficha['idusuarios']; ?></p>
					<p><b>Código da Ficha:</b> <?php echo $ficha['idficha']; ?><br></p>
					<p><br><span class='txt-error' style='background-color: #f4f4f4; padding:20px 10px;text-align:left;'>Descrepancias no envio: <p style='font-weight:normal;'><?php echo $ususoli['mensagemUsuario'];?></p></span></p>
					<p><?php $ususoli['nomeiUsuario']; ?>.<br>Titulo da monografia:<?php echo $ficha['tituloFicha']; ?>/<?php echo $ususoli['nomedUsuario']; ?>, <?php echo $ficha['dataFicha']; ?>.<br>Total de folhas: <?php echo $ficha['folhasFicha']; ?><br><br><b>Orientador:</b> <?php echo $orient['nomedOrientador']; ?><br><br>Monografia (<?php echo $ficha['generoFicha']; ?>) - <?php echo $ficha['uniensino']; ?> , <?php echo $ficha['cursoFicha']; ?>, <?php echo $ficha['dataFicha']; ?><br><br><?php echo $ficha['palavrascFicha']; ?><br><?php echo $ficha['uniensino']; ?>. <?php echo $ficha['cursoFicha']; ?>.</p>

				<?php 
				}else if ($ususoli["envioUsuario"] == "" ) {
					header('location: fichacatalografica.php');			
				}
			}else{
				header('location: login.php');
			}

			if(isset($_FILES["arquivo"])){
				$arq = $_FILES["arquivo"]["name"];
				$temp = explode(".", $arq);
				$ext = end($temp);
				$newfilename = $ficha['idusuarios'] . '.' . $ext;
				//move_uploaded_file($_FILES["arquivo"]["tmp_name"], "arquivos/" . $_FILES["arquivo"][$newfilename]);
				if (move_uploaded_file($_FILES["arquivo"]["tmp_name"], "C:/xampp/htdocs/sistema-cpa/arquivo/" . $newfilename)) {
				?>
					<p style='color:#24cc8e;'>Arquivo enviado.</p>
				<?php
				} else { 
				?>
					<p style='color:#e01e5c;'>Arquivo não enviado.</p>
				<?php
				}
			}

			?>
			</div>
		</main>
		<?php 
		
			include_once('./components/MainFooter.php')
		
		?>
	</body>
</html>
