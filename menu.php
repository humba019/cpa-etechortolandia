<?php
	session_start();
	include('config.php');
	$pesquisausu=$conn->prepare("SELECT * FROM usuarios WHERE (loginUsuario = :loginUsuario)");

	$pesquisausu->bindParam(':loginUsuario', $_SESSION['nome']);

	$pesquisausu->execute();

	$usu=$pesquisausu->fetch(PDO::FETCH_ASSOC);
	?>
	<?php
	if(isset($_SESSION['nome']) && $_SESSION['tipo'] != "professor" && $usu["envioUsuario"] == ""){
	echo"
	<div class='user-info'>
		<div>
			<i class='fa fa-user'></i>
			<span>Sessão do(a) $usu[tipoUsuario](a), <b>$usu[nomedUsuario]</b>.</span>
		</div>
	</div>
	<div class='dashboard-navbar'>
		<!--<a href='fichacatalografica.php'><i class='fa fa-edit'></i>Editar Ficha Catalográfica</a>-->
		<a href='fichacatalografica.php'><i class='fa fa-plus'></i>Cadastrar Ficha Catalográfica</a>
		<a href='desloga.php' class='btn btn-encerrar-sessao'><i class='fa fa-sign-out'></i>Encerrar Sessão</a>
	</div>";

	// <a>Status de Envio: $usu[envioUsuario]</a>

	}else if(isset($_SESSION['nome']) && $_SESSION['tipo'] != "professor" && $usu["envioUsuario"] == "confirmado" || $usu["envioUsuario"] == "autorizado"){
	echo"
	<div class='user-info'>
		<div>
			<i class='fa fa-user'></i>
			<span>Sessão do(a) $usu[tipoUsuario](a), <b>$usu[nomedUsuario]</b>.</span>
		</div>
	</div>
	<div class='dashboard-navbar'>
		<a href='solicitar.php'><i class='fa fa-file'></i>Acessar Leitura da Ficha Catalográfica</a>
		<a href='desloga.php' class='btn btn-encerrar-sessao'><i class='fa fa-sign-out'></i>Encerrar Sessão</a>
	</div>
	";

	}else if(isset($_SESSION['nome']) && $_SESSION['tipo'] != "professor" && $usu["envioUsuario"] == "desautorizado"){
	echo"
	<div class='user-info'>
		<div>
			<i class='fa fa-user'></i>
			<span>Sessão do(a) $usu[tipoUsuario](a), <b>$usu[nomedUsuario]</b>.</span>
		</div>
	</div>
	<div class='dashboard-navbar'>
		<a href='fichacatalografica.php'><i class='fa fa-edit'></i>Alterar Ficha Catalográfica</a>		
		<a href='solicitar.php'><i class='fa fa-home'></i>Acessar Informações</a>
		<a href='desloga.php' class='btn btn-encerrar-sessao'><i class='fa fa-sign-out'></i>Encerrar Sessão</a>
	</div>
	<a>";

	}else if(isset($_SESSION['nome']) && $_SESSION['tipo'] == "professor"){
	echo"
	<div class='user-info'>
		<div>
			<i class='fa fa-user'></i>
			<span>Sessão do(a) $usu[tipoUsuario](a), <b>$usu[nomedUsuario]</b>.</span>
		</div>
	</div>
	<div class='dashboard-navbar'>
		<a href='leitura.php'><i class='fa fa-file'></i>Acessar Leitura das Ficha Catalográfica Cadastradas</a>
		<a href='desloga.php' class='btn btn-encerrar-sessao'><i class='fa fa-sign-out'></i>Encerrar Sessão</a>
	</div>";

	}else if(isset($_SESSION['nome']) == false){
	echo"
	<div class='dashboard-navbar'>
		<a href='solicitar.php'>Acessar Leitura/Cadastro da Ficha Catalográfica</a>
		<a href='acervo.php'>Acervo de Monografias</a>
	</div>";
	}else{
		echo"deu ruim ".$_SESSION['nome'];
	}
?>
