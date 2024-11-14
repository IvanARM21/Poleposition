<?php  
require('fpdf186/fpdf.php'); 
include_once('db.class.php');  

class GenerarFactura {     
    private $db;      

    public function __construct() {         
        $this->db = new DB();     
    }      

    public function update($id) {         
        if (!$id) {             
            die("Error: Se requiere un ID de compra.");         
        }          
        $this->crearFactura($id);     
    }      

    private function crearFactura($compraId) {     
        $pdf = new FPDF();     
        $pdf->AddPage();      

        // carga el logo desde el archivo de logo   
        $pdf->Image('img/logo.png', 10, 10, 30);      

        //saca la fecha desde la bd
        $compra = $this->db->findOne("SELECT * FROM compra WHERE id = $compraId");     
        if (!$compra) {         
            die("Error: No se encontró la compra con ID $compraId.");     
        }     
        $comprafechaCompra = $compra->fechaCompra;      

        //genera un numero de factura aleatorio xd
        $numeroFactura = random_int(10000000, 99999999);      

        //saca los datos del cliente desde la bd (el error del !cliente no tendria ni que salir ya que cuando se borra un usuario se borra la compra tambien)
        $cliente = $this->db->findOne("SELECT * FROM cuentas WHERE id = {$compra->idCliente}");     
        if (!$cliente) {         
            die("Error: No se encontró el cliente con ID {$compra->idCliente}.");     
        }     
        $nombreCompleto = utf8_decode($compra->nombre . ' ' . $compra->apellido);      

        //saca la informacion del vehiculo
        $vehiculo = $this->db->findOne("SELECT * FROM vehiculo WHERE id = {$compra->idVehiculo}");     
        if (!$vehiculo) {         
            die("Error: No se encontró el vehículo con ID {$compra->idVehiculo}.");     
        }     
        $producto = utf8_decode($vehiculo->marca . ' ' . ($vehiculo->modelo ?? 'Producto Desconocido'));     
        $precioSinImpuesto = $vehiculo->precio ?? 0;     
        $precioConImpuesto = $precioSinImpuesto * 1.05; // 5% IVA      

        $pdf->SetFont('Arial', 'B', 12);     
        $pdf->SetXY(50, 10);     
        $pdf->SetXY(50, 20);     
        $pdf->SetXY(150, 10);     
        $pdf->SetFont('Arial', '', 10);     
        $pdf->Cell(50, 10, utf8_decode('Fecha: ' . $compra->fechaCompra), 0, 0, 'R');     
        $pdf->SetXY(150, 20);     
        $pdf->Cell(50, 10, utf8_decode('Número de Factura: ' . $numeroFactura), 0, 0, 'R');      

        $pdf->SetXY(10, 40);     
        $pdf->SetFont('Arial', 'B', 10);     
        $pdf->Cell(100, 10, $nombreCompleto, 0, 1);     
        $pdf->SetFont('Arial', '', 10);     
        $pdf->Cell(100, 5, utf8_decode($compra->direccion));     
        $pdf->Ln();     
        $pdf->Cell(100, 5, utf8_decode('CP: ' . $compra->codigo));     
        $pdf->Ln();     
        $pdf->Cell(100, 5, utf8_decode($compra->ciudad . ', ' . $compra->pais));      

        $pdf->SetXY(($pdf->GetPageWidth() - 140) / 2, 80);     
        $pdf->SetFont('Arial', 'B', 10);     
        $pdf->SetFillColor(220, 220, 220);     
        $pdf->Cell(60, 10, utf8_decode('PRODUCTO'), 1, 0, 'C', true);     
        $pdf->Cell(40, 10, utf8_decode('PRECIO'), 1, 0, 'C', true);     
        $pdf->Cell(40, 10, utf8_decode('TOTAL'), 1, 1, 'C', true);      

        $pdf->SetX(($pdf->GetPageWidth() - 140) / 2);     
        $pdf->SetFont('Arial', '', 10);     
        $pdf->Cell(60, 10, $producto, 1, 0, 'C');     
        $pdf->Cell(40, 10, '$' . number_format($precioSinImpuesto, 2), 1, 0, 'C');     
        $pdf->Cell(40, 10, '$' . number_format($precioConImpuesto, 2), 1, 1, 'C');      

        $importeBruto = $precioSinImpuesto;     
        $iva = $importeBruto * 0.05;     
        $total = $importeBruto + $iva;      

        $pdf->Ln(10);     
        $pdf->SetFont('Arial', '', 10);     
        $pdf->Cell(130, 10, utf8_decode('Importe Bruto'), 0, 0, 'R');     
        $pdf->Cell(40, 10, '$' . number_format($importeBruto, 2), 0, 1, 'R');             
        $pdf->SetFont('Arial', '', 10);     
        $pdf->Cell(130, 10, utf8_decode('IVA Incl. 5%'), 0, 0, 'R');     
        $pdf->Cell(40, 10, '$' . number_format($iva, 2), 0, 1, 'R');             
        $pdf->SetFont('Arial', 'B', 10);     
        $pdf->Cell(130, 10, utf8_decode('Total'), 0, 0, 'R');     
        $pdf->Cell(40, 10, '$' . number_format($total, 2), 0, 1, 'R');       

        $pdf->Ln(20);     
        $pdf->SetFont('Arial', 'B', 12);     
        $pdf->SetFillColor(255, 0, 0);     
        $pdf->SetTextColor(255, 255, 255);     
        $pdf->Cell(0, 10, utf8_decode('Gracias por comprar en Pole-Position'), 0, 1, 'C', true);      

        $pdf->Output('I', 'factura_' . $compraId . '.pdf'); 
    }  
}  

// $factura = new GenerarFactura(); 
// $factura->update();  
?>
