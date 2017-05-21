<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<title>Cadastro</title>
	<link rel="stylesheet" type="text/css" href="css/layout.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<script type="text/javascript" src="js/jquery-2.1.1.min.js"></script>
	<script type="text/javascript" src="js/materialize.min.js"></script>
	<link type="text/css" rel="stylesheet" href="css/materialize.min.css" media="screen,projection"/>
	<script type="text/javascript">
		$(document).ready(function() {
			$('select').material_select();
		});
	</script>
</head>
<body style="padding: 2.5%;">
	<header>IFRS Rio Grande - Coordenação de Assistência Estudantil</header>
	<h1>Cadastro</h1>
	<p>AVISO: como está em HTML5, isso só funcionará no Google Chrome. Dúvidas? Email: assistencia.estudantil@riogrande.ifrs.edu.br</p>
	<a type="button" class="waves-effect waves-teal btn-flat" href="Sobre.php">Sobre</a>
	<a type="button" class="waves-effect waves-teal btn-flat" href="Home.php">Home</a>
	<form name="cadastro" action="Cadastro.php" method="post" class="col s12">
		<h4>Pessoal</h4>
		<br>
		<input type="text" name="matricula" id="matricula" placeholder="Número de matrícula" minlength="8" maxlength="8" required>
		<br>
		<input type="text" name="nome" id="nome" placeholder="Nome do estudante" required>
		<br>
		<input type="date" name="nascimento" id="nascimento" placeholder="Data de nascimento" required>
		<br>
		<div class="input-field col s12">
			<select name="sexo" id="sexo">
				<option value="masculino">Masculino</option>
				<option value="feminino">Feminino</option>
			</select>
			<label>Sexo</label>
		</div>
		<br>
		<h4>Moradia</h4>
		<br>
		<input type="text" name="endereco" id="endereco" placeholder="Endereço" required>
		<br>
		<input type="text" name="cidade" id="cidade" placeholder="Cidade" required>
		<br>
		<h4>Identificação</h4>
		<br>
		<input type="text" name="rg" id="rg" placeholder="RG (sem traços nem pontos)" minlength="10" maxlength="10" required>
		<br>
		<input type="text" name="cpf" id="cpf" placeholder="CPF (sem traços nem números)" minlength="11" maxlength="11" required>
		<br>
		<h4>Contato</h4>
		<br>
		<input type="text" name="telefone" id="telefone" placeholder="Telefone (com DDD e sem parênteses)" minlength="8" maxlength="20" required>
		<br>
		<input type="text" name="email" id="email" placeholder="Email">
		<br>
		<h4>Escolar</h4>
		<br>
		<div class="input-field col s12">
			<select name="modalidade" id="modalidade">
				<option value="m01">Integrado</option>
				<option value="m02">Subsequente</option>
				<option value="m03">Tecnólogo</option>
				<option value="m04">Superior</option>
				<option value="m05">Proeja</option>
			</select>
			<label>Modalidade</label>
		</div>
		<div class="input-field col s12">
			<select id="curso" name="curso" required>
				<option value="c01">Eletrotécnica</option>
				<option value="c02">Refrigeração e Climatização</option>
				<option value="c03">Informática para Internet</option>
				<option value="c04">Geoprocessamento</option>
				<option value="c05">Automação Industrial</option>
				<option value="c06">Fabricação Mecânica</option>
				<option value="c07">Enfermagem</option>
				<option value="c08">Análise e Desenvolvimento de Sistemas</option>
				<option value="c09">Construção de Edifícios</option>
				<option value="c10">Engenharia Mecânica</option>
				<option value="c11">Formação Pedagógica de Docentes</option>
				<option value="c12">Proeja</option>
			</select>
			<label>Curso</label>
		</div>
		</select>
		<div class="input-field col s12">
			<select id="periodo" name="periodo" required>
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
				<option value="5">5</option>
				<option value="6">6</option>
			</select>
			<label>Período</label>
		</div>
		<h4>Bancário</h4>
		<br>
		<input type="text" name="banco" id="banco" placeholder="Banco" minlength="1" required>
		<br>
		<input type="text" name="agencia" id="agencia" placeholder="Agência" required>
		<br>
		<input type="text" name="conta" id="conta" placeholder="Conta" maxlength="10" required>
		<br>
		<input type="number" name="protocolo" id="protocolo" placeholder="Protocolo" required>
		<br>
		<input type="text" name="pontuacao" id="pontuacao" placeholder="Pontuação (com ponto no lugar da vírgula)" required>
		<br> 
		<input type="submit" class="waves-effect waves-teal btn-flat" id="cadastrar" name="cadastrar" value="Adicionar aluno">
	</form>

	<?php
		if (isset($_POST['cadastrar'])) {
			$nome = $_POST['nome'];
			$nascimento = $_POST['nascimento'];
			$sexo = $_POST['sexo'];

			$endereco = $_POST['endereco'];
			$cidade = $_POST['cidade'];

			$rg = $_POST['rg'];
			$cpf = $_POST['cpf'];

			$telefone = $_POST['telefone'];
			$email = $_POST['email'];

			$matricula = $_POST['matricula'];
			$modalidade = $_POST['modalidade'];
			$curso = $_POST['curso'];
			$periodo = $_POST['periodo'];

			$banco = $_POST['banco'];
			$agencia = $_POST['agencia'];
			$conta = $_POST['conta'];
			$protocolo = $_POST['protocolo'];
			$pontuacao = $_POST['pontuacao'];

			function geraGrupo($pontuacao) {
				switch ($pontuacao) {
					case $pontuacao < 25.00: return 4;
					case $pontuacao < 50.00: return 3;
					case $pontuacao < 75.00: return 2;
					case $pontuacao < 100.00: return 1;
					default: return 0;
				}
			}
			
			$grupo = geraGrupo($pontuacao);

			$connect = mysqli_connect('localhost','root', '', 'alunos') or die(mysqli_error('Não foi possível conectar ao banco de dados.'));

			$create = mysqli_query($connect, "CREATE TABLE IF NOT EXISTS alunos(
							matricula VARCHAR(8) NOT NULL PRIMARY KEY,
							nome VARCHAR(1000) NOT NULL,
							nascimento DATE NOT NULL,
							sexo VARCHAR(10) NOT NULL,
							endereco VARCHAR(1000) NOT NULL,
							cidade VARCHAR(100) NOT NULL,
							rg VARCHAR(10) NOT NULL,
							cpf VARCHAR(11) NOT NULL,
							telefone VARCHAR(20),
							email VARCHAR(100),
							modalidade VARCHAR(20) NOT NULL,
							curso VARCHAR(100) NOT NULL,
							periodo INTEGER NOT NULL,
							banco VARCHAR(100) NOT NULL,
							agencia VARCHAR(100) NOT NULL,
							conta VARCHAR(10) NOT NULL,
							protocolo VARCHAR(100) NOT NULL,
							pontuacao DECIMAL(5,2) NOT NULL,
							grupo INTEGER NOT NULL);") or die($mysql_error());

			$query_select = "SELECT matricula FROM alunos WHERE matricula = '$matricula'";
			$select = mysqli_query($connect, $query_select) or die(mysqli_error());

			$array = mysqli_fetch_array($select);
			$logarray = $array['matricula'];

			if($logarray == $matricula){
				echo"<script type='text/javascript'>alert('Essa matrícula já existe.');window.location.href='cadastro.php';</script>";
				die();
			}else{
				$query = "INSERT INTO alunos (matricula, nome, nascimento, sexo, endereco, cidade, rg, cpf, telefone, email, modalidade, curso, periodo, banco, agencia, conta, protocolo, pontuacao, grupo)" .
					" VALUES ('" . $matricula . "', '" . $nome . "', '" . $nascimento . "', '" . $sexo . "', '" . $endereco . "', '" . $cidade . 
					"', '" . $rg . "', '" . $cpf . "', '" . $telefone . "', '" . $email . "', '" . $modalidade . "', '" . $curso . 
					"', '" . $periodo . "', '" . $banco . "', '" . $agencia . "', '" . $conta . "', '" . $protocolo . "', '" . $pontuacao . "', '" . $grupo . "')";
				$insert = mysqli_query($connect, $query) or die(mysqli_error());
				
				if($insert){
					echo "<script type='text/javascript'>alert('Aluno cadastrado com sucesso! Grupo: " . $grupo . "');window.location.href='Home.php';</script>";
				}else{
					echo "<script type='text/javascript'>alert('Não foi possível cadastrar esse aluno.');window.location.href='Cadastro.php';</script>";
				}
			}
		}
	?>
</body>
</html>