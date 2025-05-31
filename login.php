
<?php include('header.php'); ?>
<?php include('conexao.php'); ?>

<?php
if (isset($_SESSION['usuario'])) {
    header('Location: index.php');
    exit;
}

$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
    $senha = $_POST['senha'] ?? '';

    if (!$email || !$senha) {
        $erro = "Preencha todos os campos.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erro = "Email inválido.";
    } else {
        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = :email");
        $stmt->execute([':email' => $email]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        // Aqui comparação direta de texto para senha sem hash
        if ($usuario && $senha === $usuario['senha']) {
            $_SESSION['usuario'] = [
                'id' => $usuario['id'],
                'nome' => $usuario['nome'],
                'email' => $usuario['email']
            ];
            header('Location: index.php');
            exit;
        } else {
            $erro = "Email ou senha inválidos!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
     <link rel="stylesheet" href="assets/main.css">
</head>
<body>
    <h1>Login</h1>
    <form method="POST" action="login.php" autocomplete="off">
        <label>Email:</label><br>
        <input type="email" name="email" required autocomplete="off"><br><br>

        <label>Senha:</label><br>
        <input type="password" name="senha" required autocomplete="new-password"><br><br>

        <button type="submit">Entrar</button>
    </form>

</body>
</html>

