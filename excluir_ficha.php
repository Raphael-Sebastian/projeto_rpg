<?php 
session_start();
include('conexao.php');

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

$usuario = $_SESSION['usuario'];
$id_ficha = $_GET['id'];

// Verifica se a ficha pertence ao usuário logado antes de excluir
$query = "DELETE FROM fichas WHERE id = :id AND usuario_id = (SELECT id FROM usuarios WHERE usuario = :usuario)";
$stmt = $conn->prepare($query);
$stmt->bindParam(':id', $id_ficha);
$stmt->bindParam(':usuario', $usuario);

if ($stmt->execute()) {
    header("Location: ficharpg.php");
    exit;
} else {
    echo "Erro ao excluir a ficha.";
}
 ?>