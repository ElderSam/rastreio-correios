<?php

namespace Classes\Utils;

require __DIR__ . "./../../../vendor/autoload.php"; //vendor/autoload
use \Dompdf\Dompdf;

class myPDF
{
    private $dompdf;
    private $file_name;

    public function __construct()
    {
        //$this->dompdf = new Dompdf();
        $this->dompdf = new Dompdf(["enable_remote" => true]);
    }

    public function createPDF($file_name, $content)
    {
        $this->file_name = $file_name . ".php";

        $this->dompdf->loadHtml($content);
        $this->dompdf->render();
        $canvas = $this->dompdf->getCanvas();  
        $canvas->page_text(550, 755, "Pág. {PAGE_NUM}/{PAGE_COUNT}", 'Verdana', 10, array(0,0,0)); //footer
    }

    public function display()
    {
        $this->dompdf->stream($this->file_name, ["Attachment" => false]);
    }

    public function download()
    {
        $this->dompdf->stream($this->file_name);
    }

}
/*
$pdf = new myPDF();

$file_name = "example";
$content = "<h1>Hello World!</h1><p>It's an example!</p>";

$pdf->createPDF($file_name, $content);
$pdf->display();*/