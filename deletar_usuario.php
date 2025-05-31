<?php include 'conexao.php'; ?>

<?php
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $stmt = $pdo->prepare("DELETE FROM usuarios WHERE id = :id");
    $stmt->execute([':id' => $_GET['id']]);
}

header("Location: usuarios.php");
exit;
?>
