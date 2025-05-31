<?php
include 'header.php';

$host = "localhost";
$dbname = "meu_banco";
$username = "root";
$password = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Se for edição, busca tarefa pelo ID
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $stmt = $pdo->prepare("SELECT * FROM tarefas WHERE id = :id");
        $stmt->execute([':id' => $_GET['id']]);
        $tarefa = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$tarefa) {
            echo "<p style='color:red;'>Tarefa não encontrada.</p>";
            exit;
        }
    } else {
        echo "<p style='color:red;'>ID inválido.</p>";
        exit;
    }

    // Processa o formulário
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'] ?? '';
        $nome = $_POST['tarefa_nome'] ?? '';
        $previsao = $_POST['tarefa_previsao'] ?? '';
        $descricao = $_POST['tarefa_descricao'] ?? '';

        if (!empty($id) && !empty($nome) && !empty($previsao) && !empty($descricao)) {
            $stmt = $pdo->prepare("UPDATE tarefas SET nome = :nome, previsao = :previsao, descricao = :descricao WHERE id = :id");
            $stmt->execute([
                ':nome' => $nome,
                ':previsao' => $previsao,
                ':descricao' => $descricao,
                ':id' => $id
            ]);
            header("Location: lista.php");
            exit;
        } else {
            echo "<p style='color:red;'>Preencha todos os campos.</p>";
        }
    }

} catch (PDOException $e) {
    echo "<p>Erro: " . $e->getMessage() . "</p>";
    exit;
}
?>

<main>
    <h1>Editar Tarefa</h1>
    <form method="POST">
        <input type="hidden" name="id" value="<?= htmlspecialchars($tarefa['id']) ?>">

        <p>
            <label>Nome da tarefa</label><br>
            <input type="text" name="tarefa_nome" value="<?= htmlspecialchars($tarefa['nome']) ?>" required>
        </p>

        <p>
            <label>Previsão</label><br>
            <input type="date" name="tarefa_previsao" value="<?= htmlspecialchars($tarefa['previsao']) ?>" required>
        </p>

        <p>
            <label for="descricao">Descrição</label><br>
            <textarea name="tarefa_descricao" id="descricao" rows="5" cols="50" required><?= htmlspecialchars($tarefa['descricao']) ?></textarea>
        </p>


        <input type="submit" value="Salvar">
        <a href="usuarios.php" class="btn-cancelar">Cancelar</a>
    </form>
</main>

<?php include 'footer.php'; ?>
