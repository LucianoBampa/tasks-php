<?php
session_start();

//if (isset($_SESSION['usuario_id'])) {
//    header("Location: painel.php");
//    exit;
//}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <h2>Login de Usuário</h2>

    <?php
    if (isset($_GET['erro'])) {
        echo "<p style='color:red;'>Usuário ou senha inválidos.</p>";
    }
    ?>

    <form method="post" action="valida_login.php">
        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>

        <label>Senha:</label><br>
        <input type="password" name="senha" required><br><br>

        <input type="submit" value="Entrar">
    </form>
</body>
</html>
