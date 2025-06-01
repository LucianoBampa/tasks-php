<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once("conexao.php");

$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';

if ($email && $senha) {
    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = :email LIMIT 1");
    $stmt->execute([':email' => $email]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario && password_verify($senha, $usuario['senha'])) {
        $_SESSION['usuario'] = [
            'id' => $usuario['id'],
            'nome' => $usuario['nome'],
            'email' => $usuario['email']
        ];
        header("Location: index.php");
        exit;
    } else {
        header("Location: login.php?erro=1");
        exit;
    }
} else {
    header("Location: login.php?erro=2");
    exit;
}
?>
