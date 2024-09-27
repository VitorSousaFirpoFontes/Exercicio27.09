<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos e Preços</title>
</head>
<body>
    
<form action="" method="post">
    <label>Nome do Produto:</label>
    <input type="text" name="nome_produto" required><br>
    
    <label>Preço do Produto (R$):</label>
    <input type="number" step="0.01" name="preco_produto" required><br>
    
    <input type="submit" value="Adicionar Produto">
    <button type="submit" name="clear">Limpar Produtos</button>
</form>

<?php
session_start();


if (isset($_POST['clear'])) {
    session_unset();
    echo "Lista de produtos foi limpa!<br>";
}

if (!isset($_SESSION['produtos'])) {
    $_SESSION['produtos'] = [];
}


if (isset($_POST['nome_produto']) && isset($_POST['preco_produto']) && !isset($_POST['clear'])) {
    $nome = $_POST['nome_produto'];
    $preco = (float)$_POST['preco_produto'];
    $_SESSION['produtos'][] = ['nome' => $nome, 'preco' => $preco];
}


function contarProdutosInferiores($produtos, $limite) {
    $contagem = 0;
    foreach ($produtos as $produto) {
        if ($produto['preco'] < $limite) {
            $contagem++;
        }
    }
    return $contagem;
}


function produtosEntrePrecos($produtos, $limiteInferior, $limiteSuperior) {
    $nomes = [];
    foreach ($produtos as $produto) {
        if ($produto['preco'] >= $limiteInferior && $produto['preco'] <= $limiteSuperior) {
            $nomes[] = $produto['nome'];
        }
    }
    return $nomes;
}


function mediaPrecosSuperiores($produtos, $limite) {
    $soma = 0;
    $contagem = 0;
    foreach ($produtos as $produto) {
        if ($produto['preco'] > $limite) {
            $soma += $produto['preco'];
            $contagem++;
        }
    }
    return $contagem > 0 ? $soma / $contagem : 0;
}


if (!empty($_SESSION['produtos'])) {
    $produtos = $_SESSION['produtos'];


    $quantidadeInferior = contarProdutosInferiores($produtos, 50);

  
    $produtosEntre = produtosEntrePrecos($produtos, 50, 100);


    $mediaSuperior = mediaPrecosSuperiores($produtos, 100);

    echo "<h3>Resumo dos Produtos</h3>";
    echo "Quantidade de produtos com preço inferior a R$50,00: $quantidadeInferior<br>";
    echo "Produtos com preço entre R$50,00 e R$100,00: " . implode(", ", $produtosEntre) . "<br>";
    echo "Média dos preços dos produtos com preço superior a R$100,00: R$ " . number_format($mediaSuperior, 2, ',', '.') . "<br>";

    echo "<h3>Produtos Adicionados:</h3>";
    foreach ($produtos as $produto) {
        echo "Produto: " . $produto['nome'] . " - Preço: R$ " . number_format($produto['preco'], 2, ',', '.') . "<br>";
    }
}
?>

</body>
</html>
