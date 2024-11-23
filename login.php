<?php
session_start(); // Iniciar a sessão
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de Login</title>
    <style>
        /* Estilos fornecidos */
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: Arial, sans-serif; }
        body { background-color: #f4f4f4; display: flex; justify-content: center; align-items: center; height: 100vh; }
        .login-container { background-color: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 0 15px rgba(0, 0, 0, 0.1); max-width: 400px; width: 100%; }
        h2 { text-align: center; margin-bottom: 20px; color: #333; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; color: #333; }
        input[type="text"], input[type="password"] { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; font-size: 16px; }
        button { width: 100%; padding: 12px; background-color: #007bff; color: white; border: none; border-radius: 5px; font-size: 16px; cursor: pointer; transition: background-color 0.3s; }
        button:hover { background-color: #0056b3; }
        .forgot-password { text-align: center; margin-top: 10px; }
        .forgot-password a { color: #007bff; text-decoration: none; font-size: 14px; }
        .forgot-password a:hover { text-decoration: underline; }
        .register-link { text-align: center; margin-top: 20px; }
        .register-link a { color: #007bff; text-decoration: none; font-size: 14px; }
        .register-link a:hover { text-decoration: underline; }
        .error { color: red; text-align: center; margin-bottom: 15px; }
        @media (max-width: 600px) { .login-container { padding: 15px; } button { font-size: 14px; } }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>

        <!-- Verificar se há erro na sessão -->
        <?php if (isset($_SESSION['erro_login'])): ?>
            <div class="error"><?php echo $_SESSION['erro_login']; ?></div>
        <?php endif; ?>

        <form action="processa_login.php" method="POST">
            <div class="form-group">
                <label for="login">Login</label>
                <!-- Preencher o campo login automaticamente caso tenha falhado o login -->
                <input type="text" id="login" name="login" value="<?php echo isset($_SESSION['login_recuperacao']) ? $_SESSION['login_recuperacao'] : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="senha">Senha</label>
                <input type="password" id="senha" name="senha" required>
            </div>
            <button type="submit">Entrar</button>

            <!-- Exibir link para recriar senha caso haja erro -->
            <?php if (isset($_SESSION['erro_login'])): ?>
                <div class="forgot-password">
                    <a href="verificar_2fa.php">Clique aqui para recriar sua senha</a>
                </div>
            <?php unset($_SESSION['erro_login']); ?> <!-- Limpar a mensagem após exibir -->
            <?php endif; ?>
        </form>
        
        <div class="register-link">
            <p>Não tem uma conta? <a href="cadastro.php">Cadastre-se aqui</a></p>
        </div>
    </div>
</body>
</html>
