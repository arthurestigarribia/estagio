<?php
	session_start();
?>
<html>
<head>
	<meta charset="UTF-8">
	<title> Cadastro </title>
	<link rel="stylesheet" type="text/css" href="css/layout.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<script type="text/javascript" src="js/jquery-2.1.1.min.js"></script>
	<script type="text/javascript" src="js/materialize.min.js"></script>
	<link type="text/css" rel="stylesheet" href="css/materialize.min.css" media="screen,projection"/>
</head>
<body>
	<header>IFRS Rio Grande - Coordenação de Assistência Estudantil</header>
	<h1>Cadastro</h1>
	<p>AVISO: como está em HTML5, isso só funcionará no Google Chrome. Dúvidas? Email: assistencia.estudantil@riogrande.ifrs.edu.br</p>
	<a type="button" class="waves-effect waves-teal btn-flat" href="Cadastro.php">Cadastrar</a>

	<form action="Home.php" method="post">
		<?php
			$connect = mysqli_connect('localhost', 'root', '', 'alunos') or die(mysqli_error('Não foi possível conectar ao banco de dados.'));

			$dados = mysqli_query($connect, "SELECT * FROM alunos ORDER BY matricula");
			$linha = mysqli_fetch_assoc($dados);
			$total = mysqli_num_rows($dados);

			echo $total . " resultado(s).";

			$tabela = "<table class='bordered' id='table'><thead><tr><th>Matrícula</th><th>Nome</th><th>Informações</th></tr></thead>";

			if ($total != 0) {
				do {
					$tabela .= "<tr><td>" . $linha['matricula'] . "</td><td>" . $linha['nome'] . " " . $linha['sobrenome'] . "</td><td><a class='waves-effect waves-teal btn-flat' id='botao" . $linha['matricula'] . "' href='Nome.php?matricula=" . $linha['matricula'] . "'>Informações</a></td></tr>";
				} while ($linha = mysqli_fetch_assoc($dados));
			}

			$tabela .= "</table>";

			echo $tabela;
		?>
	</form>
</body>
</html>