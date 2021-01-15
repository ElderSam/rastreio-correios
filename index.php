<?php
/* https://m.correios.com.br/enviar-e-receber/precisa-de-ajuda/manual_rastreamentoobjetosws.pdf

    Para buscar o status do objeto , basta enviar uma requisição
    para o arquivo " rastreio.php " dentro de " api " .
    O arquivo " rastreio.php " buscara o status do objeto no próprio site dos correios
*/


$obj = 'OA016913717BR'; //"CODIGO DE RASTREIO"
$url = "http://localhost/api/rastreio.php?obj={$obj}";
$rastreio = file_get_contents($url);

/*$rastreio = json_encode([
    ['date'=> '12/12/2020',
        'hour'=> '02:22',
        'location'=> 'Macapa/AP',
        'action'=> 'sdga ',
        'message'=> 'sdga'
    ],
    [
        'date'=> '13/01/2021',
        'hour'=> '23:12',
        'location'=> 'Sao Paulo/SP',
        'action'=> 'KLA JGO4 GKL4Ç H',
        'message'=> 'LASJG RJÇ KRJÇ HOI OEJ EOTHJAEOIT'
    ]
]);*/
//echo $rastreio; // imprime o JSON da resposta do rastreio

require_once('./generateHTML.php');
generateHTML($rastreio, $obj);