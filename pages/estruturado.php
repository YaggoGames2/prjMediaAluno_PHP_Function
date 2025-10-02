<?php
function validarEntradas($paramNome, $paramNotas)
{
    if (isset($paramNome) && count($paramNotas) == 0 ||(!preg_match('/^[a-zA-Z\s]+$/', $paramNome)) && (!is_numeric($paramNotas))) {
        return false;
    } else {
        return true;
        // volta para a página de calculo - redirecionamento
    }
    //não pode estar em branco - ok
    //não pode ter número no nome -nok
    //itens do array devem ser números - nok
    //array não pode ser vazio -ok
}

function darBoasVindas($hora){
    date_default_timezone_set('America/Sao_Paulo');
    $hora = new DateTime();
    return $hora->format('H:i:s');
}


function calcularMedia($arrayNotas)
{
    $resultado = array_sum($arrayNotas) / count($arrayNotas);
    return $resultado;
}
 
function verificarAprovacao($umaMedia)
{
    return $umaMedia >= 7 ? true : false;
    // if ($umaMedia>=7) {
    //     return true;
    // } else {
    //     return false;
    // }    
}
 
function mostrarMensagem($mensagem)
{
    echo $mensagem;
}
 
function mostrarResultadoFinal($resultado)
{
    if ($resultado == true) {
        mostrarMensagem("Parabéns, você foi aprovado!");
    } else {
        mostrarMensagem("Infelizmente, você foi reprovado.");
    }
}
 
 
$nome = trim($_GET['nome']);
$notas = $_GET['notas'];
if (validarEntradas($nome, $notas) == true) {
    $media = calcularMedia($notas);
    $resultado = verificarAprovacao($media);
} else {
    header("Location: ../index.html");
}
 
 
// echo "Feito com valores de entrada";
// $media = calcularMedia($notas);
// $resultado = verificarAprovacao($media);
// var_dump($media);
// var_dump($resultado);
 
// echo "Feito com valores fixos";
// $media = calcularMedia([10,10,10,10,10,10,10]);
// $resultado = verificarAprovacao(7);
// var_dump($media);
// var_dump($resultado);
 
// $mensagemBoasVindas = "Olá, {$nome}! Sua média é: {$media}";
// if ($media >= 7) {
//     $mensagemResultado = "Parabéns, você foi aprovado!";
// } else {
//     $mensagemResultado =  "Infelizmente, você foi reprovado.";
// }
 
// $mensagemResultado = $media>=7 ? "Parabéns, você foi aprovado!" :
// "Infelizmente, você foi reprovado.";
?>
 
<!DOCTYPE html>
<html lang="pt-BR">
 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Performance do Aluno</title>
    <link rel="stylesheet" href="./../css/style.css">
</head>
 
<body>
    <main class="container">
        <h1>Performance do Aluno</h1>
        <?=  mostrarMensagem(darBoasVindas($hora));?>
        <p><?= mostrarMensagem("Olá, {$nome}! Sua média é: " . number_format($media, 2, ',', '.')); ?></p>
        <p id="<?= $resultado == true ? "aprovado" : "reprovado"; ?>"><?= mostrarResultadoFinal($resultado) ?></p>
    </main>
</body>
 
</html>
 