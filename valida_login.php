<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once("conexao.php");

$email = $_POST['email'];
$senha = $_POST['senha'];

$sql = "SELECT * FROM usuarios WHERE email = '$email' LIMIT 1";
$result = mysqli_query($conexao, $sql);
$usuario = mysqli_fetch_assoc($result);

if ($usuario && password_verify($senha, $usuario['senha'])) {
    $_SESSION['usuario'] = $usuario['nome'];
    header("Location: index.php");
    exit;
} else {
    header("Location: login.php?erro=1");
    exit;
}
?>
