<?php

namespace Classes;

function generateHTML($rastreio, $obj)
{
    $html = "<a href='/' class='btn btn-danger'><- voltar</a>";
    
    $res = json_decode($rastreio);

    if(isset($res->erro) && $res->erro)
    {
        $html .= "ERRO: $res->msg!";
    }else{
        //echo $rastreio;
        $objeto = json_decode($rastreio);
        //print_r($objeto);

        $html .= "<br>
        <div id='rastreio'>
            <div id='options'>
                <a href='/email?object=$obj'>
                    <i class='far fa-envelope fa-3x'></i>
                </a>

                <a href='/pdf/view/$obj'>
                    <i class='fas fa-file-download fa-3x'></i>
                </a>
            </div>
            <div id='header'>
            
                <h3>
                    <i class='fas fa-info-circle fa-lg'></i>
                    Encomenda entregue!
                </h3>
                <p>Você pode acompanhar o envio com o código de rastreamento <a href='#'>{$obj}</a> </p>
            </div>"
            . getStates($objeto) .
            "<Br><p>Falta pouco</p>
        <strong>Elder S. Silva</strong>
        </div>";

        $scriptJS = file_get_contents('http://'. $_SERVER['HTTP_HOST'] .'/res/js/script.js');

    $html .= "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@10'></script>
        <script>
            $scriptJS
        </script>";

        return $html;
    }

}

function getStates($states)
{
    $text = "";

    foreach($states as $state) {
        //print_r($state);
        $textMessage = "";
        if(($state->action . " ") != $state->message) {
            $textMessage = $state->message;
        }

        $text .= "<div class='div-state'>
            <div class='state-left'>
                <p> {$state->date} </br>
                {$state->hour} </br>
                {$state->location} </p>
            </div>
            <div class='state-right'>
                <p>
                    <strong> {$state->action} </strong><br>
                    {$textMessage}
                </p>
            </div>
        </div>";
    }

    return $text;
}

?>