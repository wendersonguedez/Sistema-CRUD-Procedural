<!doctype html>
<html lang="pt-br">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Alteração dos dados</title>
    <!-- Bootstrap CSS Online -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
</head>

<body class="bg-dark text-light">

    <?php
    include "conexao.php";

    // verificando se a variavel id existe. caso nao exista, recebe valor em branco.
    $id = $_GET['id'] ?? '';
    // criando uma query que faz uma consulta dentro do banco de dados que o cod_pessoa seja igual a variavel $id.
    $sql = "SELECT * FROM pessoas WHERE id = $id";

    $dados = mysqli_query($conn, $sql);
    $linha = mysqli_fetch_assoc($dados); // variavel $linha vai receber o retorno dos dados que foram encontrados dentro do vetor $dados. esses dados vão ser os nomes, endereços, telefones...


    ?>
    <div class="container">
        <div class="row">
            <!-- classe para criar uma linha -->
            <div class="col">
                <!-- classe para criar uma coluna -->
                <h1>Cadastro</h1>
                <form action="script-edit.php" method="POST">
                    <!-- atributo action fica responsavel por enviar os dados do form para o arquivo especifico, neste caso o script-cadastro.php -->
                    <div class="mb-2">
                        <label for="nome" class="form-label">Nome completo</label>
                        <input type="text" name="nome" class="form-control" required value="<?php echo $linha['nome']; ?>"> <!-- value esta trazendo o nome do usuario que corresponde ao cod_pessoa(que esta armazenado a varaivel id) cadastrado no banco. -->
                    </div>
                    <div class="mb-2">
                        <label for="endereco" class="form-label">Endereço</label>
                        <input type="text" name="endereco" class="form-control" value="<?php echo $linha['endereco']; ?>">
                    </div>
                    <div class="mb-2">
                        <label for="telefone" class="form-label">Telefone</label>
                        <input type="text" name="telefone" class="form-control" value="<?php echo $linha['telefone']; ?>">
                    </div>
                    <div class="mb-2">
                        <label for="email" class="form-label">E-mail</label>
                        <input type="email" name="email" class="form-control" value="<?php echo $linha['email']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="nascimento" class="form-label">Data de Nascimento</label>
                        <input type="date" name="nascimento" class="form-control" value="<?php echo $linha['nascimento']; ?>">
                    </div>
                    <div class="form-group mb-3">
                        <input type="submit" class="btn btn-success" value="Salvar Alterações">
                        <input type="hidden" name="id" value="<?php echo $linha['id']; ?>"> <!-- mandando o id da pessoa de forma escondida, ja que ao passar pelo metodo GET, o id da pessoa fica exposto na URL -->
                    </div>
                </form>
                <a href="index.php" class="btn btn-primary">Voltar para a tela inicial</a>
            </div>
        </div>
    </div>



    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>