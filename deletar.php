<?php
$host = "localhost";
$dbname = "meu_banco";
$username = "root";
$password = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $stmt = $pdo->prepare("DELETE FROM tarefas WHERE id = :id");
        $stmt->execute([':id' => $_GET['id']]);
    }
    header("Location: lista.php");
    exit;

} catch (PDOException $e) {
    echo "<p>Erro: " . $e->getMessage() . "</p>";
    exit;
}
?>
