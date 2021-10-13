<!doctype html>
<html lang="pt-br">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cadastro</title>
    <!-- Bootstrap CSS Online -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
</head>
<body class="bg-dark text-light">
    <div class="container">
        <div class="row"> <!-- classe para criar uma linha -->
            
            <?php
            // inserindo o arquivo de conexao do banco
            include "conexao.php";

            // recebendo os dados vindo do form e armazenando nas variaveis abaixo com seus respectivos campos.
            $nome = $_POST['nome'];
            $endereco = $_POST['endereco'];
            $telefone = $_POST['telefone'];
            $email = $_POST['email'];
            $nascimento = $_POST['nascimento'];
            
            /* $foto = $_FILES['foto'];
            $nomeFoto = moverFoto($foto); // esta variavel recebe o retorno da função que criará o nome da foto upada. */


            // instrução sql que permite a inserção dos dados no banco de dados. a instrução esta sendo armazenada na variavel $sql
            $sql = "INSERT INTO pessoas (nome, endereco, telefone, email, nascimento) VALUES ('$nome', '$endereco', '$telefone', '$email', '$nascimento')";

            // mysqli_query é uma função que vai enviar os dados para dentro do banco de dados.
            if (mysqli_query($conn, $sql)){ // o primeiro parametro passado nesta função é responsavel pela conexão com a base de dados. o segundo, é a instrução sql que você deseja realizar.
                //echo "<img src ='img/$nomeFoto' title='$nomeFoto'>";
                mensagem("$nome foi cadastrado(a) com sucesso!", 'success'); // mensagem é uma função que foi criada no arquivo conexao.
            } else
            mensagem("$nome NÃO cadastrado!", 'danger'); // como foi definido na criação da função, o primeiro parametro é o texto que sera exibido para o usuario, e logo em seguida o tipo do texto.
        
            ?>
            <!-- criação do botão para voltar a pagina principal -->
            <a href="index.php" class="btn btn-primary">Voltar</a>
        </div>
    </div>



    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>