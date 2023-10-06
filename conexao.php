<?php
$endereco = 'localhost';
$banco = 'Cadastro';
$usuario = 'postgres';
$senha = '22072003';

try {
    $pdo = new PDO("pgsql:host=$endereco;port=5432;dbname=$banco", $usuario, $senha, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    echo "Conectado no bd";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $cpf = $_POST['cpf'];
        $nome = $_POST['name'];
        $cep = $_POST['cep'];
        $numero_residencia = $_POST['numberhouse'];
        $telefone = $_POST['number'];
        $email = $_POST['email'];
        $salario = $_POST['salary'];

        // Crie uma consulta SQL de inserção
        $sql = "INSERT INTO dados_pessoais (cpf, nome, cep, numero_residencia, telefone, email, salario) VALUES (:cpf, :nome, :cep, :numero_residencia, :telefone, :email, :salario)";

        // Preparar a consulta
        $stmt = $pdo->prepare($sql);

        // Vincular parâmetros
        $stmt->bindParam(':cpf', $cpf);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':cep', $cep);
        $stmt->bindParam(':numero_residencia', $numero_residencia);
        $stmt->bindParam(':telefone', $telefone);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':salario', $salario);

        // Executar a consulta
        $stmt->execute();

        echo "Dados inseridos com sucesso!";
    }
} catch (PDOException $e) {
    echo "Falha ao conectar ou inserir dados: " . $e->getMessage();
    die();
}
?>
