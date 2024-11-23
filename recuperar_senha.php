<?php
session_start();

// Configurações de conexão com o banco de dados
$host = 'localhost';
$dbname = 'forjfacul';
$username = 'root';
$password = '';

try {
    // Conectar ao banco de dados usando PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Exibe uma mensagem de erro e interrompe a execução
    die("Erro ao conectar ao banco de dados: " . $e->getMessage());
}

// Verifica se o login foi armazenado na sessão
if (!isset($_SESSION['login_recuperacao'])) {
    // Se não estiver, redireciona para a página de login
    header('Location: login.php');
    exit;
}

$mensagemErro = ""; // Variável para armazenar mensagem de erro

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recebe as senhas do formulário
    $novaSenha = $_POST['nova_senha'] ?? '';
    $confirmarSenha = $_POST['confirmar_senha'] ?? '';

    // Verifica se as senhas são iguais
    if ($novaSenha === $confirmarSenha) {
        // Criptografa a senha (opcional)
        $novaSenhaHash = password_hash($novaSenha, PASSWORD_DEFAULT);

        // Atualiza a senha no banco de dados
        $stmt = $pdo->prepare('
            UPDATE informacoes 
            SET senha = :nova_senha 
            WHERE Login = :login
        ');
        $stmt->execute([
            'login' => $_SESSION['login_recuperacao'],
            'nova_senha' => $novaSenhaHash,
        ]);

        // Redireciona após a alteração bem-sucedida
        header('Location: login.php?senha_alterada');
        exit;
    } else {
        $mensagemErro = "As senhas não coincidem. Tente novamente.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar Senha</title>
    <style>
        /* Estilos do formulário */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-container {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
            text-align: center;
            color: #007bff;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #0056b3; 
        }

        .error-message {
            color: #ff0000;
            font-size: 14px;
            margin-bottom: 10px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Alterar Senha</h1>
        <?php if (!empty($mensagemErro)): ?>
            <p class="error-message"><?php echo $mensagemErro; ?></p>
        <?php endif; ?>
        <form method="post">
            <label for="nova_senha">Nova Senha:</label>
            <input type="password" id="nova_senha" name="nova_senha" required>

            <label for="confirmar_senha">Confirmar Senha:</label>
            <input type="password" id="confirmar_senha" name="confirmar_senha" required>

            <button type="submit">Alterar Senha</button>
        </form>
    </div>
</body>
</html>
