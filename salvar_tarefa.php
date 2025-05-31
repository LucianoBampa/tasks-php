
<?php
include('conexao.php'); // usa a variável $pdo

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['tarefa_nome'] ?? '';
    $previsao = $_POST['tarefa_previsao'] ?? '';
    $descricao = $_POST['tarefa_descricao'] ?? '';

    // Formata a data no formato MySQL
    $previsao_formatada = date('Y-m-d H:i:s', strtotime($previsao));

    try {
        $stmt = $pdo->prepare("INSERT INTO tarefas (nome, previsao, descricao) VALUES (:nome, :previsao, :descricao)");
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':previsao', $previsao_formatada);
        $stmt->bindParam(':descricao', $descricao);

        $stmt->execute();

        // Redireciona com sucesso
        header("Location: cadastro.php?sucesso=1");
        exit();
    } catch (PDOException $e) {
        echo "Erro ao salvar tarefa: " . $e->getMessage();
    }
} else {
    echo "Requisição inválida.";
}
?>

