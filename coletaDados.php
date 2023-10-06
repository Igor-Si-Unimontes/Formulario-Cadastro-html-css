<!DOCTYPE html>
<html>

<head>
    <title>SBAT - Sistema de Solicitação de Bolsa Auxílio-Tecnologia</title>
</head>

<body>
    <h1>SBAT - SISTEMA DE SOLICITAÇÃO DE BOLSA AUXÍLIO-TECNOLOGIA</h1>

    <?php
    require_once 'conexao.php';


    print("<h1>Resultado da consulta</h1>");
    print "<strong>CPF:</strong>";
    print($_POST['cpf'] . "<br>");
    print "<strong>Nome completo:</strong> ";
    print($_POST['name'] . "<br>");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $year = $_POST["year"]; 
    
        $dataNasc = new DateTime($year);
        $dataAtual = new DateTime(date('Y-m-d'));
        $idade = $dataNasc->diff($dataAtual)->format('%Y anos');
    
        echo "<strong>Idade</strong>: " . $idade . "<br>";
    }
    
    $cep = $_POST['cep'];
    $retorno = json_decode(file_get_contents("https://viacep.com.br/ws/$cep/json/"));
    print("<strong>Logradouro:</strong> " . $retorno->logradouro . "<br>");
    if ($retorno->complemento <> "") {
        print("<strong>Complemento</strong>: " . $retorno->complemento . "<br>");
    }
    print("<strong>Bairro:</strong> " . $retorno->bairro . "<br>");
    print("<strong>Cidade: </strong>" . $retorno->localidade . "<br>");
    print("<strong>Estado: </strong>" . $retorno->uf . "<br>");
    print("<strong>Número da residência:</strong>");
    print($_POST['numberhouse'] . "<br>");
    print("<strong>Telefone:</strong>");
    print($_POST['number'] . "<br>");
    print("<strong>E-mail:</strong>");
    print($_POST['email'] . "<br>");
    $computador = isset($_POST['computador']);
    $Celular = isset($_POST['Celular']);
    $notebook = isset($_POST['notebook']);


    print("<strong>Renda:</strong>");
    print($_POST['salary'] . "<br>");
    $salary = ($_POST['salary']);
    
    date_default_timezone_set('America/Sao_Paulo');
    $dataHora = date('d/m/Y H:i:s');

    if ($idade > 65 && $salary < 3000) {
        $mensagem = "Você tem direito a 1 smartphone";
    } elseif ($salary < 1000) {
        $mensagem = "Você tem direito a 1 notebook e 1 smartphone";
    } elseif ($idade < 18 || $salary > 3000) {
        $mensagem = "Você não tem direito a nenhum dos itens";
    } else {
        $mensagem = "Você tem direito a 1 notebook";
    }


    print "<p><strong>Data e hora do preenchimento:</strong> $dataHora</p>";
    print "<p><strong>Status da solicitação:</strong> $mensagem</p>";


    print "<p><strong>Leve este comprovante, um documento com foto, e procure o almoxarifado para retirada.</strong></p>";
    ?>
    <div id="divButton"></div>
    <button id="b2" name="b2">Imprimir</button>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script>
        $('#b2').click(function(){
            document.getElementById('b2').setAttribute('hidden', '');
            window.print();
            document.getElementById("divButton").innerHTML = "";
            document.getElementById('b2').removeAttribute('hidden');
        })
        </script>

</body>

</html>