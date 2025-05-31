<?php include('autorizacao_de_login.php'); ?>
<?php include 'header.php' ?>
<?php include 'conexao.php' ?>
<main>
    <h1>Tela de Cadastro</h1>
    <?php if (isset($_GET['sucesso']) && $_GET['sucesso'] == 1): ?>
        <p style="color: green;">Tarefa salva com sucesso!</p>
    <?php endif; ?>

    <form method="post" action="salvar_tarefa.php">
        <label>Nome da tarefa</label>
        <input type="text" name="tarefa_nome" placeholder="Nome da Tarefa" required/>
        <br>
        <label>Previsão</label>
        <input type="datetime-local" name="tarefa_previsao" placeholder="Previsão" required/>
        <br>
        <label>Descrição da tarefa</label>
        <textarea name="tarefa_descricao"></textarea>
        <br>
        <input type="submit" value="Salvar">
    </form>
</main>
<?php include 'footer.php' ?>
