<?php
$host = "localhost";
$dbname = "meu_banco";
$username = "root";
$password = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
/*
    // Função para criar tabela
    function criarTabelaUsuarios($pdo) {
        $sql = "CREATE TABLE IF NOT EXISTS usuarios (
            id INT AUTO_INCREMENT PRIMARY KEY,
            nome VARCHAR(100) NOT NULL,
            email VARCHAR(100) NOT NULL UNIQUE,
            senha VARCHAR(255) NOT NULL
        )";
        $pdo->exec($sql);
    }

    criarTabelaUsuarios($pdo);

    // Inserção segura com hash (executar só uma vez para evitar duplicatas)
    $usuarios = [
        ['nome' => 'João da Silva', 'email' => 'joao@example.com', 'senha' => '123456'],
        ['nome' => 'Jurema Silva', 'email' => 'jurema@example.com', 'senha' => 'senha123'],
        ['nome' => 'Luciano Bampa', 'email' => 'luciano@email.com', 'senha' => 'minhasenha']
    ];

    foreach ($usuarios as $u) {
        // Verifica se usuário já existe pelo email
        $stmtCheck = $pdo->prepare("SELECT COUNT(*) FROM usuarios WHERE email = :email");
        $stmtCheck->execute([':email' => $u['email']]);
        if ($stmtCheck->fetchColumn() == 0) {
            $senhaHash = password_hash($u['senha'], PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)");
            $stmt->execute([
                ':nome' => $u['nome'],
                ':email' => $u['email'],
                ':senha' => $senhaHash
            ]);
        }
    }

    // Exibe os dados dos usuários (sem senha)
    $stmt = $pdo->query("SELECT id, nome, email FROM usuarios");
    $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($usuarios as $usuario) {
        echo "ID: {$usuario['id']} - Nome: {$usuario['nome']} - Email: {$usuario['email']}<br>";
    }
*/
} catch (PDOException $e) {
    echo "Erro ao conectar com o banco de dados: " . $e->getMessage();
}
?>
