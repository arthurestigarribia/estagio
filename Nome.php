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
	<a type="button" class="waves-effect waves-teal btn-flat" href="Home.php">Voltar</a>

	<form action="Home.php" method="post">
		<?php
			$connect = mysqli_connect('localhost', 'root', '', 'alunos') or die(mysqli_error('Não foi possível conectar ao banco de dados.'));

            $dados = mysqli_query($connect, 'SELECT matricula, nome, sobrenome, modalidade, curso, periodo FROM alunos WHERE matricula = ' . $_GET['matricula'] . ';') or die(mysqli_error('Erro ao conectar ao banco de dados.'));
			$linha = mysqli_fetch_assoc($dados); //Erro: Warning: mysqli_error() expects parameter 1 to be mysqli, string given in C:\xampp\htdocs\estagio\Nome.php on line 33
			
            echo "<h4>" . $linha['matricula'] . " - " . $linha['nome'] . " " . $linha['sobrenome'] . "</h4>";

            $p = "";

            switch ($linha['modalidade']) {
                case 'm01':
                    $p = "Integrado";
                break;
                case 'm02':
                    $p = "Subsequente";
                break;
                case 'm03':
                    $p = "Superior";
                break;
                case 'm04':
                    $p = "Tecnólogo";
                break;
                case 'm05':
                    $p = "Proeja";
                break;
            }

            $c = "";

            switch($linha['curso']) {
                case 'c01': $c = 'Eletrotécnica';
                break;

                case 'c02': $c = 'Refrigeração e Climatização';
                break;

                case 'c03': $c = 'Informática para Internet';
                break;

                case 'c04': $c = 'Geoprocessamento';
                break;

                case 'c05': $c = 'Automação Industrial';
                break;

                case 'c06': $c = 'Fabricação Mecânica';
                break;

                case 'c07': $c = 'Enfermagem';
                break;

                case 'c08': $c = 'Análise e Desenvolvimento de Sistemas';
                break;

                case 'c09': $c = 'Construção de Edifícios';
                break;

                case 'c10': $c = 'Formação Pedagógica de Docentes';
                break;

                case 'c11': $c = 'Proeja';
                break;
            }

            echo $linha['periodo'] . "º período do Curso " . $p . " em " . $c;

            echo '<br><a type="button" class="waves-effect waves-teal btn-flat" href="Update.php?matricula=' . $_GET['matricula'] . '">Editar</a><a type="button" class="waves-effect waves-teal btn-flat" href="Delete.php?matricula=' . $_GET['matricula'] . '">Excluir</a>'

		?>
	</form>
</body>
</html>