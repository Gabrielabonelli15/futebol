<?php
require '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $cidade = $_POST['cidade'];

    if (!$nome || !$cidade) {
        $erro = "Nome e cidade são obrigatórios.";
    } else {
        $stmt = $pdo->prepare("INSERT INTO times (nome, cidade) VALUES (?, ?)");
        $stmt->execute([$nome, $cidade]);
        header("Location: index.php");
        exit;
    }
}
?>

<form method="post">
    <input name="nome" placeholder="Nome do time" required>
    <input name="cidade" placeholder="Cidade" required>
    <button type="submit">Salvar</button>
</form>
<?= $erro ?? '' ?>
