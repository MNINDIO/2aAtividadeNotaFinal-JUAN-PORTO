<?php
include 'database.php';

$todas = $db->query("SELECT * FROM tarefas ORDER BY concluida, data_vencimento")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Gerenciador de Tarefas</title>
    <style>
        body { font-family: Arial; background: #f0f0f0; margin: 0; padding: 0; }
        .container { width: 70%; margin: 40px auto; background: white; padding: 25px; border-radius: 10px; }
        h1 { text-align: center; margin-bottom: 25px; }
        form { display: flex; gap: 10px; margin-bottom: 25px; }
        input, button { padding: 10px; font-size: 15px; }
        table { width: 100%; border-collapse: collapse; }
        td, th { padding: 12px; border-bottom: 1px solid #ccc; }
        .ok { color: green; font-weight: bold; }
        a { text-decoration: none; padding: 6px 10px; border-radius: 5px; }
        .btn-done { background: #27ae60; color: white; }
        .btn-del { background: #c0392b; color: white; }
    </style>
</head>
<body>
<div class="container">
    <h1>Gerenciador de Tarefas</h1>

    <form action="add_tarefa.php" method="POST">
        <input type="text" name="descricao" placeholder="Descrição" required>
        <input type="date" name="data" required>
        <button type="submit">Adicionar</button>
    </form>

    <table>
        <tr>
            <th>Tarefa</th>
            <th>Vencimento</th>
            <th>Status</th>
            <th>Ações</th>
        </tr>

        <?php foreach ($todas as $t): ?>
        <tr>
            <td><?= $t['descricao'] ?></td>
            <td><?= $t['data_vencimento'] ?></td>
            <td><?= $t['concluida'] ? '<span class="ok">Concluída</span>' : 'Pendente' ?></td>
            <td>
                <?php if (!$t['concluida']): ?>
                    <a class="btn-done" href="update_tarefa.php?id=<?= $t['id'] ?>">Concluir</a>
                <?php endif; ?>
                <a class="btn-del" href="delete_tarefa.php?id=<?= $t['id'] ?>">Excluir</a>
            </td>
        </tr>
        <?php endforeach; ?>

    </table>
</div>
</body>
</html>
