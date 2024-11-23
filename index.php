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
    $sql = "SELECT usuario_id, Nome_Completo FROM informacoes WHERE usuario_id = :usuario_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':usuario_id', $usuario_id);
    $stmt->execute();
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$usuario) {
        // Caso o usuário não seja encontrado
        echo "Usuário não encontrado!";
        exit();
    }
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $tipo_treino = $_POST['tipo_treino'];

        if (!in_array($tipo_treino, ['Treino A', 'Treino B', 'Treino C'])) {
            $mensagem = "Tipo de treino inválido!";
        } else {
            // Verificar se já existe um treino para o usuário
            $sql = "SELECT id FROM treinos WHERE usuario_id = :usuario_id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':usuario_id', $usuario_id);
            $stmt->execute();
            $treino_existente = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($treino_existente) {
                // Atualizar o treino existente
                $sql = "UPDATE treinos SET tipo_treino = :tipo_treino WHERE usuario_id = :usuario_id";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':tipo_treino', $tipo_treino);
                $stmt->bindParam(':usuario_id', $usuario_id);
                $stmt->execute();
                $mensagem = "Treino atualizado para '$tipo_treino'.";
            } else {
                // Inserir um novo treino
                $sql = "INSERT INTO treinos (usuario_id, tipo_treino) VALUES (:usuario_id, :tipo_treino)";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':usuario_id', $usuario_id);
                $stmt->bindParam(':tipo_treino', $tipo_treino);
                $stmt->execute();
                $mensagem = "Treino cadastrado como '$tipo_treino'.";
            }
        }
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
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Academia FitLife</title>
    

</head>

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: Arial, sans-serif;
    }

    html {
        scroll-behavior: smooth;
    }

    body {
        line-height: 1.6;
    }

    header {
        background: #333;
        color: #fff;
        padding: 10px 0;
        text-align: center;
    }

    .logo h1 {
        margin: 0;
    }

    nav ul {
        list-style: none;
        display: flex;
        justify-content: center;
    }

    nav ul li {
        margin: 0 15px;
    }

    nav ul li a {
        color: #fff;
        text-decoration: none;
        font-size: 18px;
    }

    .banner {
        background: url('banner.jpg') no-repeat center center/cover;
        height: 80vh;
        display: flex;
        justify-content: center;
        align-items: center;
        text-align: center;
    }

    .banner-content h2 {
        font-size: 50px;
        color: #050000;
    }

    .banner-content p {
        font-size: 24px;
        color: #333;
        margin-bottom: 20px;
    }

    .banner-content .btn {
        background: #ff6600;
        color: #fff;
        padding: 10px 20px;
        text-decoration: none;
        border-radius: 5px;
        box-shadow: 0 5px 15px rgba(255, 102, 0, 0.3); /* Sombra para destaque */
        transition: all 0.3s ease; /* Animação suave */
    }

    .banner-content .btn:hover {
        background: #e65c00;
        box-shadow: 0 5px 20px rgba(255, 102, 0, 0.5); /* Sombra mais forte no hover */
        transform: translateY(-2px); /* Efeito de levitar */
    }

    section {
        padding: 50px 20px;
        text-align: center;
    }

    #sobre p {
        max-width: 800px;
        margin: 20px auto;
        font-size: 18px;
    }

    .planos-container {
        display: flex;
        justify-content: space-around;
        flex-wrap: wrap;
    }

    .plano {
        background: #f4f4f4;
        border-radius: 5px;
        width: 30%;
        margin: 10px;
        display: inline-block;
        padding: 20px 40px;
        background-color: #ff6600;
        color: #000000;
        text-align: center;
        cursor: pointer;
        border-radius: 5px;
        font-size: 18px;
    }

    .plano h3 {
        margin-bottom: 10px;
        font-size: 22px;
    }

    footer {
        background: #333;
        color: #fff;
        padding: 20px;
        text-align: center;
    }

    footer p {
        margin-bottom: 10px;
    }

    .social-media a img {
        width: 30px;
        margin: 0 10px;
    }

    .social-media a:hover {
        opacity: 0.7;
    }

    .treinos button {
        display: inline-block;
        margin: 10px 5px;
        padding: 10px 20px;
        background:#333; /* Cor de fundo mais vibrante */
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        box-shadow: 0 5px 15px rgba(255, 102, 0, 0.3); /* Sombra para destaque */
        transition: all 0.3s ease; /* Animação suave */
    }

    .treinos button:hover {
        background:#334; /* Tom mais escuro no hover */
        box-shadow: 0 5px 20px rgba(255, 102, 0, 0.5); /* Sombra mais forte no hover */
        transform: translateY(-2px); /* Efeito de levitar */
    }

    .mensagem {
        margin-top: 20px;
        padding: 10px;
        background-color: #ffecb3; /* Cor suave de fundo laranja */
        color: #ff6600; /* Cor de texto laranja */
        border: 1px solid #e5c100; /* Cor de borda mais escura */
        border-radius: 5px;
        text-align: center;
    }
</style>


</style>

<body>
   
    <header>
        <div class="logo">
            <h1>Academia FitLife</h1>
        </div>
        <nav>
        
            <ul>
                <li><a href="#home">Início</a></li>
                <li><a href="#sobre">Sobre</a></li>
                <li><a href="#planos">Planos</a></li>
                <li><a href="#contato">Contato</a></li>
                <li><a href= perfil.php>perfil</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <section id="home" class="banner">
        <div class="banner-content">
            <h2>Bem-vindo à FitLife</h2>
            <p>Seu estilo de vida saudável começa aqui.</p>
            <a href="#planos" class="btn">Saiba Mais</a>
        </div>
        <div class="imagens">


        </div>
    </section>

    <section id="sobre">
        <h2>Sobre Nós</h2>
        <p>Na Academia FitLife, acreditamos que saúde e bem-estar são para todos. Oferecemos uma estrutura completa com equipamentos modernos, treinadores qualificados e um ambiente amigável.</p>
    </section>

    <section id="planos">
        <h2>Nossos Planos</h2>
         <form method="POST" class="treinos">
            <div class="plano">
                <h3>Plano A</h3>
                <button type="submit" name="tipo_treino" value="Treino A">Treino A</button>
            </div>
            <div class="plano">
                <h3>Plano B</h3>
                <button type="submit" name="tipo_treino" value="Treino B">Treino B</button>
            </div>
            <div class="plano">
                <h3>Plano C</h3>
                <button type="submit" name="tipo_treino" value="Treino C">Treino C</button>
            </div>
        </form>
        <?php if (isset($mensagem)): ?>
            <div class="mensagem"><?= htmlspecialchars($mensagem) ?></div>
        <?php endif; ?>
        
    </section>

    <footer id="contato">
        <h2>Contato</h2>
        <p>Endereço: Rua Sarandi 69, - Nova york</p>
        <p>Telefone: (21) 99999-9999</p>
        <p>Email: contato@fitlife.com.br</p>
        <div class="social-media">
            <a href="#"><img src="icon-facebook.png" alt="Facebook"></a>
            <a href="#"><img src="icon-instagram.png" alt="Instagram"></a>
        </div>
    </footer>
</body>
</html>
