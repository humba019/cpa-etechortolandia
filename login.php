<?php

session_start();

if (isset($_SESSION['nome'])) {	
	header('location: solicitar.php');
}

?>
<html>
	<head>
		<title>Login • CPA</title>
		<meta charset='utf-8'>
		<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#656565">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login • CPA</title>
    <!-- CSS -->
    <link rel="stylesheet" href="./css/master.css">
    <link rel="stylesheet" href="./css/forms.css">
		<link rel="stylesheet" media="(max-width: 680px)" href="./css/responsive.css">
		
		<!-- Font Awesome -->
		<script src="https://use.fontawesome.com/43f21fbb10.js"></script>
  </head>
	</head>
	<body>

	<main class='content-container'>
		<header class="content-header">
			<a href="./" class="lnk-voltar">
				<i class="fa fa-arrow-left"></i> Voltar
			</a>
			<h1>Acesse sua Conta</h1>
		</header>
		<div class="content-body login-container">
			<form action='loga.php' method='POST' class="form-login" id="formLogin">
				<?php if(isset($_SESSION['acesso-negado'])): ?>
					<span class="txt-error">Acesso Negado. Verifique o Login e a Senha</span>
				<?php endif ?>
				<br>
				<label>Tipo de Acesso</label><br>
				<select class="form-control" name='tipo' required>
					<option value='aluno' selected>Aluno</option>
					<option value='professor'>Professor</option>
				</select>
				<br>
				<br>
				<div>
					<label>Usuário</label><br>
					<input class="form-control" type='text' size='15' maxlength='15' placeholder="Digite seu Login" name='login' required>
				</div>
				<br>
				<div>
					<label>Senha</label><br>
					<input class="form-control" type='password' size='13' maxlength='10' placeholder="Digite sua Senha" name='senha' required>
				</div>
				<br>
				<button class="btn btn-login-account">
					<i class="fa fa-sign-in"></i>Entrar
				</button>
			</form>
		</div>
	</main>

	<?php require_once('./components/MainFooter.php') ?>

	<script>
	
		var formLogin = document.getElementById("formLogin"),
				tiposLogin = ["aluno", "professor"]

		window.onload = function(){
			var tipoLogin = localStorage.getItem("cpaTipoLogin")
			if(tipoLogin && tiposLogin.indexOf(tipoLogin) != -1){
				formLogin.tipo.value = tipoLogin;
			}
		}

		formLogin
			.addEventListener("submit", function(){
				localStorage.setItem("cpaTipoLogin", this.tipo.value);
		})
	
	</script>

	</body>
</html>