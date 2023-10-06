<!DOCTYPE html>
<html lang="pt">
    <head>
        <meta charset="utf-8">
        <title>Meus testes malucos</title>
    </head>

    <body>
        <p>Entre com o peso e a altura para saber se está obeso ou não</p>
        
        <form>

           Peso : <input name="peso">
            <br />
           Altura : <input name="altura">            
            <br />
            <button>Calcular o IMC</button>
        </form>

        <?php

            if (isset($_GET["peso"]) ) {
                $peso = $_GET["peso"];
                $altura = $_GET["altura"];
                $imc = ($peso / ($altura * $altura));
                    echo "<p>O IMC é $imc</p>";
                if ($imc < 18.5) {
                    echo "<p>Abaixo do peso</p>";
                } else if ($imc < 24.99){
                    echo "<p>Peso ideal</p>";
                } else if ($imc < 29.99){  
                    echo "<p>Levemente acima do peso</p>";
                } else if ($imc < 34.99){
                    echo "<p>Obesidade grau 1</p>";
                } else if ($imc < 39.99){
                    echo "<p>Obesidade grau 2 (severa)</p>";
                
                } else {
                    echo "<p>Obesidade grau 3 (mórbida)</p>";                

                }
            }
        ?>

    </body>

</html>