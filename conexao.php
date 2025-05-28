<?php

$host = "localhost";
$dbname = "meu_banco";
$username = "root";
$password = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Cria a tabela de usuários (sem hash na senha — apenas para testes!)
    $pdo->exec("CREATE TABLE IF NOT EXISTS usuarios (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nome VARCHAR(100) NOT NULL,
        email VARCHAR(100) NOT NULL UNIQUE,
        senha VARCHAR(255) NOT NULL
    )");

    // Inserção de usuários com senha em texto simples
    $usuarios = [
        ['nome' => 'João da Silva', 'email' => 'joao@example.com', 'senha' => '123456'],
        ['nome' => 'Jurema Silva', 'email' => 'jurema@example.com', 'senha' => 'senha123'],
        ['nome' => 'Luciano Bampa', 'email' => 'luciano@email.com', 'senha' => 'minhasenha']
    ];

    foreach ($usuarios as $u) {
        $stmt = $pdo->prepare("INSERT IGNORE INTO usuarios (nome, email, senha)
                            VALUES (:nome, :email, :senha)");
        $stmt->execute([
            ':nome' => $u['nome'],
            ':email' => $u['email'],
            ':senha' => $u['senha'] // Sem hash
        ]);
    }

    // Exibe os dados dos usuários
    $stmt = $pdo->query("SELECT id, nome, email FROM usuarios");
    $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($usuarios as $usuario) {
        echo "ID: {$usuario['id']} - Nome: {$usuario['nome']} - Email: {$usuario['email']}<br>";
    }

} catch (PDOException $e) {
    echo "Erro ao conectar com o banco de dados: " . $e->getMessage();
}
?>
