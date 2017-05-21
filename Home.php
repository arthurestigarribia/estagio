<?php
	if ($_GET['page'] === null) header("location:?page=1");
	session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<title> Cadastro </title>
	<link rel="stylesheet" type="text/css" href="css/layout.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<script type="text/javascript" src="js/jquery-2.1.1.min.js"></script>
	<script type="text/javascript" src="js/materialize.min.js"></script>
	<link type="text/css" rel="stylesheet" href="css/materialize.min.css" media="screen,projection"/>
</head>
<body style="padding: 2.5%;">
	<header>IFRS Rio Grande - Coordenação de Assistência Estudantil</header>
	<h1>Lista</h1>
	<p>AVISO: como está em HTML5, isso só funcionará no Google Chrome. Dúvidas? Email: assistencia.estudantil@riogrande.ifrs.edu.br</p>
	<a type="button" class="waves-effect waves-teal btn-flat" href="Sobre.php">Sobre</a>
	<a type="button" class="waves-effect waves-teal btn-flat" href="Cadastro.php">Cadastrar</a>
	<a type="button" class="waves-effect waves-teal btn-flat" href="GeraExcel.php">Gerar arquivo XLS</a>
	<a type="button" class="waves-effect waves-teal btn-flat" href="Busca.php">Buscar</a>
	<?php
		$connect = mysqli_connect('localhost', 'root', '', 'alunos') or die(mysqli_error('Não foi possível conectar ao banco de dados.'));

		$offset = 50 * ($_GET['page'] - 1);

		$dados = mysqli_query($connect, "SELECT * FROM alunos ORDER BY matricula LIMIT 50 OFFSET " . $offset);
		$linha = mysqli_fetch_assoc($dados);
		$total_p = mysqli_num_rows($dados);
		
		$dados2 = mysqli_query($connect, "SELECT * FROM alunos");
		$total = mysqli_num_rows($dados2);

		$paginas = $total / 50 + 1;
		$resto = $total % 50;

		echo "<br>Total de " . $total . " resultado(s) - mostrando " . $total_p . " resultado(s) a partir do resultado " . (($_GET['page'] - 1) * 50 + 1) . " ordenado por matrícula.";

		$tabela = "<table class='bordered' id='table'><thead><tr><th>Matrícula</th><th>Nome</th><th>Informações</th></tr></thead>";

		if ($total != 0) {
			do {
				$tabela .= "<tr><td>" . $linha['matricula'] . "</td><td>" . $linha['nome'] . "</td><td><a class='waves-effect waves-teal btn-flat' id='botao" . $linha['matricula'] . "' href='Nome.php?matricula=" . $linha['matricula'] . "'>Informações</a></td></tr>";
			} while ($linha = mysqli_fetch_assoc($dados));
		}

		$tabela .= "</table>";

		echo $tabela;

		if ($resto == 0) $paginas++;

		if ($_GET['page'] >= 2) echo "<a class='waves-effect waves-teal btn-flat' href='Home.php?page=" . ($_GET['page'] - 1) . "'>Anterior</a>";
		else echo "<a class='waves-effect waves-teal btn-flat'>Anterior</a>";

		if ($_GET['page'] <= $paginas) echo "<a class='waves-effect waves-teal btn-flat' href='Home.php?page=" . ($_GET['page'] + 1) . "'>Seguinte</a>";
		else echo "<a class='waves-effect waves-teal btn-flat'>Seguinte</a>";
	?>
</body>
</html>