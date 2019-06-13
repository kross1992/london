<?php
//require('pdf_js.php');
$this->load->library('pdf_js');
$this->load->model('ventas_model');

class ex extends Pdf_js {

    
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

}
getPrueba($this->input->post('codigo_venta'));

function getPrueba($codigo){


//require ('../../models/Ventas_model.php');
//$funcion = new Ventas_model();
   
date_default_timezone_set('America/Bogota');
$hour = date('H:i:s');
$date = date('d/m/Y');
$costo = 0;
$cliente = ''; 
    
$this->pdf= new ex();
$this->pdf->AddPage();
$this->pdf->SetMargins(2, 0, 0);
$this->pdf->SetFont('Arial', '', 8);


        $this->pdf->Ln(1);
        $this->pdf->Image(base_url('assets/images/logo.png'),10,10,-300);
        $this->pdf->cell('19');
        $this->pdf->cell('15', '5', "LONDON Tienda de Ropa");
        $this->pdf->Ln(1);
        $this->pdf->cell('20');
        $this->pdf->cell('5', '10', "FACTURA DE VENTA");
        $this->pdf->Ln(1);
        $this->pdf->cell('24');
        $this->pdf->cell('5', '15', "REGIMEN SIMPLIFICADO");
        $this->pdf->Ln(1);
        $this->pdf->cell('15');
        $this->pdf->cell('15', '20', "Cra 15 # 16 - 46 Local 3");
        $this->pdf->Ln(1);
        $this->pdf->cell('13');
        $this->pdf->cell('15', '25', "Tel. 3124708667");
        $this->pdf->Ln(1);
        $this->pdf->cell('18');
        $this->pdf->cell('15', '30', "REG: " . $date . "  " . $hour);
            // total 55
            $this->pdf->Ln(3);
            $baseY = 35;
            $increY = 5;
            
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

//                $resultado1 = $funcion1->registrar_venta($id_preventa, $costo, $costo_neto, $iva, $propina, $tipo_pago);
            /*$resultado = $funcion->get_ventas($codigo);
            $resultado->setFetchMode(PDO::FETCH_CLASS, 'Ventas_model');*/

            $ventas = $this->ventas_model->get_ventas($codigo);
            $detalles = $this->ventas_model->get_detalles_venta($codigo);

            foreach ($ventas as $venta) {
                $cliente = $venta['nombres'].' '.$venta['apellidos'];
                $cedula = $venta['cedula'];
                $costo = $venta['costo_total'];
            }

            /*
            $resultado = $funcion->get_detalles_venta($codigo);
            $resultado->setFetchMode(PDO::FETCH_CLASS, 'Ventas_model');*/

            foreach ($detalles as $detalle) {
                $this->pdf->cell('10', $baseY, number_format($detalle['cantidad']));
                //$this->pdf->cell('28', $baseY, utf8_decode(substr(($fila->desc_producto), 0, 22)) . ".");
                $numero1 = str_pad(number_format($detalle['costo_unidad']), 13, " ", STR_PAD_LEFT);
                $this->pdf->cell('13', $baseY, $numero1);
                $numero2 = str_pad(number_format(($detalle['costo_total'])), 13, " ", STR_PAD_LEFT);
                $this->pdf->cell('13', $baseY, $numero2);
                $this->pdf->Ln(1);

                $baseY +=$increY;

                $costo_iva += ($fila->costo_total)* 0.08;
            }
           /* while ($fila = $resultado->fetch()) {
                
                $this->pdf->cell('10', $baseY, number_format($fila->cantidad));
                //$this->pdf->cell('28', $baseY, utf8_decode(substr(($fila->desc_producto), 0, 22)) . ".");
                $numero1 = str_pad(number_format($fila->costo_unidad), 13, " ", STR_PAD_LEFT);
                $this->pdf->cell('13', $baseY, $numero1);
                $numero2 = str_pad(number_format(($fila->costo_total)), 13, " ", STR_PAD_LEFT);
                $this->pdf->cell('13', $baseY, $numero2);
                $this->pdf->Ln(1);

                $baseY +=$increY;

                $costo_iva += ($fila->costo_total)* 0.08;
            }*/
            
            
            /*if($desc != 0){
                $propina = ($costo -($desc * $costo)) * 0.10;
                $total_general = $costo -($desc * $costo)+$propina;
            }else{
                $propina = $costo * 0.10;
                $total_general = $costo+$propina;
            }*/
            
            $total_general = $costo;
            // ---------------
            $this->pdf->Ln(1);
            $this->pdf->cell('1', $baseY+2, "--------------------------------------------------------------------------");
            $this->pdf->Ln(1);
            //totales
            $baseY += 10;

//            $this->pdf->cell(1);
            $this->pdf->cell('51', $baseY, "SUB TOTAL");
            
            $base = str_pad(number_format($costo), 13, " ", STR_PAD_LEFT);
            
            
            $this->pdf->cell('15', $baseY, $base);
            
            //-----------------DESC
            /*if($desc != 0){
            $this->pdf->Ln(1);
            $baseY += $increY;
            $this->pdf->cell('51', $baseY, "DESCUENTO");
//            $this->pdf->cell('51', $baseY, "IPCONSUMO");
            $iva = str_pad(number_format(($costo * $desc)), 13, " ", STR_PAD_LEFT);
            $this->pdf->cell('15', $baseY, $iva);
            }*/
            //-----------------
            
            $this->pdf->Ln(1);

            $baseY += $increY;

//            $this->pdf->Ln(1);
//            $this->pdf->cell('51', $baseY, "IVA");
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
//            $this->pdf->cell(1);
            $this->pdf->cell('48', $baseY, "TOTAL");
            /*if($desc != 0){
                
                $costo = str_pad(number_format($costo - ($costo * $desc)), 16, " ", STR_PAD_LEFT);
            }else{*/
                $costo = str_pad(number_format($costo), 16, " ", STR_PAD_LEFT);
            //}
           
            $this->pdf->cell('15', $baseY, $costo);
            $this->pdf->Ln(3);
            $this->pdf->cell('1', $baseY+2, "--------------------------------------------------------------------------");
            $this->pdf->Ln(2);

            $baseY += $increY;

         
            //$this->pdf->cell('54', $baseY, "PROPINA VOLUNTARIA SUGERIDA");
            
            $propina = str_pad(number_format($propina), 10, " ", STR_PAD_LEFT);
            $this->pdf->cell('15', $baseY, $propina);
            $this->pdf->Ln(4);
            $this->pdf->cell('48', $baseY, "TOTAL GENERAL");
            $costo = str_pad(number_format($total_general), 16, " ", STR_PAD_LEFT);
            $this->pdf->cell('15', $baseY, $costo);
            $this->pdf->Ln(1);
            
            $baseY +=20;
            /*$this->pdf->cell('2');
            $this->pdf->cell('20', $baseY, "RAZON SOCIAL: LUZ AIDA SERNA ALZATE");
            $this->pdf->Ln(3);
            $this->pdf->cell('2');
            $this->pdf->cell('20', $baseY, "NIT: 41895286-9");
            $this->pdf->Ln(3);
            $this->pdf->cell('2');
            $this->pdf->cell('20', $baseY, "HABILITACION RESOLUCION DIAN");
            $this->pdf->Ln(3);
            $this->pdf->cell('2');
            $this->pdf->cell('20', $baseY, "56524 DEL 2015/09/24 POS");
            $this->pdf->Ln(3);
            $this->pdf->cell('2');
            $this->pdf->cell('20', $baseY, "00001-10000. ESTA FACTURA SE ASIMILA EN");
            $this->pdf->Ln(3);
            $this->pdf->cell('2');
            $this->pdf->cell('20', $baseY, "TODOS SUS EFECTOS A UNA LETRA DE CAMBIO");
            $this->pdf->Ln(3);
            $this->pdf->cell('2');
            $this->pdf->cell('20', $baseY, "ART 774 DEL CODIGO DE COMERCIO.");
            $this->pdf->Ln(3);
            $this->pdf->cell('2');
            $this->pdf->cell('20', $baseY, "LA PROPINA ES SUGERIDA Y VOLUNTARIA,");
            $this->pdf->Ln(3);
            $this->pdf->cell('2');
            $this->pdf->cell('20', $baseY, "CORRESPONDE AL 10% SOBRE EL VALOR TOTAL");
            $this->pdf->Ln(3);
            $this->pdf->cell('2');
            $this->pdf->cell('20', $baseY, "DE LA CUENTA SIN IMPUESTO AL CONSUMO.");
            $this->pdf->Ln(3);
            $this->pdf->cell('2');
            $this->pdf->cell('20', $baseY, "ACEPTA  SI_ NO_ MONTO :____");*/
            
            $this->pdf->Ln(8);
            $this->pdf->cell('23');
            $this->pdf->cell('15', $baseY, "FACTURA: $id_preventa ");
            
            $this->pdf->Ln(8);
            $this->pdf->cell('8');
            $this->pdf->cell('15', $baseY, "****** GRACIAS POR SU COMPRA ******");
            
            
////Open the print dialog
$this->pdf->Open();
$this->pdf->AliasNbPages(); 

$this->pdf->AutoPrint(true);
$this->pdf->Output();

}
?>