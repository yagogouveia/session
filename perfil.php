<?php
// perfil.php - Acessível apenas pelo usuário com nível "admin"

session_start();

// 1) Precisa estar logado
if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
    header('Location: login.html');
    exit;
}

// 2) Precisa ser admin
if (($_SESSION['nivel'] ?? '') !== 'admin') {
    http_response_code(403);
    ?>
    <!DOCTYPE html>
    <html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <title>Acesso negado</title>
        <link rel="stylesheet" href="css/estilo.css">
    </head>
    <body>
        <div class="container error">
            <h2>⛔ Acesso negado</h2>
            <p>Esta página é exclusiva para administradores.</p>
            <a href="painel.php">Voltar ao painel</a>
        </div>
    </body>
    </html>
    <?php
    exit;
}

$usuario   = htmlspecialchars($_SESSION['usuario'], ENT_QUOTES, 'UTF-8');
$nivel     = htmlspecialchars($_SESSION['nivel'], ENT_QUOTES, 'UTF-8');
$dataLogin = htmlspecialchars($_SESSION['data_login'] ?? '-', ENT_QUOTES, 'UTF-8');
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Perfil</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
    <div class="container perfil">
        <h2>👤 Perfil do Administrador</h2>

        <div class="info">
            <p><strong>Usuário:</strong> <?php echo $usuario; ?></p>
            <p><strong>Nível de acesso:</strong>
                <span class="badge admin"><?php echo $nivel; ?></span>
            </p>
            <p><strong>Login realizado em:</strong> <?php echo $dataLogin; ?></p>
            <p><strong>ID da sessão:</strong> <?php echo htmlspecialchars(session_id(), ENT_QUOTES, 'UTF-8'); ?></p>
        </div>

        <a href="painel.php">← Voltar ao painel</a>
        <div class="logout">
            <a href="logout.php">Sair do sistema</a>
        </div>
    </div>
</body>
</html>
