<?php
include_once('includes/header.php');
include_once('includes/functions.php');
require_once 'includes/functions.php';

$id = isset($_GET['id']) ? $_GET['id'] : null;

if (!$id || !isset($catalogo_base[$id])) {
    echo "<h2>Produto não encontrado.</h2>";
    echo "<a href='index.php'>Voltar para o catálogo</a>";
    exit;
}

$produto = $catalogo_base[$id];
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $produto['titulo']; ?> - Detalhes</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f7fa;
            margin: 0;
            padding: 0;
        }

        .produto-container {
            width: 80%;
            max-width: 1000px;
            margin: 50px auto;
            background: #fff;
            padding: 30px;
            border-radius: 12px;

        }

        .produto-container img {
            display: block;

            margin: 0 auto;

            width: 100%;

            max-width: 500px;

            height: auto;

            border-radius: 12px;
            margin-bottom: 30px;
        }

        .produto-container h1 {
            font-size: 34px;
            margin-bottom: 20px;
            color: #333;
        }

        .produto-container p {
            font-size: 18px;
            margin-bottom: 20px;
            line-height: 1.6;
            color: #555;
        }

        .produto-container a {
            display: inline-block;
            padding: 12px 24px;
            background: #e91e63;
            color: #fff;
            text-decoration: none;
            border-radius: 8px;
            transition: background 0.3s;
        }

        .produto-container a:hover {
            background: #c2185b;
        }

        .go-back {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background: #ccc;
            color: #333;
            text-decoration: none;
            border-radius: 8px;
        }

        .go-back:hover {
            background: #999;
        }
    </style>
</head>

<body>

    <div class="produto-container">
        <img src="<?php echo $produto['imagem']; ?>" alt="<?php echo $produto['titulo']; ?>">
        <h1><?php echo $produto['titulo']; ?></h1>
        <p><strong>Categoria:</strong> <?php echo $produto['categoria']; ?></p>
        <p><strong>Descrição:</strong> <?php echo $produto['descricao']; ?></p>
        <p><strong>Sobre o Produto:</strong> <?php echo $produto['sobre']; ?></p>
        <a href="index.php" class="go-back">Voltar para o catálogo</a>
    </div>

</body>

</html>
<?php include_once('includes/footer.php'); ?>