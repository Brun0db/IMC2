<!DOCTYPE html>
<html lang="pt">
    <head>
        <meta charset="utf-8">
        <title>Desafio 3</title>
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
        function lerParametro($parametro) {
            return isset($_GET[$parametro]) ? $_GET[$parametro] : null;
        }

        function conectarBanco() {
            $host = "localhost";
            $usuario = "root";
            $senha = "";
            $banco = "testeaula";
            $porta = 3306;

            try {
                return new PDO("mysql:host=$host;porta=$porta;dbname=$banco",$usuario,$senha);
            } catch (PDOexception $e) {
                die("Erro na tentativa de usar o bando de dados: " . $e->getMessage());
            }
        } 

        function executarConsulta($sql, $parametros = []) {
            $conexao = conectarBanco();
            $consulta = $conexao->prepare($sql);
            $consulta->execute($parametros);
            return $consulta;

        }

        function inserirRegistro($nome, $idade, $bairro)  {
            $sql = "INSERT INTO notas (nome,idade,bairro) VALUES (:nome,:idade,:bairro)";
            executarConsulta($sql, ['nome' => $nome, 'idade' => $idade, 'bairro' => $bairro]);
        }

        function excluirRegistro($id) {
            $sql = "DELETE FROM notas WHERE id = :id";
            executarConsulta($sql, [':id']);
        }

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $nome = $_POST["nome"];
            $idade = $_POST["idade"];
            $bairro = $_POST["bairro"];
            inserirRegistro($nome, $idade, $bairro);
        }

        if ($acao = lerParametro("acao")) {
            $id = lerParametro("id");
            if ($acao === "remover" && $id !== null) {
                excluirRegistro($id);
            }
        }

        $sql = "SELECT id, nome, idade, bairro FROM notas";
        $consulta = executarConsulta($sql);
        $resultados = $consulta->fetchAll(PDO::FETCH_ASSOC);

        echo "<h2>Registros</h2>";
        echo "<table border='1'>";
        echo "<tr><td>Nome</td><td>Idade</td><td>Bairro</td><td>Ação</td></tr>";

        foreach ($resultados as $cadastro) {
            $id = $cadastro["id"];
            $nome = $cadastro["nome"];
            $idade = $cadastro["idade"];
            $bairro = $cadastro["bairro"];

            echo "<tr>";
            echo "<td>$id</td>";
            echo "<td>$nome</td>";
            echo "<td>$idade</td>";
            echo "<td>$bairro</td>";
            echo "<td><a href='?acao=remover&id=$id'>Remover</a></td>";
            echo "</tr>";
        }

        echo "</table>";
        ?>

        

    </body>

</html>
