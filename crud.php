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

    // Função para deletar o registro
    if (isset($_GET['delete_id'])) {
        $deleteId = $_GET['delete_id'];
        $sql = "DELETE FROM informacoes WHERE usuario_id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $deleteId);
        $stmt->execute();

        $_SESSION['mensagem'] = "Registro deletado com sucesso.";
        header("Location: crud.php");
        exit();
    }

    // Buscar registros com base na pesquisa
    $pesquisa = isset($_GET['pesquisa']) ? $_GET['pesquisa'] : ''; 
    if ($pesquisa) {
        $sql = "SELECT i.usuario_id, i.Nome_Completo, i.E_mail, t.tipo_treino 
                FROM informacoes i 
                LEFT JOIN treinos t ON i.usuario_id = t.usuario_id 
                WHERE i.Nome_Completo LIKE :pesquisa 
                OR i.E_mail LIKE :pesquisa
                OR t.tipo_treino LIKE :pesquisa";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['pesquisa' => '%' . $pesquisa . '%']);
    } else {
        // Caso não haja pesquisa, exibe todos os registros
        $sql = "SELECT i.usuario_id, i.Nome_Completo, i.E_mail, t.tipo_treino 
                FROM informacoes i 
                LEFT JOIN treinos t ON i.usuario_id = t.usuario_id";
        $stmt = $pdo->query($sql);
    }

    $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Usuários</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fc;
            margin: 0;
            padding: 20px;
        }

        h1 {
            color: #333;
            text-align: center;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        a {
            text-decoration: none;
            color: #007bff;
        }

        a:hover {
            text-decoration: underline;
        }

        .alert {
            padding: 10px;
            background-color: #007bff;
            color: white;
            margin-bottom: 20px;
            text-align: center;
            border-radius: 5px;
        }

        .btn {
            background-color: #007bff;
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        .message {
            text-align: center;
            margin-top: 20px;
        }

        .message a {
            text-decoration: none;
            font-weight: bold;
        }

        .search-box {
            margin-bottom: 20px;
            text-align: center;
        }

        .search-box input[type="text"] {
            padding: 8px;
            width: 300px;
            font-size: 16px;
            margin-right: 10px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }

        .search-box button {
            padding: 8px 16px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .search-box button:hover {
            background-color: #0056b3;
        }

        .search-box .btn-clear {
            background-color: #007bff; /* Alterado para usar a mesma cor do botão de pesquisa */
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .search-box .btn-clear:hover {
            background-color: #0056b3; /* Alterado para ter o mesmo efeito de hover */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Gerenciamento de Usuários</h1>

        <?php if (isset($_SESSION['mensagem'])): ?>
            <div class="alert">
                <?php echo $_SESSION['mensagem']; unset($_SESSION['mensagem']); ?>
            </div>
        <?php endif; ?>

        <!-- Formulário de pesquisa -->
        <div class="search-box">
            <form method="get">
                <input type="text" name="pesquisa" placeholder="Pesquisar por nome, e-mail ou treino" value="<?php echo htmlspecialchars($pesquisa); ?>">
                <button type="submit">Pesquisar</button>

                <?php if ($pesquisa): ?>
                    <a href="crud.php" class="btn-clear">Voltar</a>
                <?php endif; ?>
            </form>
        </div>

        <!-- Tabela de resultados -->
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome Completo</th>
                    <th>E-mail</th>
                    <th>Treino</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($usuarios) > 0): ?>
                    <?php foreach ($usuarios as $usuario): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($usuario['usuario_id']); ?></td>
                            <td><?php echo htmlspecialchars($usuario['Nome_Completo']); ?></td>
                            <td><?php echo htmlspecialchars($usuario['E_mail']); ?></td>
                            <td><?php echo htmlspecialchars($usuario['tipo_treino'] ?? 'Nenhum treino'); ?></td>
                            <td>
                                <a href="edit.php?id=<?php echo $usuario['usuario_id']; ?>" class="btn">Editar</a>
                                <a href="crud.php?delete_id=<?php echo $usuario['usuario_id']; ?>" class="btn" onclick="return confirm('Tem certeza que deseja deletar este registro?');">Deletar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" style="text-align: center;">Nenhum resultado encontrado.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <div class="message">
        <a href="generate_pdf.php" class="btn">Baixar Lista de Usuários em PDF</a>
            <a href="admin_index.php" class="btn">Voltar para o Index</a>
        </div>
    </div>
</body>
</html>
