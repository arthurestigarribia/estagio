<?php
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
	<h1>Busca</h1>
	<p>AVISO: como está em HTML5, isso só funcionará no Google Chrome. Dúvidas? Email: assistencia.estudantil@riogrande.ifrs.edu.br</p>
    <a type="button" class="waves-effect waves-teal btn-flat" href="Sobre.php">Sobre</a>
	<a type="button" class="waves-effect waves-teal btn-flat" href="Home.php">Voltar</a>
    <form action="Busca.php?page=1" method="post">
        <input type="text" name="termo" id="termo" placeholder="Termo de busca" required>
        <input type="submit" class="waves-effect waves-teal btn-flat" id="buscar" name="buscar" value="Busca">
        <br>
		<?php
			if (isset($_POST['buscar'])) {
                $connect = mysqli_connect('localhost', 'root', '', 'alunos') or die(mysqli_error('Não foi possível conectar ao banco de dados.'));

                echo "<a type='button' class='waves-effect waves-teal btn-flat' href='GeraExcelBusca.php?termo=" . $_POST['termo'] . "'>Gerar arquivo XLS</a>";

                $busca = $_POST['termo'];

                if($_GET['page'] === null) $_GET['page'] = 1;

                $offset = 50 * ($_GET['page'] - 1);

                $filtro = "(matricula LIKE '%" . strtoupper(trim($busca)) . "%' OR nome LIKE '%" . strtoupper(trim($busca)) . "%')";
                $dados = mysqli_query($connect, "SELECT * FROM alunos WHERE " . $filtro . " ORDER BY matricula LIMIT 50 OFFSET " . $offset);

                $linha = mysqli_fetch_assoc($dados);
		        $total_p = mysqli_num_rows($dados);
		
		        $dados2 = mysqli_query($connect, "SELECT * FROM alunos WHERE " . $filtro . " ORDER BY matricula");
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
            } else {
                echo "<br>Procure por nome ou matrícula digitando no campo de busca.";
            }
		?>
	</form>
</body>
</html>