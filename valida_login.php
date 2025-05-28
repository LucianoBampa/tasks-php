<?php
session_start();

// Conexão com o banco
$host = "localhost";
$dbname = "meu_banco";
$username = "root";
$password = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Captura dados do formulário
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';

    // Consulta pelo email
    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = :email");
    $stmt->execute([':email' => $email]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verifica se usuário existe e senha confere
    if ($usuario && $senha === $usuario['senha']) {
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['usuario_nome'] = $usuario['nome'];
        header("Location: index.php");
        exit;
    } else {
        header("Location: login.php?erro=1");
        exit;
    }

} catch (PDOException $e) {
    echo "Erro de conexão: " . $e->getMessage();
}
?>
