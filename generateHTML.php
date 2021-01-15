<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <style>
        body {
            font-family: Arial;
            font-size: 14px;
        }

        h3 {
            color: rgb(40, 130, 200);
        }

        #rastreio {
            margin: auto;
            width: 600px;
        }

        #header {
            border-bottom: 1px dotted black;
        }

        .div-state{
            color: grey;
            display: flex;
            flex-direction: row;
            justify-content: start;
            border-bottom: 1px dotted black;
            margin: auto;
            line-height: 1.5;
            height: 70px;  
        }

        .div-state:hover {
            background-color: lightyellow;
        }

        .div-state .state-left {
            margin-top: -10px;
            width: 100px;
        }

        .div-state .state-right {
            margin-top: -10px;
            margin-left: 1rem;
            text-align: left;
            width: 500px;
        }
    </style>
</head>
<body>

<?php

function generateHTML($rastreio, $obj)
{
    //echo $rastreio;
    $objeto = json_decode($rastreio);
    //print_r($objeto);

    echo "<br>
    <div id='rastreio'>
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