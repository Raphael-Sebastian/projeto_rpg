<?php
session_start();
include('conexao.php');

// Verificação se o usuário ja cadastro
if (!isset($_SESSION['usuario_id'])) {
    echo "Erro: usuário não autenticado.";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario_id = $_SESSION['usuario_id']; //ID do usuário logado
    $nome = $_POST['nome']; 
    $classe = $_POST['classe'];
    $nivel = $_POST['nivel'];
    $raca = $_POST['raca'];
    $forca = $_POST['forca'];
    $destreza = $_POST['destreza'];
    $constituicao = $_POST['constituicao'];
    $inteligencia = $_POST['inteligencia'];
    $sabedoria = $_POST['sabedoria'];
    $carisma = $_POST['carisma'];

    $query = "INSERT INTO fichas (usuario_id, nome, classe, nivel, raca, forca, destreza, constituicao, inteligencia, sabedoria, carisma) 
              VALUES (:usuario_id, :nome, :classe, :nivel, :raca, :forca, :destreza, :constituicao, :inteligencia, :sabedoria, :carisma)";

    $stmt = $conn->prepare($query);

    $stmt->bindParam(':usuario_id', $usuario_id);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':classe', $classe);
    $stmt->bindParam(':nivel', $nivel);
    $stmt->bindParam(':raca', $raca);
    $stmt->bindParam(':forca', $forca);
    $stmt->bindParam(':destreza', $destreza);
    $stmt->bindParam(':constituicao', $constituicao);
    $stmt->bindParam(':inteligencia', $inteligencia);
    $stmt->bindParam(':sabedoria', $sabedoria);
    $stmt->bindParam(':carisma', $carisma);

    if ($stmt->execute()) {
        header("Location: ficharpg.php");
        exit;  
    } else {
        echo "Erro ao salvar a ficha.";
    }
}
?>
