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

// Inicializa as tentativas se não existirem
if (!isset($_SESSION['tentativas'])) {
    $_SESSION['tentativas'] = 0;
}

$mensagemErro = ""; // Variável para armazenar mensagem de erro

// Define aleatoriamente a pergunta que será exibida
$perguntaAleatoria = rand(0, 1); // 0 para "Nome da mãe", 1 para "Data de nascimento"

// Verifica se o login está armazenado na sessão
if (!isset($_SESSION['login_recuperacao'])) {
    // Se não estiver, redireciona para a página de login
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome_materno = $_POST['Nome_Materno'] ?? null;
    $data_nascimento = $_POST['Data_de_Nascimento'] ?? null;

    // Verifica se o nome da mãe foi enviado
    if ($nome_materno !== null) {
        // Verifica o nome da mãe
        $stmt = $pdo->prepare('
            SELECT * 
            FROM informacoes 
            WHERE Login = :login 
            AND Nome_Materno = :nome_materno
        ');
        $stmt->execute([
            'login' => $_SESSION['login_recuperacao'],
            'nome_materno' => $nome_materno,
        ]);
    } elseif ($data_nascimento !== null) {
        // Verifica a data de nascimento
        $stmt = $pdo->prepare('
            SELECT * 
            FROM informacoes 
            WHERE Login = :login 
            AND Data_de_Nascimento = :data_nascimento
        ');
        $stmt->execute([
            'login' => $_SESSION['login_recuperacao'],
            'data_nascimento' => $data_nascimento,
        ]);
    }

    $informacao = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($informacao) {
        // Reset das tentativas após sucesso
        $_SESSION['tentativas'] = 0;
        header('Location: recuperar_senha.php'); // Página para redefinir senha
        exit;
    } else {
        // Incrementa as tentativas ao errar
        $_SESSION['tentativas']++;

        if ($_SESSION['tentativas'] >= 3) {
            // Redireciona para login após 3 falhas
            session_destroy(); // Destroi a sessão para forçar o login novamente
            header('Location: login.php?erro=max_tentativas');
            exit;
        } else {
            $mensagemErro = "As informações fornecidas estão incorretas. Você tem " . (3 - $_SESSION['tentativas']) . " tentativas restantes.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperação de Senha</title>
    <style>
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

        input[type="text"],
        input[type="date"] {
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
        <h1>Verificação de Segurança</h1>
        <?php if (!empty($mensagemErro)): ?>
            <p class="error-message"><?php echo $mensagemErro; ?></p>
        <?php endif; ?>
        <form method="post">
            <?php if ($perguntaAleatoria === 0): ?>
                <label for="Nome_Materno">Nome da Mãe:</label>
                <input type="text" id="Nome_Materno" name="Nome_Materno" required>
            <?php else: ?>
                <label for="Data_de_Nascimento">Data de Nascimento:</label>
                <input type="date" id="Data_de_Nascimento" name="Data_de_Nascimento" required>
            <?php endif; ?>
            
            <button type="submit">Verificar</button>
        </form>
    </div>
</body>
</html>
