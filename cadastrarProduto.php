<?php
include 'config.php';

if (isset($_POST['adicionar'])) {
    $nome = $_POST['nome'];
    $idproduto = $_POST['idproduto'];
    $preco = $_POST['preco'];

    $sql = "INSERT INTO produtos (nome, idproduto, preco) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nome, $idproduto, $preco]);
    header("Location: editar.php");
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Produto</title>
</head>
<body>
    <h2>Cadastrar Produto</h2>
    <form method="POST">
        <label>Nome:</label><br>
        <input type="text" name="nome" required><br>
        <label>ID do Produto:</label><br>
        <input type="number" name="idproduto" required><br>
        <label>Preço:</label><br>
        <input type="text" name="preco" required><br><br>
        <button type="submit" name="adicionar">Adicionar</button>
    </form>
    <button onclick="window.location.href='home.php'">Voltar à Tela Inicial</button>
</body>
</html>
