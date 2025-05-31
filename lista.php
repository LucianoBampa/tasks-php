<?php include('autorizacao_de_login.php'); ?>
<?php include ('header.php'); ?>
<?php include ('conexao.php'); ?>

<?php
try {
    $stmt = $pdo->query("SELECT * FROM tarefas");
    $tarefas = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erro ao buscar tarefas: " . $e->getMessage();
    $tarefas = [];
}
?>


<main>
    <h1>Lista de tarefas</h1>
    <table border="1" width="100%">
    <tr>
        <th>#ID</th><th>Nome</th><th>Previsão</th><th>Descrição</th>
    </tr>
    <?php foreach ($tarefas as $tarefa): ?>
        <tr>
            <td>#<?= $tarefa['id'] ?></td>
            <td><?= $tarefa['nome'] ?></td>
            <td><?= $tarefa['previsao'] ?></td>
            <td><?= $tarefa['descricao'] ?></td>
            <td>
                <a href="editar.php?id=<?= $tarefa['id'] ?>">Editar</a> |
                <a href="deletar.php?id=<?= $tarefa['id'] ?>">Excluir</a>
            </td>
        </tr>        
    <?php endforeach; ?>
    </table>
</main>


<?php include 'footer.php'; ?>
