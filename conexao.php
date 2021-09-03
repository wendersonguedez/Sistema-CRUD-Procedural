<?php
//parametros para fazer conexão com o banco de dados.
$server = "localhost"; // caso o servidor estivesse online, seria inserido o servidor ip. neste caso, usamos o localhost, devido o servidor ser local.
$user = "root"; // usuario do sistema SGBD
$passwrd = ""; // esta em branco, pois nao existe senha de acesso. caso exista, colocar entre as aspas
$bd = "crud"; // nome da base de dados do sistema

//mysqli_connect é uma função do php que abre uma nova conexão com o servidor MySQL. essa função recebe os parametros que possibilitam a conexão com a base de dados
if ($conn = mysqli_connect($server, $user, $passwrd, $bd)) { // essa função retorna verdadeiro ou falso. se a conexão for feita, retorna verdadeiro. senão, retorna falso
    // print "Conectado!";
} else
    print "Erro!";

/* $conn esta recebendo a conexão com banco e vai ser chamada na função mysqli_query para assim enviar os dados para a base de dados. */

// função para exibir uma mensagem caso o usuario tenha os dados cadastrados ou não. o parametro tipo retorna os tipos de mensagens do bootstrap. e $texto, retorna a mensagem que foi definida 
function mensagem($texto, $tipo){
    echo "<div class='alert alert-$tipo' role='alert'>
            $texto
          </div>";
}

function data_br($data){
    $d = explode('-', $data); // explode divide uma string principal em partes menores com base em um caractere divisor, que neste caso é '-' ou qualquer outro caractere ou string. explode retorna um vetor. 
    $escreve = $d[2] ."/" .$d[1] ."/" .$d[0]; // a variavel escreve inverte a posição do vetor $d. $d[2] representa o dia, $d[1] representa o mês e $d[0] representa o dia ano. 
    return $escreve;
}

// função que irá alterar o nome de uma foto para o ano, mes, dia, hora, min e seg que foi upada. apos isso, irá mover essa foto para a pasta que foi definada na função move_uploaded_file 
function moverFoto($vetorFoto){
    if(!$vetorFoto['error']){ // se o parametro $vetorFoto nao der erro, vai executar o codigo abaixo
        $nomeArquivo = date('Ymdhms') .".jpeg"; // a variavel $nomeArquivo recebe a função date que ira gerar o nome do arquivo atraves do ano, mes, dia, hora, min e segundo com uma extensão .jpg
        move_uploaded_file($vetorFoto['tmp_name'], "img/".$nomeArquivo); // esta função irá mover o arquivo de foto para uma nova localização. passando o seu nome com o indice da area temporaria do servidor como primeiro parametro. no segundo parametro, ficara o seu local de destino (neste caso a pasta img) 
        return $nomeArquivo; // retornando o nome do arquivo para poder jogar na base de dados do sistema
    } else {
        return 0;
    }
}
