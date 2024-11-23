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

    // Buscar informações do usuário para editar
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Buscar dados do usuário
        $sql = "SELECT Nome_Completo, E_mail FROM informacoes WHERE usuario_id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$usuario) {
            $_SESSION['mensagem'] = "Usuário não encontrado.";
            header("Location: crud.php");
            exit();
        }

        // Buscar dados do treino
        $sqlTreino = "SELECT tipo_treino FROM treinos WHERE usuario_id = :id";
        $stmtTreino = $pdo->prepare($sqlTreino);
        $stmtTreino->bindParam(':id', $id);
        $stmtTreino->execute();
        $treino = $stmtTreino->fetch(PDO::FETCH_ASSOC);
    }

    // Atualizar os dados do usuário e treino
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'];
        $nomeCompleto = $_POST['Nome_Completo'];
        $email = $_POST['E_mail'];
        $tipoTreino = $_POST['tipo_treino'];

        // Atualizar informações do usuário
        $sql = "UPDATE informacoes SET Nome_Completo = :nome, E_mail = :email WHERE usuario_id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':nome', $nomeCompleto);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        // Atualizar informações de treino
        $sqlTreino = "UPDATE treinos SET tipo_treino = :treino WHERE usuario_id = :id";
        $stmtTreino = $pdo->prepare($sqlTreino);
        $stmtTreino->bindParam(':treino', $tipoTreino);
        $stmtTreino->bindParam(':id', $id);
        $stmtTreino->execute();

        $_SESSION['mensagem'] = "Registro atualizado com sucesso.";
        header("Location: crud.php");
        exit();
    }
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
    <title>Editar Usuário</title>
</head>
<body>
    <h1>Editar Usuário</h1>

    <!-- Formulário de edição -->
    <form action="edit.php" method="POST">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">

        <!-- Campo para nome completo -->
        <label for="Nome_Completo">Nome Completo:</label>
        <input type="text" id="Nome_Completo" name="Nome_Completo" value="<?php echo htmlspecialchars($usuario['Nome_Completo']); ?>" required>
        <br><br>

        <!-- Campo para e-mail -->
        <label for="E_mail">E-mail:</label>
        <input type="email" id="E_mail" name="E_mail" value="<?php echo htmlspecialchars($usuario['E_mail']); ?>" required>
        <br><br>

        <!-- Campo para tipo de treino com opções restritas -->
        <label for="tipo_treino">Tipo de Treino:</label>
        <select id="tipo_treino" name="tipo_treino" required>
            <option value="Treino A" <?php echo (isset($treino['tipo_treino']) && $treino['tipo_treino'] === 'Treino A') ? 'selected' : ''; ?>>Treino A</option>
            <option value="Treino B" <?php echo (isset($treino['tipo_treino']) && $treino['tipo_treino'] === 'Treino B') ? 'selected' : ''; ?>>Treino B</option>
            <option value="Treino C" <?php echo (isset($treino['tipo_treino']) && $treino['tipo_treino'] === 'Treino C') ? 'selected' : ''; ?>>Treino C</option>
        </select>
        <br><br>

        <!-- Botão de salvar -->
        <button type="submit">Salvar</button>
    </form>

    <br>
    <a href="crud.php">Voltar</a>
</body>
</html>
