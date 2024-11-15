<?php

require('fpdf186/fpdf.php');
include_once('db.class.php');

class GenerarFacturaAlquiler
{
    private $db;
    private $title;

    public function __construct()
    {
        $this->db = new DB();
        $this->title = "PP | Factura";

    }

    public function getTitle()
    {
        return $this->title;
    }

    public function update($id)
    {
        if (!$id) {
            die("Error: Se requiere un ID de alquiler.");
        }

        $this->crearFactura($id);
    }

    private function crearFactura($alquilerId)
    {
        $pdf = new FPDF();
        $pdf->AddPage();

        // Cargar el logo
        $pdf->Image('img/logo.png', 10, 10, 30);

        // Obtener la fecha de alquiler desde la base de datos
        $alquiler = $this->db->findOne("SELECT *, DATEDIFF(fecha_fin, fecha_inicio) AS dias_alquiler FROM alquiler WHERE id = $alquilerId");
        if (!$alquiler) {
            die("Error: No se encontró la alquiler con ID $alquilerId.");
        }
        $alquilerfechaCompra = $alquiler->fechaCompra;

        // Generar un número de factura aleatorio
        $numeroFactura = random_int(10000000, 99999999);

        // Obtener información del cliente
        $cliente = $this->db->findOne("SELECT * FROM cuentas WHERE id = {$alquiler->idCliente}");
        if (!$cliente) {
            die("Error: No se encontró el cliente con ID {$alquiler->idCliente}.");
        }
        $nombreCompleto = utf8_decode($cliente->nombreCompleto ?? 'Cliente Anónimo');

        // Obtener información del vehículo
        $vehiculo = $this->db->findOne("SELECT * FROM vehiculo WHERE id = {$alquiler->idVehiculo}");
        if (!$vehiculo) {
            die("Error: No se encontró el vehículo con ID {$alquiler->idVehiculo}.");
        }
        $producto = utf8_decode($vehiculo->marca . ' ' . ($vehiculo->modelo ?? 'Producto Desconocido'));
        $precioSinImpuesto = $alquiler->subtotal ?? 0;
        $precioConImpuesto = $precioSinImpuesto * 1.05; // 5% IVA
        $diasAlquiler = $alquiler->dias_alquiler;

        // Agregar información al PDF
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->SetXY(50, 10);
        $pdf->SetXY(50, 20);
        $pdf->SetXY(150, 10);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(50, 10, utf8_decode('Fecha: ' . $alquiler->fechaCompra), 0, 0, 'R');
        $pdf->SetXY(150, 20);
        $pdf->Cell(50, 10, utf8_decode('Número de Factura: ' . $numeroFactura), 0, 0, 'R');

        $pdf->SetXY(10, 40);     
        $pdf->SetFont('Arial', 'B', 10);     
        $pdf->Cell(100, 10, $nombreCompleto, 0, 1);     
        $pdf->SetFont('Arial', '', 10);     
        $pdf->Cell(100, 5, utf8_decode($alquiler->direccion));     
        $pdf->Ln();     
        $pdf->Cell(100, 5, utf8_decode('CP: ' . $alquiler->codigo));     
        $pdf->Ln();     
        $pdf->Cell(100, 5, utf8_decode($alquiler->ciudad . ', ' . $alquiler->pais));    

        // Encabezados de la tabla de productos
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetFillColor(220, 220, 220);

        // Calcular posición para centrar la tabla
        $tableWidth = 60 + 40 + 40 + 40;
        $startX = ($pdf->GetPageWidth() - $tableWidth) / 2;
        $pdf->SetXY($startX, 80);

        $pdf->Cell(60, 10, utf8_decode('PRODUCTO'), 1, 0, 'C', true);
        $pdf->Cell(40, 10, utf8_decode('PRECIO'), 1, 0, 'C', true);
        $pdf->Cell(40, 10, utf8_decode('TOTAL'), 1, 0, 'C', true);
        $pdf->Cell(40, 10, utf8_decode('DIAS ALQUILADOS'), 1, 1, 'C', true);

        // Datos del producto
        $pdf->SetX($startX);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(60, 10, $producto, 1, 0, 'C');
        $pdf->Cell(40, 10, '$' . number_format($precioSinImpuesto, 2), 1, 0, 'C');
        $pdf->Cell(40, 10, '$' . number_format($precioConImpuesto, 2), 1, 0, 'C');
        $pdf->Cell(40, 10, $diasAlquiler, 1, 1, 'C'); // Mostrar días alquilados

        // Calcular totales
        $importeBruto = $precioSinImpuesto;
        $iva = $importeBruto * 0.05;
        $total = $importeBruto + $iva;

        // Totales
        $pdf->Ln(10);
        $pdf->SetFont('Arial', '', size: 10);
        $pdf->Cell(130, 10, utf8_decode('Importe Bruto'), 0, 0, 'R');
        $pdf->Cell(40, 10, '$' . number_format($importeBruto, 2), 0, 1, 'R');

        $pdf->SetFont('Arial', 'B', size: 10);
        $pdf->Cell(130, 10, utf8_decode('Fechas:'), 0, 0, 'R');
        $pdf->SetFont('Arial', '', size: 10);
        $pdf->Cell(40, 10, 'Desde: ' . $alquiler->fecha_inicio, 0, 1, 'R');
        $pdf->Cell(130, 10, '', 0, 0, 'R');
        $pdf->Cell(40, 10, 'Hasta: ' . $alquiler->fecha_fin, 0, 1, 'R');


        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(130, 10, utf8_decode('IVA Incl. 5%'), 0, 0, 'R');
        $pdf->Cell(40, 10, '$' . number_format($iva, 2), 0, 1, 'R');

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(130, 10, utf8_decode('Total'), 0, 0, 'R');
        $pdf->Cell(40, 10, '$' . number_format($total, 2), 0, 1, 'R');

        // Mensaje de agradecimiento
        $pdf->Ln(20);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->SetFillColor(255, 0, 0);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Cell(0, 10, utf8_decode('Gracias por alquilar en Pole-Position'), 0, 1, 'C', true);

        // Salida del PDF
        $pdf->Output('I', 'factura_' . $alquilerId . '.pdf');
    }
}
?>