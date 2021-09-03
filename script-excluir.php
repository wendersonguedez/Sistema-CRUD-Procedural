<!doctype html>
<html lang="pt-br">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Exclusão de Cadastro</title>
    <!-- Bootstrap CSS Online -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
</head>
<body>

    <div class="container">
        <div class="row"> <!-- classe para criar uma linha -->
            <?php
            // chamando o arquivo de conexao do banco
            include "conexao.php";
            $id = $_POST['id']; 
            $nome = $_POST['nome'];

            /* instrução sql que permite a exclusão dos dados no banco de dados. a instrução esta sendo armazenada na variavel $sql */
            $sql = "DELETE FROM pessoas WHERE cod_pessoa = $id;";

            // mysqli_query é uma função que vai fazer uma solicitação para o banco de dados. o primeiro parametro é responsavel pela conexão com a base de dados. o segundo, é a instrução sql que você deseja realizar.
            if (mysqli_query($conn, $sql)){ 
                mensagem("$nome foi excluído(a) com sucesso!", 'success'); // mensagem é uma função que foi criada no arquivo conexao. o primeiro parametro é o texto que sera exibido para o usuario, e logo em seguida o tipo do texto (bootstrap).
            } else
            mensagem("$nome NÃO FOI excluído(a)!", 'danger');
        
            ?>
            <!-- criação do botão para voltar a pagina principal -->
            <a href="index.php" class="btn btn-primary">Voltar</a>
        </div>
    </div>



    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>