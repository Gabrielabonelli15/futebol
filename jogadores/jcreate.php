<?php
require '../config/db.php';

$posicoes = ['GOL', 'ZAG', 'LAT', 'VOL', 'MEI', 'ATA'];
$times = $pdo->query("SELECT * FROM times")->fetchAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $posicao = $_POST['posicao'];
    $numero = $_POST['numero_camisa'];
    $time_id = $_POST['time_id'];

    if (!in_array($posicao, $posicoes)) {
        $erro = "Posição inválida.";
    } elseif ($numero < 1 || $numero > 99) {
        $erro = "Número da camisa inválido.";
    } else {
        $stmt = $pdo->prepare("INSERT INTO jogadores (nome, posicao, numero_camisa, time_id) VALUES (?, ?, ?, ?)");
        $stmt->execute([$nome, $posicao, $numero, $time_id]);
        header("Location: index.php");
        exit;
    }
}
?>

<form method="post">
    <input name="nome" placeholder="Nome" required>
    <select name="posicao">
        <?php foreach ($posicoes as $p): ?>
            <option value="<?= $p ?>"><?= $p ?></option>
        <?php endforeach; ?>
    </select>
    <input name="numero_camisa" type="number" min="1" max="99" required>
    <select name="time_id">
        <?php foreach ($times as $t): ?>
            <option value="<?= $t['id'] ?>"><?= $t['nome'] ?></option>
        <?php endforeach; ?>
    </select>
    <button type="submit">Salvar</button>
</form>
<?= $erro ?? '' ?>
