<?php 
session_start();
include('conexao.php');

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

// Obtém o usuário logado
$usuario = $_SESSION['usuario'];

// Busca as fichas apenas do usuário logado
$query = "SELECT * FROM fichas WHERE usuario_id = (SELECT id FROM usuarios WHERE usuario = :usuario)";
$stmt = $conn->prepare($query);
$stmt->bindParam(':usuario', $usuario);
$stmt->execute();
$fichas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ficha de D&D</title>
    <link rel="stylesheet" href="style.css">    
</head>
<body>
    <div class="container">
        <h1>Fichas de D&D</h1>
        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Classe</th>
                    <th>Nível</th>
                    <th>Raça</th>
                    <th>Ficha</th>
                    <th>Excluir</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($fichas as $ficha): ?>
                    <tr>
                        <td><?= htmlspecialchars($ficha['nome']); ?></td>
                        <td><?= htmlspecialchars($ficha['classe']); ?></td>
                        <td><?= htmlspecialchars($ficha['nivel']); ?></td>
                        <td><?= htmlspecialchars($ficha['raca']); ?></td>
                        <td><a href="fichadnd.php?id=<?= $ficha['id']; ?>">Ver</a></td>
                        <td>
                            <a href="excluir_ficha.php?id=<?= $ficha['id']; ?>" class="btn-excluir" onclick="return confirm('Tem certeza que deseja excluir esta ficha?')">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="nova_ficha.php" class="btn">Nova Ficha</a>
    </div>
</body>
</html>
