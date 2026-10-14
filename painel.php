<?php
// painel.php - Página de boas-vindas

session_start();

// Protege a página
if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
    header('Location: login.html');
    exit;
}

$usuario   = htmlspecialchars($_SESSION['usuario'], ENT_QUOTES, 'UTF-8');
$nivel     = $_SESSION['nivel'] ?? 'usuario';
$dataLogin = htmlspecialchars($_SESSION['data_login'] ?? '-', ENT_QUOTES, 'UTF-8');

// Mensagem diferente conforme o nível de acesso
if ($nivel === 'admin') {
    $mensagem = 'Você tem acesso total ao sistema, incluindo a página de perfil.';
} else {
    $mensagem = 'Você tem acesso básico ao sistema.';
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Painel</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
    <div class="container painel">
        <h2>✅ Bem-vindo, <?php echo $usuario; ?>!</h2>
        <p>Você está logado com sucesso no sistema.</p>

        <div class="info">
            <p><strong>Nível de acesso:</strong>
                <span class="badge <?php echo $nivel === 'admin' ? 'admin' : 'usuario'; ?>">
                    <?php echo htmlspecialchars($nivel, ENT_QUOTES, 'UTF-8'); ?>
                </span>
            </p>
            <p><strong>Login realizado em:</strong> <?php echo $dataLogin; ?></p>
            <p><?php echo $mensagem; ?></p>
        </div>

        <?php if ($nivel === 'admin'): ?>
            <p><a href="perfil.php">👤 Acessar perfil (somente admin)</a></p>
        <?php endif; ?>

        <div class="logout">
            <a href="logout.php">Sair do sistema</a>
        </div>
    </div>
</body>
</html>
