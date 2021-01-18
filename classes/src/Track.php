<?php

namespace Classes;

use \Classes\Utils\myPDF;

/* https://m.correios.com.br/enviar-e-receber/precisa-de-ajuda/manual_rastreamentoobjetosws.pdf

Para buscar o status do objeto , basta enviar uma requisição
para o arquivo " rastreio.php " dentro de " api " .
O arquivo " rastreio.php " buscara o status do objeto no próprio site dos correios
*/
class Track
{

    public function trackObject($obj)
    { 
        $rastreio = $this->getJSON($obj);
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

        require_once __DIR__ . './generateHTML.php';
        return generateHTML($rastreio, $obj);

    }

    public function getJSON($obj)
    {
        $url = "http://localhost/api/rastreio.php?obj={$obj}";
        return file_get_contents($url);
    }

    public function sendMail($toAdress, $html)
    {
        $mail = new Mail();

        //valida os campos
        $error = $mail->verifyEmail($toAdress); //verifica o campo email
        $aux = json_decode($error);
    
        if ($aux->error) {
            return $error;
        }  
    
        $subject = 'Rastreio de Objeto';
        $toName = 'Test';
    
        //se estiver tudo ok, então envia o e-mail
        return $mail->sendMail($toAdress, $toName, $subject, $html);
    }

    public function getPDF($obj, $html)
    {
        $pdf = new myPDF();

        $file_name = $obj;
        $content = file_get_contents('http://localhost/views/header.html');
        $content .= file_get_contents('http://localhost/views/headerResult.html');
       
        $html = $content . $html;
        echo $html;
        /*$pdf->createPDF($file_name, $html);
        $pdf->display();*/


    }
}
?>