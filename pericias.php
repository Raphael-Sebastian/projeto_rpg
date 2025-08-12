<?php
session_start();
include('conexao.php');

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

$usuario = $_SESSION['usuario'];

// verifica se o ID da ficha foi passado na URL
if (!isset($_GET['id'])) {
    echo "ID da ficha não fornecido.";
    exit;
}

$ficha_id = $_GET['id'];

// buscar ficha específica pelo ID e usuário logado
$query = "SELECT * FROM fichas WHERE id = :ficha_id AND usuario_id = (SELECT id FROM usuarios WHERE usuario = :usuario)";
$stmt = $conn->prepare($query);
$stmt->bindParam(':ficha_id', $ficha_id);
$stmt->bindParam(':usuario', $usuario);
$stmt->execute();
$ficha = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$ficha) {
    echo "Ficha não encontrada.";
    exit;
}

// definição das perícias associadas a cada atributo
$pericias = [
    'forca' => ['Atletismo'],
    'destreza' => ['Acrobacia', 'Furtividade', 'Prestidigitação'],
    'inteligencia' => ['Arcanismo', 'Investigação', 'Natureza', 'Religião'],
    'sabedoria' => ['Intuição', 'Lidar com Animais', 'Medicina', 'Percepção', 'Sobrevivência'],
    'carisma' => ['Atuação', 'Blefar', 'Intimidação', 'Persuasão']
];

//recupera as perícias treinadas do banco de dados
$pericias_treinadas = explode(',', $ficha['pericias_treinadas'] ?? '');

// função para calcular o modificador de atributo
function calcular_modificador($valor) {
    return floor(($valor + 10) / 2);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pericias_treinadas = isset($_POST['pericias']) ? implode(',', $_POST['pericias']) : '';

    // atualiza as perícias treinadas no banco de dados
    $update_query = "UPDATE fichas SET pericias_treinadas = :pericias_treinadas WHERE id = :ficha_id";
    $stmt = $conn->prepare($update_query);
    $stmt->bindParam(':pericias_treinadas', $pericias_treinadas);
    $stmt->bindParam(':ficha_id', $ficha_id);
    $stmt->execute();

    header("Location: pericias.php?id=$ficha_id");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perícias - <?= htmlspecialchars($ficha['nome']); ?></title>
    <link rel="stylesheet" href="pericia.css">
</head>
<body>
    <div class="container">
        <h1>Perícias de <?= htmlspecialchars($ficha['nome']); ?></h1>
        <form method="POST">
            <table>
                <?php foreach ($pericias as $atributo => $lista_pericias): ?>
                    <tr>
                        <th colspan="2"><?= ucfirst($atributo); ?> (Modificador: <?= calcular_modificador($ficha[$atributo]); ?>)</th>
                    </tr>
                    <?php foreach ($lista_pericias as $pericia): ?>
                        <?php 
                            $modificador = calcular_modificador($ficha[$atributo]);
                            $valor_pericia = in_array($pericia, $pericias_treinadas) ? $modificador + 2 : $modificador;
                            $valor_pericia = ($valor_pericia >= 0) ? "+$valor_pericia" : $valor_pericia;
                            $checked = in_array($pericia, $pericias_treinadas) ? "checked" : "";
                        ?>
                        <tr>
                            <td>
                                <input type="checkbox" name="pericias[]" value="<?= htmlspecialchars($pericia); ?>" <?= $checked; ?>> 
                                <?= htmlspecialchars($pericia); ?> <strong>(<?= $valor_pericia; ?>)</strong>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            </table>
            <button type="submit">Salvar</button>
        </form>
        <a href="fichadnd.php?id=<?= $ficha_id; ?>" class="btn">Voltar para a Ficha</a>
    </div>
</body>
</html>
