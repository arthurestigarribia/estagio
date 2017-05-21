<?php
    $connect = mysqli_connect('localhost', 'root', '', 'alunos') or die(mysqli_error('Não foi possível conectar ao banco de dados.'));

    $busca = $_GET['termo'];

    $filtro = "(matricula LIKE '%" . strtoupper(trim($busca)) . "%' OR nome LIKE '%" . strtoupper(trim($busca)) . "%')";
    $dados = mysqli_query($connect, "SELECT * FROM alunos WHERE " . $filtro . " ORDER BY matricula");
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
    
    /*
    * Criando e exportando planilhas do Excel
    * /
    */
    // Definimos o nome do arquivo que será exportado
    $arquivo = 'planilha.xls';
    // Criamos uma tabela HTML com o formato da planilha
    $html = '';
    $html .= '<table>';
    $html .= '<tr>';

    $html .= '<td><b>Matricula</b></td>';
    $html .= '<td><b>Nome</b></td>';
    $html .= '<td><b>Nascimento</b></td>';
    $html .= '<td><b>Sexo</b></td>';
    $html .= '<td><b>RG</b></td>';
    $html .= '<td><b>CPF</b></td>';
    $html .= '<td><b>Endereço</b></td>';
    $html .= '<td><b>Cidade</b></td>';
    $html .= '<td><b>Telefone</b></td>';
    $html .= '<td><b>Email</b></td>';
    $html .= '<td><b>Modalidade</b></td>';
    $html .= '<td><b>Curso</b></td>';
    $html .= '<td><b>Periodo</b></td>';
    $html .= '<td><b>Banco</b></td>';
    $html .= '<td><b>Agencia</b></td>';
    $html .= '<td><b>Conta</b></td>';
    $html .= '<td><b>Protocolo</b></td>';
    $html .= '<td><b>Pontuação</b></td>';
    $html .= '<td><b>Grupo</b></td>';
    
    $html .= '</tr>';

    do{
        $html .= '<tr>';
        
        $html .= '<td>' . $linha['matricula'] . '</td>';
        $html .= '<td>' . $linha['nome'] . '</td>';
        $html .= '<td>' . $linha['nascimento'] . '</td>';
        $html .= '<td>' . $linha['sexo'] . '</td>';
        $html .= '<td>' . $linha['rg'] . '</td>';
        $html .= '<td>' . $linha['cpf'] . '</td>';
        $html .= '<td>' . $linha['endereco'] . '</td>';
        $html .= '<td>' . $linha['cidade'] . '</td>';
        $html .= '<td>' . $linha['telefone'] . '</td>';
        $html .= '<td>' . $linha['email'] . '</td>';
        $html .= '<td>' . $p . '</td>';
        $html .= '<td>' . $c . '</td>';
        $html .= '<td>' . $linha['periodo'] . '</td>';
        $html .= '<td>' . $linha['banco'] . '</td>';
        $html .= '<td>' . $linha['agencia'] . '</td>';
        $html .= '<td>' . $linha['conta'] . '</td>';
        $html .= '<td>' . $linha['protocolo'] . '</td>';
        $html .= '<td>' . $linha['pontuacao'] . '</td>';
        $html .= '<td>' . $linha['grupo'] . '</td>';
        
        $html .= '</tr>';
    }while($linha = mysqli_fetch_assoc($dados));

    $html .= '</table>';

    $arquivo = "lista.xls";

    // Configurações header para forçar o download
    
    header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
    header ("Cache-Control: no-cache, must-revalidate");
    header ("Pragma: no-cache");
    header ("Content-type: application/x-msexcel");
    header ("Content-Disposition: attachment; filename=lista.xls");
    header ("Content-Description: PHP Generated Data");
    // Envia o conteúdo do arquivo
    echo $html;
    exit;

    header("Location:lista.xls");
?>