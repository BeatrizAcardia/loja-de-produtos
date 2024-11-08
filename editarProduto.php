<?php
include 'config.php';

// Editar produto
if (isset($_POST['editar'])) {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $idproduto = $_POST['idproduto'];
    $preco = $_POST['preco'];

    $sql = "UPDATE produtos SET nome = ?, idproduto = ?, preco = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nome, $idproduto, $preco, $id]);
    header("Location: editar.php");
}

// Excluir produto
if (isset($_GET['excluir'])) {
    $id = $_GET['excluir'];
    $sql = "DELETE FROM produtos WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    header("Location: editar.php");
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Produtos</title>
</head>
<body>
    <h2>Lista de Produtos</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>ID do Produto</th>
            <th>Preço</th>
            <th>Ações</th>
        </tr>
        <?php
        $sql = "SELECT * FROM produtos";
        $stmt = $pdo->query($sql);
        while ($produto = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>{$produto['id']}</td>";
            echo "<td>{$produto['nome']}</td>";
            echo "<td>{$produto['idproduto']}</td>";
            echo "<td>{$produto['preco']}</td>";
            echo "<td>
                    <a href='editar.php?editar={$produto['id']}'>Editar</a> |
                    <a href='editar.php?excluir={$produto['id']}' onclick=\"return confirm('Deseja excluir este produto?')\">Excluir</a>
                  </td>";
            echo "</tr>";
        }
        ?>
    </table>

    <?php
    // Se a edição for solicitada, exibir o formulário de edição
    if (isset($_GET['editar'])) {
        $id = $_GET['editar'];
        $sql = "SELECT * FROM produtos WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
        $produto = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($produto) {
            ?>
            <h2>Editar Produto</h2>
            <form method="POST">
                <input type="hidden" name="id" value="<?= $produto['id'] ?>">
                <label>Nome:</label><br>
                <input type="text" name="nome" required value="<?= $produto['nome'] ?>"><br>
                <label>ID do Produto:</label><br>
                <input type="number" name="idproduto" required value="<?= $produto['idproduto'] ?>"><br>
                <label>Preço:</label><br>
                <input type="text" name="preco" required value="<?= $produto['preco'] ?>"><br><br>
                <button type="submit" name="editar">Atualizar</button>
            </form>
            <?php
        }
    }
    ?>
    <button onclick="window.location.href='home.php'">Voltar à Tela Inicial</button>
</body>
</html>
