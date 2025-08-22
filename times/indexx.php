<?php
require '../config/db.php';

$filtro = $_GET['filtro'] ?? '';
$page = $_GET['page'] ?? 1;
$limit = 10;
$offset = ($page - 1) * $limit;

$stmt = $pdo->prepare("SELECT * FROM times WHERE nome LIKE ? LIMIT $limit OFFSET $offset");
$stmt->execute(["%$filtro%"]);
$times = $stmt->fetchAll();
?>

<h1>Times</h1>
<form method="get">
    <input type="text" name="filtro" placeholder="Filtrar por nome" value="<?= htmlspecialchars($filtro) ?>">
    <button type="submit">Filtrar</button>
</form>

<a href="create.php">Novo Time</a>

<table>
    <tr><th>Nome</th><th>Cidade</th><th>Ações</th></tr>
    <?php foreach ($times as $time): ?>
        <tr>
            <td><?= $time['nome'] ?></td>
            <td><?= $time['cidade'] ?></td>
            <td>
                <a href="edit.php?id=<?= $time['id'] ?>">Editar</a> |
                <a href="delete.php?id=<?= $time['id'] ?>" onclick="return confirm('Confirmar exclusão?')">Excluir</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
