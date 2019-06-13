<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//include_once APPPATH."/libraries/pdf_js.php";

class Reporte extends CI_Controller {

    //$this->load->helper('url_helper');  

    function AutoPrint($dialog = false) {
        //Open the print dialog or start printing immediately on the standard printer
        $param = ($dialog ? 'true' : 'false');
        $script = "print($param);";
        $this->IncludeJS($script);
    }

    function AutoPrintToPrinter($server, $printer, $dialog = false) 
                {
        //Print on a shared printer (requires at least Acrobat 6)
        $script = "var pp = getPrintParams();";
        if ($dialog)
            $script .= "pp.interactive = pp.constants.interactionLevel.full;";
        else
            $script .= "pp.interactive = pp.constants.interactionLevel.automatic;";
        $script .= "pp.printerName = '\\\\\\\\" . $server . "\\\\" . $printer . "';";
        $script .= "print(pp);";
        $this->IncludeJS($script);
    }

    function index($codigo)
    {

        $this->load->model('ventas_model');
        $this->load->library('pdf_js');

        date_default_timezone_set('America/Bogota');
        $hour = date('H:i:s');
        $date = date('d/m/Y');
        $costo = 0;
        $cliente = ''; 
            
        $this->pdf = new Pdf_js();
        $this->pdf->AddPage();
        $this->pdf->SetMargins(2, 0, 0);
        $this->pdf->SetFont('Arial', '', 8);

        $this->pdf->Image(base_url('assets/images/logo.png'),30,3,15);
        $this->pdf->Ln(1);
        $this->pdf->cell('19');
        $this->pdf->cell('15', '8', "LONDON Tienda de Ropa");
        $this->pdf->Ln(1);
        $this->pdf->cell('20');
        $this->pdf->cell('5', '15', "FACTURA DE VENTA");
        $this->pdf->Ln(1);
        $this->pdf->cell('18');
        $this->pdf->cell('5', '20', "REGIMEN SIMPLIFICADO");
        $this->pdf->Ln(1);
        $this->pdf->cell('20');
        $this->pdf->cell('15', '25', "Cra 15 # 16 - 46 Local 3");
        $this->pdf->Ln(1);
        $this->pdf->cell('24');
        $this->pdf->cell('15', '30', "Tel. 3124708667");
        $this->pdf->Ln(1);
        $this->pdf->cell('18');
        $this->pdf->cell('15', '35', "REG: " . $date . "  " . $hour);
            // total 55
        
        $this->pdf->Ln(3);
        $this->pdf->cell('26');
        $this->pdf->cell('15', '40', "FACTURA: $codigo ");
        
        $this->pdf->Ln(1);
        $baseY = 45;
        $increY = 5;
        
        $ventas = array($this->ventas_model->get_ventas($codigo));
        $detalles = $this->ventas_model->get_detalles_venta($codigo);
//        echo "<pre>";var_dump($detalles);echo "</pre>";exit;
        
        foreach ($ventas as $venta): 
            $cliente = utf8_decode(substr(($venta['nombres'].' '.$venta['apellidos']), 0, 22));
            $cedula = $venta['cedula'];
            $costo = $venta['costo_total']; 
            if ($cedula != ''){
                $this->pdf->cell('10', $baseY, "Cliente:");
                $this->pdf->cell('22', $baseY, $cliente); 
            }   
            
            $baseY +=$increY;
        endforeach;
        
        $this->pdf->Ln(5);
        $this->pdf->cell(0.1);

        $this->pdf->cell('7', $baseY-6, "--------------------------------------------------------------------------");
        $this->pdf->Ln(1);
        $this->pdf->cell('7', $baseY-6, "--------------------------------------------------------------------------");
        $this->pdf->Ln(1);
        $this->pdf->cell('10', $baseY, "CANT");
        $this->pdf->cell('28', $baseY, "DESCRIPCION");
        $this->pdf->cell('13', $baseY, str_pad("Vlr UND",13," ",STR_PAD_LEFT));
        $this->pdf->cell('13', $baseY, str_pad("Vlr NETO",13," ",STR_PAD_LEFT));
        $this->pdf->Ln(1);
        $this->pdf->cell('13', $baseY+4, "--------------------------------------------------------------------------");
        $this->pdf->Ln(1);
        $this->pdf->cell('13', $baseY+4, "--------------------------------------------------------------------------");
        $this->pdf->Ln(3);

            $baseY +=$increY;

        foreach ($detalles as $detalle):
            $this->pdf->cell('10', $baseY, number_format($detalle['cantidad']));
            $this->pdf->cell('28', $baseY, utf8_decode(substr(($detalle['descripcion']), 0, 22)) . ".");
            $numero1 = str_pad(number_format($detalle['costo_unidad']), 13, " ", STR_PAD_LEFT);
            $this->pdf->cell('13', $baseY, $numero1);
            $numero2 = str_pad(number_format(($detalle['costo_total'])), 13, " ", STR_PAD_LEFT);
            $this->pdf->cell('13', $baseY, $numero2);
            $this->pdf->Ln(1);

            $baseY +=$increY;

        endforeach; 

        $total_general = $costo;
        // ---------------
        $this->pdf->Ln(1);
        $this->pdf->cell('1', $baseY+2, "--------------------------------------------------------------------------");
        $this->pdf->Ln(1);
        //totales
        $baseY += 10;

        $this->pdf->cell('51', $baseY, "SUB TOTAL");

        $base = str_pad(number_format($costo), 13, " ", STR_PAD_LEFT);

        $this->pdf->cell('15', $baseY, $base);

        $this->pdf->Ln(1);

        $baseY += $increY;

        $this->pdf->cell('51', $baseY, "IVA");
        $iva = str_pad(0, 13, " ", STR_PAD_LEFT);
        $this->pdf->cell('15', $baseY, $iva);

        //------------------------------------
        $this->pdf->Ln(1);

        $baseY += $increY;

        $this->pdf->cell('51', $baseY, "IPCONSUMO");
        $iva = str_pad(0, 13, " ", STR_PAD_LEFT);
        $this->pdf->cell('15', $baseY, $iva);
        //--------------------------------------

        $this->pdf->Ln(1);

        $baseY += $increY;

        $this->pdf->Ln(1);
        $this->pdf->cell('1', $baseY+2, "--------------------------------------------------------------------------");
        $this->pdf->Ln(5);

        $this->pdf->cell('48', $baseY, "TOTAL");

            $costo = str_pad(number_format($costo), 16, " ", STR_PAD_LEFT);


        $this->pdf->cell('15', $baseY, $costo);
        $this->pdf->Ln(3);
        $this->pdf->cell('1', $baseY+2, "--------------------------------------------------------------------------");
        $this->pdf->Ln(2);

        $baseY += $increY;

        $this->pdf->cell('48', $baseY, "TOTAL GENERAL");
        $costo = str_pad(number_format($total_general), 16, " ", STR_PAD_LEFT);
        $this->pdf->cell('15', $baseY, $costo);
        $this->pdf->Ln(1);

        $baseY +=5;
        $this->pdf->Ln(8);
        $this->pdf->cell('8');
        $this->pdf->cell('15', $baseY, "****** GRACIAS POR SU COMPRA ******");

        //$this->pdf->Open();
        $this->pdf->AliasNbPages(); 

        //$this->AutoPrint(true);
        $this->pdf->Output();
    }
}
?>