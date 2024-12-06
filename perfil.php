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

    // Verificar se o usuário está logado
    if (!isset($_SESSION['usuario_id'])) {
        header("Location: login.php");
        exit();
    }

    // Pegar o ID do usuário logado
    $usuario_id = $_SESSION['usuario_id'];

    // Consultar as informações do usuário no banco de dados
    $sql = "SELECT usuario_id, Nome_Completo, E_mail, Telefone_Celular, Data_de_Nascimento FROM informacoes WHERE usuario_id = :usuario_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':usuario_id', $usuario_id);
    $stmt->execute();
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$usuario) {
        // Caso o usuário não seja encontrado
        echo "Usuário não encontrado!";
        exit();
    }

    // Consultar os treinos do usuário no banco de dados
    $sql_treinos = "SELECT tipo_treino FROM treinos WHERE usuario_id = :usuario_id";
    $stmt_treinos = $pdo->prepare($sql_treinos);
    $stmt_treinos->bindParam(':usuario_id', $usuario_id);
    $stmt_treinos->execute();
    $treinos = $stmt_treinos->fetchAll(PDO::FETCH_COLUMN);

} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu Perfil</title>
    <style>
        .dark-mode {
    background-color: #121212;
    color: #ffffff;}
        /* Reset básico */
        body, h1, h2, p {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        header.dark-mode {
    background-color: #1a1a1a;
    color: #ffffff;    }
        /* Corpo */
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            color: #333;
            line-height: 1.6;
            margin: 0;
            padding: 0;
        }

        /* Container principal */
        .container {
            width: 80%;
            max-width: 800px;
            margin: 20px auto;
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        /* Cabeçalho */
        header {
            background-color: #007BFF;
            color: #ffffff;
            text-align: center;
            padding: 20px 0;
        }

        header h1 {
            font-size: 24px;
        }

        /* Informações do perfil */
        .perfil-info {
            padding: 20px;
            color:black;
        }

        .perfil-info h2 {
            font-size: 20px;
            margin-bottom: 15px;
            color: black;
            border-bottom: 2px solid #007BFF;
            display: inline-block;
            padding-bottom: 5px;
        }
        #h2_treinos{
            color: black    }
        .perfil-info p {
            margin-bottom: 10px;
            font-size: 16px;

        }

        .perfil-info strong {
            color: #555;
        }

        /* Rodapé */
        footer {
            background-color: #f1f1f1;
            text-align: center;
            padding: 10px 0;
            font-size: 14px;
            color: #777;
            border-top: 1px solid #eaeaea;
        }
        footer.dark-mode {
    background-color: #1a1a1a;
    color: #ffffff;
}
        footer p {
            margin: 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>Meu Perfil</h1>
        </header>
        
        <div class="perfil-info">
            <h2>Informações do Usuário</h2>
            <p><strong>Meu ID:</strong> <?php echo htmlspecialchars($usuario['usuario_id']); ?></p>
            <p><strong>Nome:</strong> <?php echo htmlspecialchars($usuario['Nome_Completo']); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($usuario['E_mail']); ?></p>
            <p><strong>Telefone:</strong> <?php echo htmlspecialchars($usuario['Telefone_Celular']); ?></p>
            <p><strong>Data de Nascimento:</strong> <?php echo htmlspecialchars($usuario['Data_de_Nascimento']); ?></p>

            <h2 id=h2_treinos>Treinos Associados</h2>
            <?php if (!empty($treinos)): ?>
                <ul>
                    <?php foreach ($treinos as $treino): ?>
                        <li id= h2_treinos><?php echo htmlspecialchars($treino); ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>Nenhum treino associado.</p>
            <?php endif; ?>
            
            <a href="index.php">Voltar ao Início</a>
        </div>
        
        <footer>
            <p>&copy; 2024 Academia Online. Todos os direitos reservados.</p>
        </footer>
    </div>
    <script>
    // Verificar o estado do Dark Mode no localStorage ao carregar a página
    if (localStorage.getItem('darkMode') === 'true') {
        document.body.classList.add('dark-mode');
        document.querySelector('header').classList.add('dark-mode');
        document.querySelector('footer').classList.add('dark-mode');
    }
</script>
</body>
</html>