<?php
	session_start();

	$connect = mysqli_connect('localhost', 'root', '', 'alunos') or die(mysqli_error('Não foi possível conectar ao banco de dados.'));

	$dados = mysqli_query($connect, "DELETE FROM alunos WHERE matricula = " . $_GET['matricula']);
	$linha = mysqli_fetch_assoc($dados);

	header("Location:Home.php");
?>