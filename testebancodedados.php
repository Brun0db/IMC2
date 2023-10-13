<!DOCTYPE html>
<html lang="pt">
    <head>
        <meta charset="utf-8">
        <title>Título da página</title>
    </head>

    <body>

        <form>
            Nome: <input name="nome">
            <br />
            Idade: <input name="idade">
            <br />
            Bairro: <input name="bairro">
            <br />
            <button>Cadastrar</button>
        </form>

        <?php

            $host = "localhost";
            $usuario = "root";
            $senha = "";
            $banco = "testeaula";
            $porta = 3306;

            $conexao = new PDO("mysql:host=$host;porta=$porta;dbname=$banco",$usuario,$senha);

            if (isset($_GET["nome"]) ) {

                $nome = $_GET["nome"];
                $idade = $_GET["idade"];
                $bairro = $_GET["bairro"];

                $sql = "INSERT INTO notas (nome,idade,bairro) VALUES (:nome,:idade,:bairro)";
                $consulta = $conexao->prepare($sql);
                $consulta->bindParam(":nome",$nome);
                $consulta->bindParam(":idade",$idade);
                $consulta->bindParam(":bairro",$bairro);
                $consulta->execute();
            }

            if (isset($_GET["acao"]) ) {
                $id = $_GET["id"];
                $sql = "DELETE FROM notas WHERE id = :id";
                $consulta = $conexao->prepare($sql);
                $consulta->bindParam("id",$id);
                $consulta->execute();
                
            }


            $sql = "SELECT id,nome,idade,bairro FROM notas";
            $consulta = $conexao->prepare($sql);
            $consulta->execute();
            $resultados = $consulta->fetchAll(PDO::FETCH_ASSOC);         

            echo "<table border=1><tr><td>ID</td><td>Nome</td><td>Idade</td><td>Bairro</td><td>Ação</td></tr>";
            foreach( $resultados as $cadastro) {
                $id = $cadastro["id"];
                $nome = $cadastro["nome"];
                $idade = $cadastro["idade"];
                $bairro = $cadastro["bairro"];
                ?>
                    <tr>
                        <td><?=$id?></td>
                        <td><?=$nome?></td>
                        <td><?=$idade?></td>
                        <td><?=$bairro?></td>
                        <td><a href=testebancodedados.php?acao=remover&id=<?=$id?>>Remover</a></td>
                    </tr>


                <?php

            }
            echo "</table>";

            
            

        ?>  



    </body>

</html>
