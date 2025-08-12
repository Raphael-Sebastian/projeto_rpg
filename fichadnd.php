<?php
include('conexao.php');

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Converte para inteiro por segurança

    // Consulta a ficha pelo ID
    $query = "SELECT * FROM fichas WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $ficha = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$ficha) {
        echo "Ficha não encontrada.";
        exit;
    }
} else {
    echo "ID de ficha não fornecido.";
    exit;
}

// Atualiza os atributos no banco de dados quando o formulário for enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $forca = filter_input(INPUT_POST, 'forca', FILTER_SANITIZE_NUMBER_INT);
    $destreza = filter_input(INPUT_POST, 'destreza', FILTER_SANITIZE_NUMBER_INT);
    $constituicao = filter_input(INPUT_POST, 'constituicao', FILTER_SANITIZE_NUMBER_INT);
    $inteligencia = filter_input(INPUT_POST, 'inteligencia', FILTER_SANITIZE_NUMBER_INT);
    $sabedoria = filter_input(INPUT_POST, 'sabedoria', FILTER_SANITIZE_NUMBER_INT);
    $carisma = filter_input(INPUT_POST, 'carisma', FILTER_SANITIZE_NUMBER_INT);

    $updateQuery = "UPDATE fichas SET 
        forca = :forca, 
        destreza = :destreza, 
        constituicao = :constituicao, 
        inteligencia = :inteligencia, 
        sabedoria = :sabedoria, 
        carisma = :carisma
        WHERE id = :id";

    $stmt = $conn->prepare($updateQuery);
    $stmt->bindParam(':forca', $forca, PDO::PARAM_INT);
    $stmt->bindParam(':destreza', $destreza, PDO::PARAM_INT);
    $stmt->bindParam(':constituicao', $constituicao, PDO::PARAM_INT);
    $stmt->bindParam(':inteligencia', $inteligencia, PDO::PARAM_INT);
    $stmt->bindParam(':sabedoria', $sabedoria, PDO::PARAM_INT);
    $stmt->bindParam(':carisma', $carisma, PDO::PARAM_INT);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    
    if ($stmt->execute()) {
        echo "<script>
                alert('Atributos atualizados com sucesso!');
                window.location.href='fichadnd.php?id=$id&updated=' + new Date().getTime();
              </script>";
    } else {
        echo "Erro ao atualizar os atributos.";
    }
}
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ficha de D&D - <?= htmlspecialchars($ficha['nome']); ?></title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <div class="ficha-container">
        <h1>Ficha de D&D: <?= htmlspecialchars($ficha['nome']); ?></h1>
        <div class="ficha">
            <div class="ficha-info">
                <p><strong>Nome:</strong> <?= htmlspecialchars($ficha['nome']); ?></p>
                <p><strong>Classe:</strong> <?= htmlspecialchars($ficha['classe']); ?></p>
                <p><strong>Nível:</strong> <?= htmlspecialchars($ficha['nivel']); ?></p>
                <p><strong>Raça:</strong> <?= htmlspecialchars($ficha['raca']); ?></p>
            </div>
            
            <!-- Formulário para edição dos atributos -->
            <div class="atributos">
                <h2>Atributos</h2>
                <form method="POST">
                    <table>
                        <tr>
                            <th>Força</th>
                            <th>Destreza</th>
                            <th>Constituição</th>
                        </tr>
                        <tr>
                            <td><input type="number" name="forca" value="<?= htmlspecialchars($ficha['forca']); ?>"></td>
                            <td><input type="number" name="destreza" value="<?= htmlspecialchars($ficha['destreza']); ?>"></td>
                            <td><input type="number" name="constituicao" value="<?= htmlspecialchars($ficha['constituicao']); ?>"></td>
                        </tr>
                        <tr>
                            <th>Inteligência</th>
                            <th>Sabedoria</th>
                            <th>Carisma</th>
                        </tr>
                        <tr>
                            <td><input type="number" name="inteligencia" value="<?= htmlspecialchars($ficha['inteligencia']); ?>"></td>
                            <td><input type="number" name="sabedoria" value="<?= htmlspecialchars($ficha['sabedoria']); ?>"></td>
                            <td><input type="number" name="carisma" value="<?= htmlspecialchars($ficha['carisma']); ?>"></td>
                        </tr>
                    </table>
                    
                    <button type="submit" class="btn-salvar">Salvar Alterações</button>

                </form>
            </div>

            <div class="acoes">
                <a href="ficharpg.php" class="btn">Voltar para as fichas</a>
                
                <a href="pericias.php?id=<?= $ficha['id']; ?>" class="btn">Gerenciar Perícias</a>
                <a href="excluir_ficha.php?id=<?= $ficha['id']; ?>" class="btn-excluir" onclick="return confirm('Tem certeza que deseja excluir esta ficha?')">Excluir Ficha</a>
            </div>
        </div>
    </div>
</body>
</html>
