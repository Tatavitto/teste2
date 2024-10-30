<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Receitas</title>
</head>
<body>
    <h1>Cadastro de Receitas</h1>
    <form action="" method="POST">
        <label for="pac">Paciente:</label>
        <input type="text" id="pac" name="pac" required><br><br>

        <label for="rem">Medicamento:</label>
        <input type="text" id="rem" name="rem" required><br><br>
        
        <label for="data">Data:</label>
        <input type="date" id="data" name="data" required><br><br>
        
        <label for="hora">Hora:</label>
        <input type="time" id="hora" name="hora" required><br><br>
        
        <label for="dose">Dose:</label>
        <input type="text" id="dose" name="dose" required><br><br>

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
        $codigoSQL = "INSERT INTO `receitas` (`id`, `paciente`, `medicamento`, `data`, `hora`, `dose`) VALUES (NULL, :pac, :rem, :data, :hora, :dose)";

        try {
            $comando = $conexao->prepare($codigoSQL);

            // Capturar os dados do formulário
            $resultado = $comando->execute(array(
                'pac' => $_POST['pac'],
                'rem' => $_POST['rem'],
                'data' => $_POST['data'],
                'hora' => $_POST['hora'],
                'dose' => $_POST['dose']
            ));

            if ($resultado) {
                echo "<p>Receita cadastrada!</p>";
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


