<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nova Ficha de D&D</title>
    <link rel="stylesheet" href="stylenova.css">
</head>
<body>
    <div class="container">
        <h1>Nova Ficha de D&D</h1>
        <form action="processar_ficha.php" method="POST">
            <label for="nome">Nome</label>
            <input type="text" name="nome" id="nome" required>

            <label for="classe">Classe</label>
            <input type="text" name="classe" id="classe" required>

            <label for="nivel">Nível</label>
            <input type="number" name="nivel" id="nivel" required>

            <label for="raca">Raça</label>
            <input type="text" name="raca" id="raca" required>

            <label for="forca">Força</label>
            <input type="number" name="forca" id="forca" required>

            <label for="destreza">Destreza</label>
            <input type="number" name="destreza" id="destreza" required>

            <label for="constituição">Constituição</label>
            <input type="number" name="constituicao" id="constitucao" required>

            <label for="inteligencia">Inteligência</label>
            <input type="number" name="inteligencia" id="inteligencia" required>

            <label for="sabedoria">Sabedoria</label>
            <input type="number" name="sabedoria" id="sabedoria" required>

            <label for="carisma">Carisma</label>
            <input type="number" name="carisma" id="carisma" required>

            <button type="submit" class="btn">Salvar Ficha</button>
        </form>
    </div>
</body>
</html>
