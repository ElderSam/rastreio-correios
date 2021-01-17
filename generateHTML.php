<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rastreio de Objetos</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
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

        #options {
            display: flex;
            justify-content: space-evenly;
            color: rgb(220, 0, 0);
        }

        #options i {
            cursor: pointer;
        }

        #options i:hover {
            
            color: red;
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
            width: 100px;
        }

        .div-state .state-right {
            margin-left: 1rem;
            text-align: left;
            width: 500px;
        }
    </style>
</head>
<body>
    <a href='/' class='btn btn-danger'><- voltar</a>
<?php

function generateHTML($rastreio, $obj)
{
    //echo $rastreio;
    $objeto = json_decode($rastreio);
    //print_r($objeto);

    echo "<br>

    <div id='rastreio'>
        <div id='options'>
            <i onClick='mostraModal()' class='far fa-envelope fa-3x'></i>
            <i class='fas fa-file-download fa-3x'></i>
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


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    
function mostraModal() {
    Swal.fire({
    title: 'Digite o e-mail do destinatário',
    input: 'text',
    inputAttributes: {
        autocapitalize: 'off'
    },
    showCancelButton: true,
    confirmButtonText: 'Enviar',
    cancelButtonText: 'Cancelar',
    showLoaderOnConfirm: true,
    preConfirm: (login) => {
        /*return fetch(`//api.github.com/users/${login}`)
        .then(response => {
            if (!response.ok) {
            throw new Error(response.statusText)
            }
            return response.json()
        })
        .catch(error => {
            Swal.showValidationMessage(
            `Request failed: ${error}`
            )
        })*/
    },
    allowOutsideClick: () => !Swal.isLoading()
    }).then((result) => {
    if (result.isConfirmed) {
        /*Swal.fire({
        title: `${result.value.login}'s avatar`,
        imageUrl: result.value.avatar_url
        })*/
    }
    })
}
</script>