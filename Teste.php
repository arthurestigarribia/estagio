<?php
    $connect = mysqli_connect('localhost', 'root', '', 'alunos') or die(mysqli_error('Não foi possível conectar ao banco de dados.'));

    function geraGrupo($pontuacao) {
		switch ($pontuacao) {
			case $pontuacao < 25.00: return 4;
			case $pontuacao < 50.00: return 3;
			case $pontuacao < 75.00: return 2;
			case $pontuacao < 100.00: return 1;
			default: return 0;
		}
	}

    for ($i = 12345678; $i < 12345778; $i++) {
        $matricula = $i;

        $nome = "00000000";
		$nascimento = "2000-01-01";
		$sexo = "masculino";

		$endereco = "Rua A, 444, Cassino";
		$cidade = 'Pelotas, RS';

		$rg = '0000000000';
		$cpf = '00000000000';

		$telefone = '55555555555';
		$email = '00@gmail.com';

		$modalidade = 'm01';
		$curso = 'c01';
		$periodo = 6;

		$banco = 'privatizado';
		$agencia = '0000000000000';
		$conta = '1111111111';
		$protocolo = '234567889';
		$pontuacao = 22.25;
			
		$grupo = geraGrupo($pontuacao);

        $query = "INSERT INTO alunos (matricula, nome, nascimento, sexo, endereco, cidade, rg, cpf, telefone, email, modalidade, curso, periodo, banco, agencia, conta, protocolo, pontuacao, grupo)" .
					" VALUES ('" . $matricula . "', '" . $nome . "', '" . $nascimento . "', '" . $sexo . "', '" . $endereco . "', '" . $cidade . 
					"', '" . $rg . "', '" . $cpf . "', '" . $telefone . "', '" . $email . "', '" . $modalidade . "', '" . $curso . 
					"', '" . $periodo . "', '" . $banco . "', '" . $agencia . "', '" . $conta . "', '" . $protocolo . "', '" . $pontuacao . "', '" . $grupo . "')";
		$insert = mysqli_query($connect, $query) or die(mysqli_error());
    }
?>