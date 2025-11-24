<?php
include 'database.php';

$descricao = $_POST['descricao'];
$data = $_POST['data'];

$stmt = $db->prepare("INSERT INTO tarefas (descricao, data_vencimento) VALUES (?, ?)");
$stmt->execute([$descricao, $data]);

header("Location: index.php");
exit;
?>
