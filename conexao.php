<?php
// Configurações de conexão com o banco de dados
$host = 'localhost';
$dbname = 'forjfacul';
$username = 'root';
$password = '';

try {
    // Conectar ao banco de dados usando PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Verificar se o formulário foi enviado
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Receber os dados do formulário
        $nome = $_POST['nome_completo'] ?? null;
        $nome_materno = $_POST['nome_materno'] ?? null;
        $data_nascimento = $_POST['data_nascimento'] ?? null;
        $sexo = $_POST['sexo'] ?? null;
        $cpf = $_POST['cpf'] ?? null;
        $telefone_celular = $_POST['telefone_celular'] ?? null;
        $telefone_fixo = $_POST['telefone_fixo'] ?? null; 
        $endereco_completo = $_POST['endereco_completo'] ?? null;
        $login = $_POST['login'] ?? null;
        $senha = $_POST['senha'] ?? null;
        $confirmacaoSenha = $_POST['confirma_senha'] ?? null;
        $email = $_POST['email'] ?? null;

        // Verificar se a senha e a confirmação coincidem
        if ($senha !== $confirmacaoSenha) {
            echo "As senhas não coincidem. Por favor, tente novamente.";
            exit;
        }

        // Verificar se o login já existe no banco de dados
        $consultaLogin = $pdo->prepare("SELECT COUNT(*) FROM informacoes WHERE Login = :login");
        $consultaLogin->bindParam(':login', $login);
        $consultaLogin->execute();
        $loginExistente = $consultaLogin->fetchColumn();

        if ($loginExistente > 0) {
            echo "O login já existe. Por favor, tente novamente com um login diferente.";
            exit;
        }

        // Criptografar a senha
        $senhaCriptografada = password_hash($senha, PASSWORD_DEFAULT);

        // Preparar a consulta SQL para inserir dados
        $sql = "INSERT INTO informacoes (Nome_Completo, Nome_Materno, Data_de_Nascimento, Sexo, Cpf, E_mail, Telefone_Celular, Telefone_Fixo, Endereço_Completo, Senha, Login) 
                VALUES (:nome_completo, :nome_materno, :data_nascimento, :sexo, :cpf, :email, :telefone_celular, :telefone_fixo, :endereco_completo, :senha, :login)";
        $stmt = $pdo->prepare($sql);

        // Associar valores aos parâmetros
        $stmt->bindParam(':nome_completo', $nome);
        $stmt->bindParam(':nome_materno', $nome_materno);
        $stmt->bindParam(':data_nascimento', $data_nascimento);
        $stmt->bindParam(':sexo', $sexo);
        $stmt->bindParam(':cpf', $cpf);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':telefone_celular', $telefone_celular);
        $stmt->bindParam(':telefone_fixo', $telefone_fixo);
        $stmt->bindParam(':endereco_completo', $endereco_completo);
        $stmt->bindParam(':login', $login);
        $stmt->bindParam(':senha', $senhaCriptografada);

        // Executar a consulta
        $stmt->execute();

        echo "Usuário cadastrado com sucesso!";
    }
} catch (PDOException $e) {
    // Exibir mensagem de erro se algo der errado
    echo "Erro: " . $e->getMessage();
}
?>
