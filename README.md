# App Rastreio de Objetos (Correios)

Para rodar o projeto você precisa instalar as dependências;
    composer install

Enviando E-mails com PHPMailer;
    para manda e-mails através do Gmail é necessário alterar os valores das constantes USERNAME e PASSWORD (em classes/src/Utils/Mailer.php) e em também permitir apps menos seguros: https://myaccount.google.com/lesssecureapps

---------------------------------------------------------

OBS: Tive vários problemas nesse projeto como;]
 1. o e-mail enviado não fica formatado com os estilos css e fica sem ícones.
 2. o PDF gerado ou dá erro ou não gera o conteúdo desejado.