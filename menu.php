<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<nav>
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="cadastro.php">Cadastro de Tarefas</a></li>
        <li><a href="lista.php">Lista de Tarefas</a></li>
        <li><a href="criar_usuario.php">Novo Usuário</a></li>
        <li><a href="usuarios.php">Usuários</a></li>


        <?php if (isset($_SESSION['usuario'])): ?>
            <li><a href="logout.php">Sair</a></li>
        <?php else: ?>
            <li><a href="login.php">Login</a></li>
        <?php endif; ?>
    </ul>
</nav>
