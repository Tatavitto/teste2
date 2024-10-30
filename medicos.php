<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Médicos</title>
</head>
<body>
    <h1>Cadastro de Médicos</h1>
    <form action="" method="POST">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required><br><br>

        <label for="especialidade">Especialidade:</label>
        <input type="text" id="especialidade" name="especialidade" required><br><br>

        <label for="crm">CRM:</label>
        <input type="text" id="crm" name="crm" required><br><br>
        
        <label for="usuario">Nome de Usuário:</label>
        <input type="text" id="usuario" name="usuario" required><br><br>
        
        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required><br><br>

        <input type="submit" value="Salvar">
    </form>

    <?php
    $servidor = 'localhost';
    $banco = 'hospital';
    $usuario = 'root';
    $senha = '';

    $conexao = new PDO("mysql:host=$servidor;dbname=$banco", $usuario, $senha);
    
    // Verificar se o formulário foi enviado
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $codigoSQL = "INSERT INTO `medicos` (`id`, `nome`, `especialidade`, `crm`, `usuario`, `senha`) VALUES (NULL, :nm, :esp, :crm, :user, :pass)";

        try {
            $comando = $conexao->prepare($codigoSQL);

            // Capturar os dados do formulário
            $resultado = $comando->execute(array(
                'nm' => $_POST['nome'],
                'esp' => $_POST['especialidade'],
                'crm' => $_POST['crm'],
                'user' => $_POST['usuario'],
                'pass' => $_POST['senha']
            ));

            if ($resultado) {
                header("Location: login.php");
            } else {
                echo "<p>Erro ao executar o comando!</p>";
            }
        } catch (Exception $e) {
            echo "Erro: " . $e->getMessage();
        }
    }

    $conexao = null;
    ?>
</body>
</html>


