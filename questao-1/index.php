<?php
require 'database.php';

try {
    $consulta = $db->query("SELECT * FROM livros ORDER BY id DESC");
    $livros = $consulta->fetchAll();
} catch (PDOException $e) {
    die("Erro: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title>Sistema de Livros</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <style>
        body {
            font-family: "Segoe UI", sans-serif;
            background: #ecebff;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 850px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 14px;
            box-shadow: 0 0 10px rgba(0,0,0,0.15);
        }
        h1 {
            text-align: center;
            color: #5a2ea6;
        }
        form {
            background: #f4f1ff;
            padding: 20px;
            border-radius: 12px;
        }
        label {
            font-weight: bold;
            color: #4a2975;
        }
        input {
            width: 100%;
            padding: 8px;
            margin-top: 6px;
            margin-bottom: 14px;
            border-radius: 6px;
            border: 1px solid #bbb;
        }
        button {
            background: #5a2ea6;
            color: white;
            padding: 10px 18px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }
        button:hover {
            background: #3f1d74;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 18px;
            border-radius: 10px;
            overflow: hidden;
        }
        th {
            background: #5a2ea6;
            color: white;
            padding: 10px;
        }
        td {
            padding: 10px;
            background: #fafafa;
            border-bottom: 1px solid #e0e0e0;
        }
        tr:hover {
            background: #f1eaff;
        }
        a {
            color: #d11a2a;
            font-weight: bold;
            text-decoration: none;
        }
    </style>

    <script>
        function excluir(id, nome) {
            if (confirm("Excluir o livro: " + nome + " ?")) {
                location.href = "delete_book.php?id=" + id;
            }
        }
    </script>
</head>
<body>

<div class="container">
    <h1>Cadastro de Livros</h1>

    <form method="post" action="add_book.php">
        <label>Título</label>
        <input type="text" name="titulo" required>

        <label>Autor</label>
        <input type="text" name="autor" required>

        <label>Ano</label>
        <input type="number" name="ano" required>

        <button type="submit">Adicionar</button>
    </form>

    <h2 style="color:#5a2ea6; margin-top:25px;">Livros Registrados</h2>

    <?php if (empty($livros)): ?>
        <p>Nenhum livro encontrado.</p>
    <?php else: ?>
        <table>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Autor</th>
                <th>Ano</th>
                <th>Ações</th>
            </tr>

            <?php foreach ($livros as $l): ?>
                <tr>
                    <td><?= $l['id'] ?></td>
                    <td><?= htmlspecialchars($l['titulo']) ?></td>
                    <td><?= htmlspecialchars($l['autor']) ?></td>
                    <td><?= $l['ano'] ?></td>
                    <td>
                        <a href="#" onclick="excluir(<?= $l['id'] ?>, '<?= htmlspecialchars(addslashes($l['titulo'])) ?>')">
                            Excluir
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
</div>

</body>
</html>
