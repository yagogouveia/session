<?php
// valida.php - Processa o login, guarda nível de acesso e data do login

session_start();

// Dados simulados (em produção: use banco de dados e password_hash)
$usuarios = [
    'admin' => ['senha' => '12345', 'nivel' => 'admin'],
    'maria' => ['senha' => '12345', 'nivel' => 'usuario'],
];

$usuario = $_POST['usuario'] ?? '';
$senha   = $_POST['senha'] ?? '';

if (isset($usuarios[$usuario]) && $usuarios[$usuario]['senha'] === $senha) {
    session_regenerate_id(true);

    // Armazena na sessão
    $_SESSION['logado']     = true;
    $_SESSION['usuario']    = $usuario;
    $_SESSION['nivel']      = $usuarios[$usuario]['nivel'];   // Atividade 2
    $_SESSION['data_login'] = date('d/m/Y H:i:s');            // Atividade 4

    header('Location: painel.php');
    exit;
} else {
    echo "
    <!DOCTYPE html>
    <html lang='pt-BR'>
    <head>
        <meta charset='UTF-8'>
        <title>Erro</title>
        <link rel='stylesheet' href='css/estilo.css'>
    </head>
    <body>
        <div class='container error'>
            <h2>❌ Login inválido!</h2>
            <p>Usuário ou senha incorretos.</p>
            <a href='login.html'>Tentar novamente</a>
        </div>
    </body>
    </html>";
}
?>
