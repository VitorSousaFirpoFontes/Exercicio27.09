<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="POST" action="">
        <label for="nome_aluno">Nome do aluno</label>
        <input type="text" name="nome_aluno" required>
        <label for="nota_aluno">Nota do aluno</label>
        <input type="number" name="nota_aluno" required>
        <button type="submit">Enviar</button>
    </form>

    <?php 
 
    $quantidade_alunos = 0;
    $soma_notas = 0;

  
    if (isset($_POST['nome_aluno']) && isset($_POST['nota_aluno'])) {
        $nome_aluno = $_POST['nome_aluno'];
        $nota_aluno = $_POST['nota_aluno'];

      
        $quantidade_alunos++;
        $soma_notas += $nota_aluno;

        
        if ($quantidade_alunos > 0) {
            $media = $soma_notas / $quantidade_alunos;
            echo "Média das notas: " . $media;
        }
    }
    ?>
</body>
</html>
