<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Academia FitLife</title>
    

</head>

<style>
    *{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: Arial, sans-serif;
}html {
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
}

.banner-content .btn:hover {
    background: #e65c00;
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
                <li><a href= "crud.php">crud</a></li>
                <li><a href="logout.php">Sair</a></li>
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
        <div class="planos-container">
            <div class="plano">
                <h3>Plano A</h3>
            </div>
            <div class="plano">
                <h3>Plano B</h3>
                
            </div>
            <div class="plano">
                <h3>Plano C</h3>
            </div>
        </div>
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
