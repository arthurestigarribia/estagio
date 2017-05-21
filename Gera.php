<?php
    $connect = mysqli_connect('localhost', 'root', '', 'alunos') or die(mysqli_error('Não foi possível conectar ao banco de dados.'));

    $dados = mysqli_query($connect, 'SELECT * FROM alunos WHERE matricula = ' . $_GET['matricula'] . ';') or die(mysqli_error('Erro ao conectar ao banco de dados.'));
	$linha = mysqli_fetch_assoc($dados);

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
    
    include('mpdf/mpdf.php');
    $mpdf = new mPDF();

    $mpdf->setTitle('Relatorio' . $_GET['matricula']);
    $mpdf->setAuthor('IFRS Rio Grande');

    $mpdf->WriteHTML('<h1>Relatório do Beneficiário</h1>');
    
    $mpdf->WriteHTML('<h2>Pessoal</h2>');
    $mpdf->WriteHTML('Nome: ' . $linha['nome'] . '<br>');
    $mpdf->WriteHTML('Nascimento: ' . $linha['nascimento'] . '<br>');
    $mpdf->WriteHTML('Sexo: ' . $linha['sexo'] . '<br>');

    $mpdf->WriteHTML('<h2>Documental</h2>');
    $mpdf->WriteHTML('RG: ' . $linha['rg'] . '<br>');
    $mpdf->WriteHTML('CPF: ' . $linha['cpf'] . '<br>');

    $mpdf->WriteHTML('<h2>Contato</h2>');
    $mpdf->WriteHTML('Endereço: ' . $linha['endereco'] . ' - ' . $linha['cidade'] . '<br>');
    $mpdf->WriteHTML('Telefone: ' . $linha['telefone'] . '<br>');
    $mpdf->WriteHTML('Email: ' . $linha['email'] . '<br>');

    $mpdf->WriteHTML('<h2>Estudantil</h2>');
    $mpdf->WriteHTML('Matricula: ' . $linha['matricula'] . '<br>');
    $mpdf->WriteHTML('Período: ' . $p . '<br>');
    $mpdf->WriteHTML('Curso: ' . $c . '<br>');

    $mpdf->WriteHTML('<h2>Bancário</h2>');
    $mpdf->WriteHTML('Banco: ' . $linha['banco'] . '<br>');
    $mpdf->WriteHTML('Agência: ' . $linha['agencia'] . '<br>');
    $mpdf->WriteHTML('Conta: ' . $linha['conta'] . '<br>');
    $mpdf->WriteHTML('Protocolo: ' . $linha['protocolo'] . '<br>');

    $mpdf->WriteHTML('<h2>Beneficiário</h2>');
    $mpdf->WriteHTML('Pontuação: ' . $linha['pontuacao'] . '<br>');
    $mpdf->WriteHTML('Grupo: ' . $linha['grupo'] . '<br>');

    $mpdf->Output();
    exit();

    header("Location:relatorio" . $_GET['matricula'] . ".pdf");
?>