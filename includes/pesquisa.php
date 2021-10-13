<!doctype html>
<html lang="pt-br">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Pesquisa</title>
  <!-- Bootstrap CSS Online -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
</head>

<body class="bg-dark text-light">
  <!-- SCRIPT PARA EFETUAR A PESQUISA DENTRO DO BANCO DE DADOS E RETORNAR ALGO PARA O USUARIO -->
  <?php
  /*
    if (isset($_POST['busca'])) { // isset verifica se a variavel POST existe. caso exista, ira executa o codigo abaixo. a variavel global $_POST esta acessando as informações do formulario, atraves do campo 'busca'
      $pesquisa = $_POST['busca']; // $pesquisa esta recebendo a palavra que esta sendo procurada atraves da variavel global $_POST 
    } else {
      $pesquisa = ''; // caso nao seja efetuada nenhuma busca, a variavel $pesquisa ficara em branco.
    } */

  // codigo acima simplicificado em uma linha.
  $pesquisa = $_POST['busca'] ?? ''; // se a variavel POST existir, o valor encontrado sera armazenado na variavel pesquisa. senao existir, é atribuido vazio para a variavel pesquisa e vai retornar todos os nomes cadastrados.

  // chamando a conexao com o banco de dados
  include "conexao.php";

  // variavel $sql esta recebendo uma instrução do sql que ira selecionar todos os dados da tabela pessoas.
  $sql = "SELECT * FROM pessoas WHERE nome LIKE '%$pesquisa%'"; // o operador like retorna todos os produtos(nome) que tenham um caractere antes ou depois. ou seja, basta ter um trecho da palavra

  // comando para receber os dados que estao armazenados na base de dados deste sistema.
  $dados = mysqli_query($conn, $sql); // no arquivo de cadastro, os dados estao sendo enviados para o banco atraves da funcao mysqli_query. neste caso, a variavel $dados esta recebendo os dados que foram enviados para o banco.

  ?>
  <div class="container">
    <div class="row">
      <!-- classe para criar uma linha -->
      <div class="col">
        <!-- classe para criar uma coluna -->
        <h1>Pesquisar</h1>
        <nav class="navbar navbar-dark bg-dark mb-3">
          <div class="container-fluid">
            <form class="d-flex" action="pesquisa.php" method="POST">
              <!-- apos clicar no botao, os dados serao enviados para a mesma pagina -->
              <input class="form-control me-2" type="search" name="busca" placeholder="Nome" aria-label="Search" autofocus>
              <button class="btn btn-success" type="submit">Consultar</button>
            </form>
          </div>
        </nav>

        <table class="table table-striped table-dark">
          <!-- GERANDO O CABEÇALHO -->
          <thead>
            <!-- cada tr é uma linha da tabela -->
            <tr>
              <!-- cada th representa o titulo/cabeçalho da tabela -->
              <th scope="col">Nome</th>
              <th scope="col">Endereço</th>
              <th scope="col">Telefone</th>
              <th scope="col">Email</th>
              <th scope="col">Data de Nascimento</th>
              <th scope="col">Funções</th>
            </tr>
          </thead>
          <tbody>

            <?php
            // LAÇO PARA PERCORRER NO VETOR E ARMAZENAR CADA LINHA PERCORRIDA À SUA DETERMINADA VARIAVEL. $nome vai armazenar o nome que foi inserido no formulario.
            while ($linha = mysqli_fetch_assoc($dados)) { // mysqli_fetch_assoc é uma função que percorrer todo o vetor resultante. o resultado desta função é armazenada na variavel $linha.
              $id = $linha['id'];
              $nome = $linha['nome'];
              $endereco = $linha['endereco'];
              $telefone = $linha['telefone'];
              $email = $linha['email'];
              $nascimento = $linha['nascimento'];
              $nascimento = data_br($nascimento); // vai sobrescrever a data recuperada do vetor $linha e vai retornar a data no formato brasileiro (dd/mm/aaaa)

              // EXIBIR OS DADOS NA TABELA 
              echo "
                    <tr> 
                      <th scope='row'>$nome</th>
                      <td>$endereco</td>
                      <td>$telefone</td>
                      <td>$email</td>
                      <td>$nascimento</td>
                      <td> 
                        <a href='edicao-cadastro.php?id=$id' class='btn btn-success btn-sm'>Editar</a> 
                        <a href='#' class='btn btn-danger btn-sm' data-toggle='modal' data-target='#modal_excluir'
                        onclick=" . '"' . "pegarDados('$id', '$nome')" . '"' . ">Excluir</a>
                      </td>
                    </tr>"; // na linha 86 '?id=$cod_pessoa' esta criando a variavel id que esta armazenando o $cod_pessoa, que é o identificador do usuario. isso permite com que faça as alterações dos dados da pessoa selecionada.
              // o id da pessoa é passado na URL atraves da variavel $_GET
              // na linha 90, o evento js onclick esta recebendo varias concatenações de strings para que a função pegarDados funcione dentro do echo.
              // na linha 88 foi criado um espaço para os botões com funções de Editar e Excluir. 
            }
            ?>
          </tbody>
        </table>
        <a href="../index.php" class="btn btn-primary">Voltar para a tela inicial</a>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade text-dark" id="modal_excluir" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Confirmação de exclusão</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <!-- o conteudo da modal é necessario virar um formulario para que seja enviado e os dados sejam tratados via metodo POST -->
          <form action="script-excluir.php" method="POST">
            <p>Deseja realmente excluir <b id="nomePessoa">Nome da pessoa</b>?</p>
        </div>
        <div class="modal-footer">
          <input type="submit" class="btn btn-danger" value="Sim">
          <button type="button" class="btn btn-primary" data-dismiss="modal">Não</button>
          <input type="hidden" name="id" id="codPessoa" value=""> <!-- este input vai receber o valor do campo $cod_pessoa que foi cadastrado no banco para que seja feito a exclusao dele -->
          <input type="hidden" name="nome" id="nomePessoaExcluida" value=""> <!-- este input vai receber o valor do campo $nome que foi cadastrado no formulario para que seja feita a sua exclusao -->
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- Fim da Modal -->

  <!-- FUNÇÃO JS PARA PEGAR OS ELEMENTOS NOME E ID DA MODAL, PARA QUE SEJA FEITA A EXCLUSÃO DOS DADOS. ESSA FUNÇÃO ESTA SENDO CHAMADA NA TABELA DE EXIBIÇÃO DOS DADOS -->
  <script type="text/javascript">
    function pegarDados(id, nome) {
      document.getElementById('nomePessoa').innerHTML = nome; // innerHTML vai pegar oq esta entre a TAG que é localizada atraves do seu id. neste caso, nome_pessoa.
      document.getElementById('codPessoa').value = id; // .value vai esta pegando o valor do input com id = codPessoa.
      document.getElementById('nomePessoaExcluida').value = nome; // .value vai esta pegando o valor do input com id = nomePessoaExcluida.
    }
  </script>


  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>

</html>