<?php include 'conexao.php'
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Formulário de Cadastro</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }
        body {
            background-color: #f9f9f9;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #333;
        }
        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="date"],
        input[type="tel"],
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            background-color: #fdfdfd;
        }
        input[type="password"] {
            background-color: #f7f7f7;
        }
        .login{
           
            color: #007bff;
            text-decoration: none;
            font-size: 14px;
        }
        a:hover {
            text-decoration: underline;
        }
        
        button {
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #0056b3;
        }
        @media (max-width: 600px) {
            .container {
                padding: 15px;
            }
            h2 {
                font-size: 22px;
            }
            button {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Formulário de Cadastro</h2>
        <form id="formCadastro" action="#" method="post">
            <div class="form-group">
                <label for="nome_completo" >Nome Completo</label>
                <input type="text" id="nome_completo" name="nome_completo" required>
            </div>
            <div class="form-group">
                <label for="data_nascimento">Data de Nascimento</label>
                <input type="date" id="data_nascimento" name="data_nascimento" required>
            </div>
            <div class="form-group">
                <label for="sexo">Sexo</label>
                <select id="sexo" name="sexo" required>
                    <option value="M">Masculino</option>
                    <option value="F">Feminino</option>
                    <option value="Outro">Outro</option>
                </select>
            </div>
            <div class="form-group">
                <label for="nome_materno">Nome Materno</label>
                <input type="text" id="nome_materno" name="nome_materno" required>
            </div>
            <div class="form-group">
                <label for="cpf">CPF</label>
                <input type="text" id="cpf" name="cpf" pattern="\d{11}" placeholder="Apenas números" required>
            </div>
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="telefone_celular">Telefone Celular</label>
                <input type="tel" id="telefone_celular" name="telefone_celular" pattern="\d{11}" placeholder="Apenas números" required>
            </div>
            <div class="form-group">
                <label for="telefone_fixo">Telefone Fixo</label>
                <input type="tel" id="telefone_fixo" name="telefone_fixo" pattern="\d{8,10}" placeholder="Apenas números">
            </div>
            <div class="form-group">
                <label for="endereco_completo">Endereço Completo</label>
                <input type="text" id="endereco_completo" name="endereco_completo" required>
            </div>
            <div class="form-group">
                <label for="login">Login</label>
                <input type="text" id="login" name="login" required>
            </div>
            <div class="form-group">
                <label for="senha">Senha</label>
                <input type="password" id="senha" name="senha" required>
            </div>
            <div class="form-group">
                <label for="confirma_senha">Confirmação da Senha</label>
                <input type="password" id="confirma_senha" name="confirma_senha" required>
            </div>
            <a href="login.php" class="login">ja tenho login</a>
            <br><br>
            <button type="submit">Cadastrar</button>
            <button type="reset" style="margin-top: 10px; background-color: #6c757d;">Limpar</button>
        </form>
    </div>



    <div id="mensagem"></div>

<script>
    $(document).ready(function() {
        $('#formCadastro').on('submit', function(event) {
            event.preventDefault(); // Evita o envio normal do formulário

            $.ajax({
                url: 'conexao.php',
                type: 'POST',
                data: $(this).serialize(), // Envia todos os dados do formulário
                success: function(response) {
                    $('#mensagem').html(response); // Exibe a mensagem na div
                },
                error: function() {
                    $('#mensagem').html('Ocorreu um erro ao processar sua solicitação.');
                }
            });
        });
    });
</script>




</body>

</html>