<?php include('autorizacao_de_login.php'); ?>
<?php include('header.php'); ?>
<?php include('conexao.php'); ?>

<?php
try {
    $stmt = $pdo->query("SELECT * FROM usuarios");
    $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erro ao buscar usuários: " . $e->getMessage();
    $usuarios = [];
}
?>

<main>
    <h1>Lista de Usuários</h1>
    <table border="1" width="100%">
        <tr>
            <th>ID</th><th>Nome</th><th>Email</th><th>Senha</th>
        </tr>
        <?php foreach ($usuarios as $usuario): ?>
            <tr>
                <td><?= $usuario['id'] ?></td>
                <td><?= htmlspecialchars($usuario['nome']) ?></td>
                <td><?= htmlspecialchars($usuario['email']) ?></td>
                <td><?= htmlspecialchars($usuario['senha']) ?></td>
                <td>
                    <a href="editar_usuario.php?id=<?= $usuario['id'] ?>">Editar</a> |
                    <a href="deletar_usuario.php?id=<?= $usuario['id'] ?>" onclick="return confirm('Tem certeza?')">Excluir</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</main>

<?php include 'footer.php'; ?>
