<?php
include_once('includes/functions.php');
checarAutenticacao();
include_once('includes/header.php');

$operacao_concluida = false;
$mensagem_erro = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo    = sanitizar($_POST['titulo'] ?? '');
    $categoria = sanitizar($_POST['categoria'] ?? '');
    $descricao = sanitizar($_POST['descricao'] ?? '');
    $imagem    = sanitizar($_POST['imagem'] ?? '');

    if (empty($titulo) || empty($categoria) || empty($descricao) || empty($imagem)) {
        $mensagem_erro = 'Todos os campos são obrigatórios.';
    } else {
        $produto_dados = [
            'titulo'    => $titulo,
            'categoria' => $categoria,
            'descricao' => $descricao,
            'imagem'    => $imagem,
        ];

        if (!empty($_POST['atributo1_nome']) && !empty($_POST['atributo1_valor'])) {
            $produto_dados[sanitizar($_POST['atributo1_nome'])] = sanitizar($_POST['atributo1_valor']);
        }

        if (!empty($_POST['atributo2_nome']) && !empty($_POST['atributo2_valor'])) {
            $produto_dados[sanitizar($_POST['atributo2_nome'])] = sanitizar($_POST['atributo2_valor']);
        }

        if (adicionarNovoItem($produto_dados)) {
            $operacao_concluida = true;
        } else {
            $mensagem_erro = 'Erro ao adicionar o item.';
        }
    }
}
?>
<link rel="stylesheet" href="style.css">
<div class="container mt-4">
    <h1>Área Restrita</h1>
    <div class="alert alert-info">Bem-vindo, <?php echo $_SESSION['usuario']; ?>!</div>

    <?php if ($operacao_concluida): ?>
        <div class="alert alert-success">Item adicionado com sucesso!</div>
    <?php endif; ?>

    <?php if (!empty($mensagem_erro)): ?>
        <div class="alert alert-danger"><?php echo $mensagem_erro; ?></div>
    <?php endif; ?>

    <div class="card">
        <div class="card-header">Cadastrar Novo Item</div>
        <div class="card-body">
            <form method="POST" action="protegido.php">
                <div class="mb-3">
                    <label class="form-label">Título</label>
                    <input type="text" name="titulo" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Categoria</label>
                    <select name="categoria" class="form-select" required>
                        <option value="">Selecione</option>
                        <?php foreach (getCategorias() as $categoria): ?>
                            <option value="<?php echo $categoria; ?>"><?php echo $categoria; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Descrição</label>
                    <textarea name="descricao" class="form-control" required></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">URL da Imagem</label>
                    <input type="text" name="imagem" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary">Cadastrar Item</button>
                <a href="index.php" class="btn btn-secondary">Voltar</a>
            </form>
        </div>
    </div>
</div>

<?php include_once('includes/footer.php'); ?>