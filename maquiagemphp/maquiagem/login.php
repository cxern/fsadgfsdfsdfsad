<?php

include_once('includes/header.php');
include_once('includes/functions.php');
require_once 'includes/functions.php';

$usuario_padrao = 'admin';
$senha_padrao   = '12345';
$erro = '';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario_digitado = $_POST['usuario'] ?? '';
    $senha_digitada   = $_POST['senha'] ?? '';

    if ($usuario_digitado === $usuario_padrao && $senha_digitada === $senha_padrao) {
        $_SESSION['logado'] = true;
        $_SESSION['usuario'] = $usuario_digitado;
        header('Location: protegido.php');
        exit();
    } else {
        $erro = "Usuário ou senha incorretos!";
    }
}
?>
<link rel="stylesheet" href="style.css">

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center">
                    <h2>Login</h2>
                </div>
                <div class="card-body">
                    <?php if (!empty($erro)): ?>
                        <div class="alert alert-danger"><?php echo $erro; ?></div>
                    <?php endif; ?>

                    <form method="POST" action="login.php">
                        <div class="mb-3">
                            <label for="usuario" class="form-label">Usuário</label>
                            <input type="text" class="form-control" name="usuario" id="usuario" required>
                        </div>
                        <div class="mb-3">
                            <label for="senha" class="form-label">Senha</label>
                            <input type="password" class="form-control" name="senha" id="senha" required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Entrar</button>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center">
                    <small><strong>Usuário:</strong> admin <strong>Senha:</strong> 12345</small>
                </div>
            </div>
        </div>
    </div>
</div>