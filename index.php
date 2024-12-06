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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    

</head>

<style>
      :root {
            --bg-color: #ffffff;
            --text-color: #000000;
            --accent-color: #ff6600;
        }

        .dark-mode {
            --bg-color: #121212;
            --text-color: #ffffff;
            --accent-color: #ff6600;
        }

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
        background-color: var(--bg-color);
           
            font-family: Arial, sans-serif;
            line-height: 1.6;
            transition: background-color 0.3s ease, color 0.3s ease;

    }

    header {
        background: #333;
        color: var(--text-color);
        padding: 10px 0;
        text-align: center;
    }

    .logo h1 {
        color: #ffffff;
        margin: 0;
        text-align: center
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
        color: var(--text-color);
    }

    .banner-content p {
        font-size: 24px;
        color: var(--text-color);   
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
        color: var(--text-color); 
        max-width: 800px;
        margin: 20px auto;
        font-size: 18px;
    }
    #sobre {
        color: var(--text-color); 
        max-width: 800px;
        margin: 20px auto;
        font-size: 18px;
    }

    .planos-container {
        display: flex;
        justify-content: space-around;
        flex-wrap: wrap;
        color: var(--text-color);
    }
    #titulo_plano{
        color: var(--text-color);
    }

    .plano {
        background: #f4f4f4;
        border-radius: 5px;
        width: 30%;
        margin: 10px;
        display: inline-block;
        padding: 20px 40px;
        background-color: #ff6600;
        color: var(--text-color);
        text-align: center;
        cursor: pointer;
        border-radius: 5px;
        font-size: 18px;

    }

    .plano h3 {
        margin-bottom: 10px;
        font-size: 22px;
        color: var(--text-color);
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
    #dark-mode-toggle, #font-size-toggle {
    background: var(--accent-color);
    color: var(--text-color);
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    box-shadow: 0 5px 15px rgba(255, 102, 0, 0.3);
    transition: all 0.3s ease;
}

#dark-mode-toggle:hover, #font-size-toggle:hover {
    background: #e65c00;
    box-shadow: 0 5px 20px rgba(255, 102, 0, 0.5);
    transform: translateY(-2px);
}

    #font-size-toggle {
    background: var(--accent-color);
    color: var(--text-color);
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    box-shadow: 0 5px 15px rgba(255, 102, 0, 0.3);
    transition: all 0.3s ease;
}
#font-size-toggle:hover {
    background: #e65c00;
    box-shadow: 0 5px 20px rgba(255, 102, 0, 0.5);
    transform: translateY(-2px);
}
.large-font {
        font-size: 1.2em; /* Aumenta o tamanho da fonte para 20% maior */
}

</style>




<body>
   
    <header>
        <div class="logo">
            <h1>Academia FitLife</h1>
        </div>
        <nav>
        
            <ul id=side_itens>
                <li class="side_item">
                    <a href="#home">
                    <i class="fa-solid fa-house"></i>
                    <span>Início</span></a></li>
                <li class="side_item">
                    <a href="#sobre">
                    <i class="fa-solid fa-people-group"></i>
                    <span>Sobre</span></a></li>
                <li class="side_item">
                    <a href="#planos">
                    <i class="fa-solid fa-dumbbell"></i>
                    <span>Planos</span></a></li>
                <li class="side_item">
                    <a href="#contato">
                    <i class="fa-solid fa-phone"></i>
                    <span>Contato</span></a></li>
                <li class="side_item">
                    <a href= perfil.php>
                    <i class="fa-solid fa-user"></i>
                    <span>perfil</span></a></li>
                <li class="side_item">
                    <a href="logout.php">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <span>Logout</span></a></li>
            </ul>
        </nav>
        <button id="dark-mode-toggle">Alternar Claridade</button>
        <button id="font-size-toggle">Alternar Fonte</button>

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
        <h2 id= titulo_plano>Escolha seu treino</h2>
         <form method="POST" class="treinos">
            <div class="plano">
                <h3>Superiores </h3>
                <button type="submit" name="tipo_treino" value="Treino A">Treino A</button>
            </div>
            <div class="plano">
                <h3>Inferiores</h3>
                <button type="submit" name="tipo_treino" value="Treino B">Treino B</button>
            </div>
            <div class="plano">
                <h3>Inferiores e Superiores</h3>
                <button type="submit" name="tipo_treino" value="Treino C">Treino C</button>
            </div>
        </form>
        <?php if (isset($mensagem)): ?>
            <div class="mensagem"><?= htmlspecialchars($mensagem) ?></div>
        <?php endif; ?>
        
    </section>

    <footer id="contato">
        <h2>Contato</h2>
        <p>Endereço: Av. Paris, 84 - Bonsucesso Rio de Janeiro</p>
        <p>Telefone: (21) 99999-9999</p>
        <p>Email: contato@fitlife.com.br</p>
        <div class="social-media">
            <a href="#"><i class="fa-brands fa-facebook"></i></a>
            <a href="#"><i class="fa-brands fa-instagram"></i> </a>
        </div>
    </footer>
    <script>
        const darkModeToggle = document.getElementById('dark-mode-toggle');
        const fontSizeToggle = document.getElementById('font-size-toggle');

        // Verifica se o modo escuro está ativo no localStorage
        if (localStorage.getItem('darkMode') === 'true') {
            document.body.classList.add('dark-mode');
        }

        darkModeToggle.addEventListener('click', () => {
            document.body.classList.toggle('dark-mode');
            const isDarkMode = document.body.classList.contains('dark-mode');
            localStorage.setItem('darkMode', isDarkMode);
        });    fontSizeToggle.addEventListener('click', () => {
        document.body.classList.toggle('large-font');
        const isLargeFont = document.body.classList.contains('large-font');
        localStorage.setItem('largeFont', isLargeFont);
    });

    </script>
</body>
</html>
index.php
14 KB