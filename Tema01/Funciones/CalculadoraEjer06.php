<?php

    $resultado=null;

    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $num1=$_POST["num1"];
        $num2=$_POST["num2"];
        $operacion=$_POST["operacion"];
        switch ($operacion) {
            case 'sumar':
                $resultado = $num1 + $num2;
                break;
            case 'restar':
                $resultado = $num1 - $num2;
                break;
            case 'multiplicar':
                $resultado = $num1 * $num2;
                break;
            case 'dividir':
                if ($num2 != 0) {
                    $resultado = $num1 / $num2;
                } else {
                    $resultado = "No se puede dividir por cero.";
                }
                break;
        }
    }
    
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora</title>
</head>

<body>
    <h1>Calculadora</h1>

    <form method="post">
        <label for="num1">Número 1:</label>
        <input type="number" id="num1" name="num1" required><br><br>

        <label for="num2">Número 2:</label>
        <input type="number" id="num2" name="num2" required><br><br>

        <label for="operacion">Elige una operación:</label>
        <select id="operacion" name="operacion">
            <option value="sumar">Sumar</option>
            <option value="restar">Restar</option>
            <option value="multiplicar">Multiplicar</option>
            <option value="dividir">Dividir</option>
        </select><br><br>

        <input type="submit" value="Calcular">
    </form>

    <?php

    // Mostramos el resultado solo si se ha calculado algo
if ($resultado !== null) {
    echo "<h2>Resultado:</h2>";
    echo "<p>El resultado es: <strong>$resultado</strong></p>";
}
?>

</body>

</html>