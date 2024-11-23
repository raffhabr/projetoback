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

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Receber dados do formulário
        $login = $_POST['login'] ?? null;
        $senha = $_POST['senha'] ?? null;

        // Verificar se o login é do administrador
        $adminLogin = 'admin';
        $adminPassword = 'admin123'; // Defina a senha padrão do administrador aqui

        if ($login === $adminLogin && $senha === $adminPassword) {
            $_SESSION['admin'] = true; // Definir flag de administrador na sessão
            header("Location: admin_index.php"); // Redirecionar para a página de admin
            exit();
        }

        // Verificar no banco se o login existe
        $sql = "SELECT * FROM informacoes WHERE Login = :login";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':login', $login);
        $stmt->execute();
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario && password_verify($senha, $usuario['Senha'])) {
            // Armazenar o ID do usuário na sessão
            $_SESSION['usuario_id'] = $usuario['usuario_id'];

            // Redirecionar para a página principal
            header("Location: index.php");
            exit();
        } else {
            // Caso o login falhe, armazenar o login na sessão
            $_SESSION['erro_login'] = 'Login ou senha incorretos.';
            $_SESSION['login_recuperacao'] = $login;  // Salvar o login para a recuperação de senha
            header("Location: login.php");
            exit();
        }
    }
} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}
