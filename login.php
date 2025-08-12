<?php 
session_start();
include('conexao.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    
    $query = "SELECT * FROM usuarios WHERE usuario = :usuario AND email = :email"; 
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':usuario', $usuario);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($user && password_verify($senha, $user['senha'])) {
        $_SESSION['usuario_id'] = $user['id']; // Agora salvamos o ID do usuário
        $_SESSION['usuario'] = $user['usuario']; 

        header("Location: ficharpg.php");
        exit;
    } else {
        $erro = "Usuário, email ou senha incorretos.";
    }
}
?>



    <!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>
        <link rel="stylesheet" href="login.css">
    </head>
    <body>
        <div class="container">
            <h1>Login</h1>
            <?php if (isset($erro)) echo "<p class='erro'>$erro</p>"; ?>
            <form action="login.php" method="POST">
                <label for="usuario">Usuário</label>
                <input type="text" name="usuario" id="usuario" required>
                
                <label for="email">Email</label>
                <input type="text" name="email" id="email" required>

                <label for="senha">Senha</label>
                <input type="password" name="senha" id="senha" required>

                
                <button type="submit" class="btn">Entrar</button>
                <p>Não tem uma conta? <a href="cadastro.php">Faça o cadastro</a></p>
            </form>
        </div>
    </body>
    </html>
