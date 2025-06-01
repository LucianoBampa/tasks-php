<?php include 'header.php'; ?>
<?php include 'conexao.php'; ?>

<?php
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "<p>ID inválido.</p>";
    exit;
}

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM usuarios WHERE id = :id");
$stmt->execute([':id' => $id]);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$usuario) {
    echo "<p>Usuário não encontrado.</p>";
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'] ?? '';
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';

    if ($nome && $email) {
        if ($senha) {
            // Atualiza nome, email e senha
            $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("UPDATE usuarios SET nome = :nome, email = :email, senha = :senha WHERE id = :id");
            $stmt->execute([
                ':nome' => $nome,
                ':email' => $email,
                ':senha' => $senhaHash,
                ':id' => $id
            ]);
        } else {
            // Atualiza apenas nome e email
            $stmt = $pdo->prepare("UPDATE usuarios SET nome = :nome, email = :email WHERE id = :id");
            $stmt->execute([
                ':nome' => $nome,
                ':email' => $email,
                ':id' => $id
            ]);
        }

        header("Location: usuarios.php");
        exit;
    } else {
        echo "<p>Preencha todos os campos.</p>";
    }
}

?>

<main>
    <h1>Editar Usuário</h1>
    <form method="POST">
        <p>
            <label>Nome</label><br>
            <input type="text" name="nome" value="<?= htmlspecialchars($usuario['nome']) ?>" required>
        </p>

        <p>
            <label>Email</label><br>
            <input type="email" name="email" value="<?= htmlspecialchars($usuario['email']) ?>" required>
        </p>

        <p>
            <label>Senha</label><br>
            <input type="password" name="senha" autocomplete="new-password">
        </p>

        <input type="submit" value="Salvar">
        <a href="usuarios.php" class="btn-cancelar">Cancelar</a>

    </form>
</main>

<?php include 'footer.php'; ?>
