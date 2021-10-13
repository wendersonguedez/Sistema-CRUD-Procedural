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
        <div class="row">
            <!-- classe para criar uma linha -->
            <div class="col">
                <!-- classe para criar uma coluna -->
                <h1>Cadastro</h1>
                <form action="script-cadastro.php" method="POST" enctype="multipart/form-data">
                    <!-- atributo action fica responsavel por enviar os dados do form para o arquivo especifico, neste caso o script-cadastro.php. o atributo enctype é utilizado quando o formulário incluir qualquer input do tipo file, que permite o envio de arquivos de foto -->
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome completo</label>
                        <input type="text" name="nome" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="endereco" class="form-label">Endereço</label>
                        <input type="text" name="endereco" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="telefone" class="form-label">Telefone</label>
                        <input type="text" name="telefone" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">E-mail</label>
                        <input type="email" name="email" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="nascimento" class="form-label">Data de Nascimento</label>
                        <input type="date" name="nascimento" class="form-control">
                    </div>
                    <div class="form-group mb-3">
                        <input type="submit" class="btn btn-success">
                        <input type="reset" class="btn btn-success">
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