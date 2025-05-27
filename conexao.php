<?php

$host = "localhost";
$dbname = "meu_banco";
$username = "root";
$password = "";

try {
    // Cria (ou abre) a conexão com o banco de dados MySQL
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);

    // Define o modo de erro para exceções
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Criação de uma tabela exemplo
    $pdo->exec("CREATE TABLE IF NOT EXISTS usuarios (
        id INTEGER PRIMARY KEY AUTO_INCREMENT,
        nome VARCHAR(100),
        email VARCHAR(100)
    )");

    /*
    // Limpa todos os dados e reseta o autoincremento
    $pdo->exec("DELETE FROM usuarios");
    */

    // Inserção de dados (sem duplicar)
    $stmt = $pdo->prepare("INSERT INTO usuarios (nome, email) VALUES (:nome, :email)");
    $stmt->execute([
        ':nome' => 'João da Silva',
        ':email' => 'joao@example.com'
    ]);
    $stmt->execute([
        ':nome' => 'Jurema Silva',
        ':email' => 'jurema@example.com'
    ]);
    $stmt->execute([
        ':nome' => 'Fofão e Garibaldo',
        ':email' => 'fgproducoes@example.com'
    ]);
        
    // Atualiza o nome do usuário com id=?
    $stmt = $pdo->prepare("UPDATE usuarios SET nome = :nome WHERE id = :id");
    $stmt->execute([
        ':nome' => 'Luciano Bampa',
        ':id' => 32
    ]);
        

    // Exclusão de um usuário com ID ?(antes do SELECT)
    $stmt = $pdo->prepare("DELETE FROM usuarios WHERE id = :id");
    $stmt->execute([':id' => 35]);

    // Leitura dos dados
    $stmt = $pdo->query("SELECT * FROM usuarios");
    $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($usuarios as $usuario) {
        echo "ID: {$usuario['id']} - Nome: {$usuario['nome']} - Email: {$usuario['email']}<br>";
    }

} catch (PDOException $e) {
    echo "Erro ao conectar com o banco de dados: " . $e->getMessage();
}
?>
