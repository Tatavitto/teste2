<?php
session_start(); // Inicia a sessão

$servidor = 'localhost';
$banco = 'hospital';
$usuario = 'root';
$senha = '';

$conexao = new PDO("mysql:host=$servidor;dbname=$banco", $usuario, $senha);

// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    // Consulta para verificar o médico
    $codigoSQL = "SELECT * FROM `medicos` WHERE `usuario` = :user";
    $comando = $conexao->prepare($codigoSQL);
    $comando->execute(array('user' => $usuario));
    $medico = $comando->fetch(PDO::FETCH_ASSOC);

    // Verifica se o médico foi encontrado e se a senha está correta
    if ($medico && $senha === $medico['senha']) {
        // Armazena a informação na sessão
        $_SESSION['medico'] = $medico['nome']; // ou qualquer outra informação que você queira
        header("Location: dashboardM.php"); // Redireciona para a página de dashboard
        exit();
    } else {
        $erro = "Usuário ou senha inválidos!";
    }
}

$conexao = null;
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login de Médicos</title>
</head>
<body>
    <h1>Login de Médicos</h1>
    <form action="" method="POST">
        <label for="usuario">Usuário:</label>
        <input type="text" id="usuario" name="usuario" required><br><br>

        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required><br><br>

        <input type="submit" value="Entrar">
    </form>

    <?php if (isset($erro)): ?>
        <p style="color: red;"><?php echo $erro; ?></p>
    <?php endif; ?>
</body>
</html>
