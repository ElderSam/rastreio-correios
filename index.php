<?php
/* https://m.correios.com.br/enviar-e-receber/precisa-de-ajuda/manual_rastreamentoobjetosws.pdf

    Para buscar o status do objeto , basta enviar uma requisição
    para o arquivo " rastreio.php " dentro de " api " .
    O arquivo " rastreio.php " buscara o status do objeto no próprio site dos correios
*/

$obj = 'OA016913717BR'; //"CODIGO DE RASTREIO"
$url = "http://localhost/api/rastreio.php?obj={$obj}";
$rastreio = file_get_contents($url);

echo $rastreio;