<?php

printFileName(__FILE__);

class pdfController extends Controller
{

    private $_pdf;

    public function __construct()
    {
        parent::__construct();
        $this->getLibrary('fpdf');
        $this->_pdf = new FPDF();
    }

    public function index()
    {
        
    }

    public function pdf1()
    {
        $this->_pdf->AddPage();
        $this->_pdf->SetFont('Arial', 'B', 16);
        $this->_pdf->Cell(40, 10, utf8_decode('¡Hola, Mundo!'));
        $this->_pdf->Output();
    }

    public function pdf2()
    {
        $template = ROOT . 'public' . DS . 'files' . DS . 'pdf2.php';
        
        if (is_readable($template)) {
            require_once $template;
        }
        else {
            throw new Exception('Error de template');
        }
    }

}
