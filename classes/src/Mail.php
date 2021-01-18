<?php

namespace Classes;

use Exception;

require __DIR__ . "/../../vendor/autoload.php";

class Mail
{
    public function __construct() {}

    public function verifyEmail($email)
    {
        $errors = [];

        if($email != "" && $this->validaEmail($email) == false){ //se o e-mail estiver correto
            $errors["#email"] = "E-mail Incorreto!";
        }

        if (count($errors) > 0)
        { //se tiver algum erro de input (campo) do formulário

            return json_encode([
                'error' => true,
                'error_list' => $errors
            ]);
        }
        else { //se ainda não tem erro

            return json_encode([
                'error' => false
            ]);

        }
    }

    public function validaEmail($email)
    {
        //verifica se e-mail esta no formato correto de escrita
        if (!preg_match('/^([a-zA-Z0-9.-_])*([@])([a-z0-9]).([a-z]{2,3})/', $email)) {
            return false;
        } else {

            try{
                $dominio = explode('@', $email);
                return true; // Retorno true para indicar que o e-mail é valido
            }catch(Exception $e) {
                return false;
            }
            
            
        }
    }

    public function sendMail($toAdress, $toName, $subject, $html)
    {
        require_once __DIR__ . "/Utils/Mailer.php";

        $mail = new Mailer($toAdress, $toName, $subject, $html);

        if ($mail->send()) { //envia o email, e verifica se retornou sucesso
            $error = false;
            $message = "Email enviado!";
            
        } else {
            $error = true;
            $txtError = $mail->getErrorInfo();
            $message = "Ops, algo deu errado<br>
                    <strong style='color: red;'> $txtError :(</strong><br>
                    Talvez algum email ou senha estão incorretos!<br>
                    <b>OBS:</b> para permitir enviar e-mail através do Gmail, você deve habilitar habilitar essa opção nesse <a href='https://myaccount.google.com/lesssecureapps' target='_blank'>link</a>!";
        }

        return json_encode([
            'error'=>$error,
            'msg'=>$message
        ]);

    }
}