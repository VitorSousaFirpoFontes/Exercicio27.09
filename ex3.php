<?php 
session_start(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="POST" action="">
        <label for="numero">Digite um número</label>
        <input type="number" name="numero" required>
        <input type="submit">
    </form>

    <?php 
    
    if (isset($_POST['numero'])) {
        $numero = $_POST['numero'];
        $_SESSION['numeros'][] = $numero; 
    }

 
    if (!empty($_SESSION['numeros'])) {
        echo "<h3>Números armazenados:</h3>";
        foreach ($_SESSION['numeros'] as $num) {
            echo $num . "<br>"; 
        }
    }
    ?>
</body>
</html>
