<?php
require 'database.php';

$titulo = trim($_POST['titulo'] ?? '');
$autor = trim($_POST['autor'] ?? '');
$ano = trim($_POST['ano'] ?? '');

if ($titulo === '' || $autor === '' || !ctype_digit($ano)) {
    header("Location: index.php");
    exit;
}

try {
    $stmt = $db->prepare("INSERT INTO livros (titulo, autor, ano) VALUES (:t, :a, :n)");
    $stmt->execute([
        ':t' => $titulo,
        ':a' => $autor,
        ':n' => $ano
    ]);
} catch (PDOException $e) {
    die("Erro: " . $e->getMessage());
}

header("Location: index.php");
exit;
