<?php
include('conexao.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    // Verifica se o usuário ou o email já existem no banco
    $query = "SELECT * FROM usuarios WHERE usuario = :usuario OR email = :email";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':usuario', $usuario);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Se já existir, mostra uma mensagem de erro
        $erro = "Usuário ou email já cadastrados!";
    } else {
        // Adicionar o novo usuário no banco
        $query = "INSERT INTO usuarios (usuario, senha, email) VALUES (:usuario, :senha, :email)";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':usuario', $usuario);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha', $senha);

        if ($stmt->execute()) {
            // Redireciona para a página de login
            header("Location: login.php");
            exit;
        } else {
            $erro = "Erro ao cadastrar usuário. Tente novamente.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="container">
        <h1>Cadastro</h1>
        <?php if (isset($erro)) echo "<p class='erro'>$erro</p>"; ?>
        <form action="cadastro.php" method="POST">
            <label for="usuario">Usuário</label>
            <input type="text" name="usuario" id="usuario" required>

            <label for="email">Email</label>
            <input type="email" name="email" id="email" required>
            
            <label for="senha">Senha</label>
            <input type="password" name="senha" id="senha" required>
            
            <button type="submit" class="btn">Cadastrar</button>
        </form>
        <p>Já tem uma conta? <a href="login.php">Faça login</a></p>
    </div>
</body>
</html>
