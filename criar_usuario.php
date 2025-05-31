<?php include 'autorizacao_de_login.php'; ?>
<?php include 'header.php'; ?>

<main>
    <h1>Criar Usuário</h1>
    <form method="post" action="salvar_usuario.php" autocomplete="off">
        <label>Nome:</label>
        <input type="text" name="nome" required><br>

        <label>Email:</label><br>
        <input type="email" name="email" required autocomplete="off"><br><br>

        <label>Senha:</label><br>
        <input type="password" name="senha" required autocomplete="new-password"><br><br>


        <input type="submit" value="Cadastrar">
    </form>
</main>
<?php include 'footer.php'; ?>
