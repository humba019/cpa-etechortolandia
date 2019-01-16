<html>
	<head>
		<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Solicitar • Ficha Catalográfica</title>

    <!-- CSS -->
    <link rel="stylesheet" href="./css/master.css">
    <link rel="stylesheet" href="./css/forms.css">
    <link rel="stylesheet" media="(max-width: 680px)" href="./css/responsive.css">

    <!-- Font Awesome -->
    <script src="https://use.fontawesome.com/43f21fbb10.js"></script>

	</head>
	<body>
		<div class='cabecalho'>
		<?php
		include('config.php');
		include('menu.php');
		?>
		</div>
		<main class='content-container content-form-ficha'>
			<header class="content-header">
				<h1>Ficha Catalográfica</h1>
			</header>
			<div class="content-body">
				<?php
				//Verificacao Usuario

				$pesquisausu=$conn->prepare("SELECT * FROM usuarios
				WHERE (loginUsuario = :Nome)");

				$pesquisausu->bindParam(':Nome', $_SESSION['nome']);

				$pesquisausu->execute();

				$usu=$pesquisausu->fetch(PDO::FETCH_ASSOC);

				//Verificacao Ficha

				$pesquisafic=$conn->prepare("SELECT * FROM ficha
				WHERE (idusuarios = '$usu[idusuarios]')");

				$pesquisafic->execute();

				$fic=$pesquisafic->fetch(PDO::FETCH_ASSOC);
				//Verificacao Orientador

				$pesquisaori=$conn->prepare("SELECT * FROM orientador
				WHERE (idusuarios = '$usu[idusuarios]')");

				$pesquisaori->execute();

				$ori=$pesquisaori->fetch(PDO::FETCH_ASSOC);

				//-----------------------------------------------------

				if(isset($_SESSION['nome']) && $usu["envioUsuario"] == "" || $usu["envioUsuario"] == "desautorizado"){
				?>
				<form method='POST' action='solicitar.php' enctype='multipart/form-data' class="form-ficha">
					
					<div class="form-group">
						<div>
							<h3>Curso</h3>
							<select name='curso' class="form-control" required>
								<p><option 	value='$fic[cursoFicha]'> <?php echo $fic['cursoFicha']?> </option></p>
								<p><option 	value='Curso Tecnico em Informática para Internet'> Curso Tecnico em Informática para Internet </option></p>
								<p><option 	value='Curso Tecnico em Nutrição' required> Curso Tecnico em Nutrição </option></p>
								<p><option  value='Curso Tecnico em Informática Integrado ao Ensino Médio' required> Curso Tecnico em Informática Integrado ao Ensino Médio </option></p>
								<p><option  value='Curso Tecnico em Nutrição Integrado ao Ensino Médio' required> Curso Tecnico em Nutrição Integrado ao Ensino Médio </option></p>
								<p><option  value='Curso Tecnico em Administração Integrado ao Ensino Médio' required> Curso Tecnologia em Logistica </option></p>
								<p><option  value='Curso Tecnologia em Produção de Urânio com dois Arduinos e um Raspberry' required> Curso Tecnologia em Produção de Urânio com dois Arduinos e um Raspberry</option></p>
							</select>
						</div>
						<div>
							<h3>Gênero</h3>
							<select name='genero' class="form-control" required>
								<p><option value='$fic[generoFicha]' required> <?php echo $fic['generoFicha'] ?></option></p>
								<p><option value='Trabalho de conclusão de curso' required>Trabalho de conclusão de curso </option></p>
							</select>
						</div>
					</div>
					<h3>Identifique o(s) autor(es) da monografia em ordem indireta</h3>
					<h4>Em ordem indireta e caixa alta o SOBRENOME seguido do(s) nome(s).<br>Exemplo: SILVA JUNIOR, Pedro Augusto da.</h4>
					<input type='text' class="form-control" name='nomesI' value='<?php echo $usu['nomeiUsuario']?>' size='70' maxlength='200' required>
					<h3>Identifique o(s) autor(es) da monografia em ordem direta</h3>
					<h4>Em ordem direta o nome completo do(s) autor(es).<br>Exemplo: Pedro Augusto da Silva Junior.</h4>
					<input type='text' class="form-control" name='nomesD' value='<?php echo $usu['nomedUsuario']?>' size='70' maxlength='200' required>
					
					<div class="form-group">
						<div>
							<h3>Titulo: subtítulo(se houver) em lingua portuguêsa</h3>
							<h4>Titulo - somente a primeira letra da primeira palavra deve estar em maiusculo, exceto nomes próprios e siglas; seguido de dois pontos(;) e subtítulo</h4>
							<input type='text' class="form-control" name='tituloP' size='70' maxlength='200' value='<?php echo $fic['tituloFicha']?>' required>
						</div>
						<div>
							<h3>Titulo: subtítulo(se houver) em lingua inglêsa</h3>
							<h4>Titulo - somente a primeira letra da primeira palavra deve estar em maiusculo, exceto nomes próprios e siglas; seguido de dois pontos(;) e subtítulo</h4>
							<input type='text' class="form-control" name='tituloI' size='70' maxlength='200' value='<?php echo $fic['tituloIFicha']?>' required>
						</div>
					</div>
					
					<h3>Número de folhas</h3>
					<h4>Identifique o número de folhas de sua monografia, indicando o ultimo numero impresso.<br>Exemplo: 100f</h4>
					<input type='text' class="form-control" name='folhas' value='<?php echo $fic['folhasFicha']?>' size='5' maxlength='5' required>
					<h3>Avaliação</h3>
					<h4>Identifique a avaliação (nota) que obteve em sua monografia.<br>Exemplo: 9</h4>
					<input type='number' class="form-control" name='nota' value='<?php echo $fic['notaFicha']?>' size='5' max='10' min='0'  required>
					<h3>Palavras-chave em ordem de relevância</h3>
					<h4>Apresente ao menos uma palavra-chave. Utilize obrigatoriamente os termos do Vocabulário Controlado da Biblioteca da Fatec Americana (<a href='http://www.fatec.edu.br/wp-content/uploads/2017/11/Vocabulário-Controlado.pdf'>Clique aqui para saber mais</a>).<br>Utilize obrigatoriamente os termos do Vocabulário Controlado da Biblioteca da Fatec Americana. Caso não encontre o termo adequado acesse: <a href='http://id.loc.gov/authorities/subjects'>Library of Congress - Subject Authority Headings </a> e/ou <a href='http://acervo.bn.br/sophia_web/index.html.'>Fundação Biblioteca Nacional - Autoridades </a> Identifique a procedência utilizando a legenda (LC) e/ou (FBN).<br>Exemplo: Inteligência artificial (LC) Em caso de mais de um termo de palavra-chave, separe-os com ponto e vírgula (;)</h4>
					<input type='text' class="form-control" name='palavraC' value='<?php echo $fic['palavrascFicha']?>' maxlength='200' size='70' required>
					<h3>Área temática</h3>
					<h4>Apresente a área temática a que pertence a sua monografia. Utilize para identificação a Legenda de áreas temáticas da Fatec Americana: <a href='http://www.fatec.edu.br/wp-content/uploads/2016/08/Área-temática.pdf'>Clique aqui para saber mais.</a></h4>
					<input type='text' class="form-control" name='area' maxlength='200' value='<?php echo $fic['areaFicha'] ?>' size='70'required>
					<h3>Identifique a titulação do(a) orientador(a)</h3>
					<select name='orientador' class="form-control" required>
						<p><option value='<?php echo $ori['titulacaoOrientador']?>' required><?php echo $ori['titulacaoOrientador']?></option></p>
						<p><option value='Profa.' required>Profa. </option></p>
						<p><option value='Prof.' required>Prof. </option></p>
						<p><option value='Profa. Esp.' required>Profa. Esp. </option></p>
						<p><option value='Prof. Esp.' required>Prof. Esp. </option></p>
						<p><option value='Profa. Ms.' required>Profa. Ms. </option></p>
						<p><option value='Prof. Ms.' required>Prof. Ms. </option></p>
						<p><option value='Profa. Dra.' required>Profa. Dra. </option></p>
						<p><option value='Prof. Dr.' required>Prof. Dr. </option></p>
					</select>
					<div class="form-group">
						<div>
							<h3>Identifique o nome do(a) orientador(a) em ordem indireta</h3>
							<h4>Em ordem indireta e caixa alta o SOBRENOME seguido do(s) nome(s).<br>Exemplo: SANTOS FILHO, João José de.</h4>
							<input type='text' class="form-control" name='orientadorI' value='<?php echo $ori['nomeiOrientador']?>' size='70' maxlength='200' required>
						</div>
						<div>
							<h3>Identifique o nome do(a) orientador(a) em ordem direta</h3>
							<h4>Em ordem direta o nome completo do(a) oreintador(a).<br>Exemplo: João José de Santos Filho.</h4>
							<input type='text' class="form-control" name='orientadorD' value='<?php echo $ori['nomedOrientador']?>' size='70' maxlength='200' required>
						</div>
					</div>
					
					<h3>Data de defesa da monografia</h3>
					<h4>Selecione a Data</h4>
					<input type='date' class="form-control" name='dataDM' value='<?php echo $fic['dataFicha']?>' required>
					
					<h3>Unidade de Ensino</h3>
					<h4>Selecione a Unidade de Ensino</h4>
					<select name='uniensino' class="form-control" required>
						<p><option value='<?php echo $fic['uniensinoFicha']?>' required> <?php echo $fic['uniensinoFicha'] ?> </option></p>
						<p><option value='Etec de Hortolândia' required>Etec de Hortolândia</option></p>
						<p><option value='Etec de Nova Odessa' required>Etec de Nova Odessa</option></p>
						<p><option value='Etec de Americana' required>Etec de Americana</option></p>
					</select>

					<h3>Tipo de Publicação</h3>
					<h4>Selecione o Tipo de Publicação</h4>
					<select name='publica' class="form-control" required>
						<p><option value='<?php echo $fic['tipoFicha']?>' required><?php echo $fic['tipoFicha']?></option></p>
						<p><option value='Monografia' required>Monografia</option></p>
					</select>

					<div class="form-group">
						<div>
								<h3>Resumo</h3>
							<h4>Copie e cole o resumo em língua portuguêsa de sua monografia</h4>
							<textarea type='text' class="form-control" value='<?php echo $fic['resumoFicha']?>' name='resumo' rows='8' cols='53'
														wrap='hard' required></textarea>
						</div>
						<div class="text-center">
							<h3>Arquivo</h3>
							<h4 class="text-center">Selecione o arquivo exclusivamente em PDF.</h4>
							<span>Selecione o seu TCC em PDF: </span><br><br>
							<label for="tccFile" class="btn">Selecionar Arquivo</label>
							<input type='file' id="tccFile" name='arquivo' accept='application/pdf' class="hidden">
							<br><br><br>
							<i class="hidden" id="filename">Filename</i>
						</div>
					</div>

					<h3>Abstract</h3>
					<h4>Copie e cole o resumo em língua inglêsa de sua monografia</h4>
					<textarea type='text' class="form-control" value='<?php echo $fic['abstractFicha']?>'  name='abstract' rows='8' cols='53'
												wrap='hard' required></textarea>
					<h3>Referência Bibliográfica</h3>
					<h4>Copie e cole a referência bibliográfica em língua portuguêsa de sua monografia</h4>
					<textarea type='text' class="form-control" name='referencia' value='<?php echo $fic['referenciaFicha']?>' rows='8' cols='53'
												wrap='hard' required></textarea>
					<div class="form-group">
						<div>
							<h3>E-mail para contato</h3>
							<h4>Exemplo: usuario@email.com</h4>
							<input type='email' class="form-control" name='email' size='20' value='<?php echo $usu['emailUsuario']?>' maxlength='45' required>
						</div>
						<div>
							<h3>Telefone para contato com DDD</h3>
							<h4>Exemplo: 199xxxx-xxxx</h4>
							<input type='text' class="form-control" name='telefone' size='14' maxlength='11' value='<?php echo $usu['telefone']?>' required>
						</div>
					</div>	
					<h3>Sugestões e críticas</h3>
					<textarea type='text' class="form-control" value='<?php echo $fic['sujestaoFicha']?>' name='sc' rows='6' cols='53' maxlength='200'
												wrap='hard' required></textarea>
					<h1>Informações importantes</h1>
					<h4>A data limite de entrega da monografia na Biblioteca seguirá a prescrita pela Coordenadorias do Cursos impreterivelmente
					É obrigatória a retirada deste formulário na Biblioteca em versão impressa em uma via, como comprovação de sua quitação de depósito da monografia, a qual será concedida após confirmação do envio da monografia via digital em versão .doc para o e-mail f004bibli@cps.sp.gov.br - Assunto: TCC seu nome (Ex. TCC João da Silva)
					Será aceito o formulário após confirmação do envio da monografia via e-mail
					Será aceito o formulário após confirmação de nenhuma pendência de devolução de material bibliográfico retirado por empréstimo na Biblioteca
					A responsabilidade pelos dados fornecidos é do autor que deve estar seu orientador em consonância</h4>
					<h3>Atesto que todas as eventuais correções solicitadas pela banca examinadora foram realizadas, enviando por meio eletrônico indicado, a versão final e absolutamente correta</h3>
					<p><input type='radio' name='sim' value='confirmado' size='20' required>Sim</p>
					<br>
					<input type='hidden' class="form-control" name='codigo' value='$usu[idusuarios]'>
				<?php
					if($usu["envioUsuario"] == "desautorizado"){
					echo"
						<input type='submit' value='Atualizar' class='btn' name='atualizar'><br>";
					}else if($usu["envioUsuario"] == ""){
					echo"
						<input type='submit' value='Cadastrar' class='btn' name='enviar'>
					";
					}			
					}else{
					header('location: login.php');
					}
				?>
				</form>	
			</div>
		</main>
		<?php include_once('./components/MainFooter.php') ?>

		<script>
		
		document.getElementById('tccFile')
			.addEventListener('change', function(e){
				var filename = document.getElementById('filename')
				filename.style.display = "initial"
				filename.innerText = this.files[0].name
			})
		
		</script>
	</body>
</html>
