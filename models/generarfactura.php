<?php

require('../fpdf186/fpdf.php');
require('../db.class.php'); // Asegúrate de que la clase DB esté disponible

class GenerarFactura {
    private $db;

    public function __construct() {
        $this->db = new DB(); // Instancia la clase DB
    }

    public function crearFactura($compraId) {
        $pdf = new FPDF();
        $pdf->AddPage();

        // Logo
        $pdf->Image('../img/logo.png', 10, 10, 30);

        // Fecha de Compra desde la base de datos
        $compra = $this->db->findOne("SELECT * FROM compra WHERE id = $compraId");
        $fechaCompra = $compra->fechaCompra ?? date('Y-m-d'); // Si no se encuentra, usa la fecha actual

        // Número de factura
        $numeroFactura = random_int(10000000, 99999999);

        // Cliente desde la base de datos
        $cliente = $this->db->findOne("SELECT * FROM cuentas WHERE id = {$compra->idCliente}");
        $nombreCompleto = $cliente->nombreCompleto ?? 'Cliente Anónimo';

        // Datos del Vehículo Comprado
        $vehiculo = $this->db->findOne("SELECT * FROM vehiculo WHERE id = {$compra->idVehiculo}");
        $producto = $vehiculo->modelo ?? 'Producto Desconocido';
        $precioSinImpuesto = $vehiculo->precio ?? 0;
        $precioConImpuesto = $precioSinImpuesto * 1.05; // Con un 5% de IVA

        // Mostrar datos en el PDF
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->SetXY(50, 10);
        $pdf->SetXY(50, 20);
        $pdf->SetXY(150, 10);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(50, 10, 'Fecha: ' . $fechaCompra, 0, 0, 'R');
        $pdf->SetXY(150, 20);
        $pdf->Cell(50, 10, 'Numero de Factura: ' . $numeroFactura, 0, 0, 'R');

        // Información del Cliente
        $pdf->SetXY(10, 40);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(100, 10, $nombreCompleto, 0, 1);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(100, 5, 'Ciudad de Durazno');
        $pdf->Ln();
        $pdf->Cell(100, 5, 'CP: 97000');
        $pdf->Ln();
        $pdf->Cell(100, 5, 'Uruguay');

        // Tabla de Productos
        $pdf->SetXY(($pdf->GetPageWidth() - 140) / 2, 80);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetFillColor(220, 220, 220);
        $pdf->Cell(60, 10, 'PRODUCTO', 1, 0, 'C', true);
        $pdf->Cell(40, 10, 'PRECIO', 1, 0, 'C', true);
        $pdf->Cell(40, 10, 'TOTAL', 1, 1, 'C', true);

        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(60, 10, $producto, 1);
        $pdf->Cell(40, 10, '$' . number_format($precioSinImpuesto, 2), 1);
        $pdf->Cell(40, 10, '$' . number_format($precioConImpuesto, 2), 1, 1);

        // Totales
        $importeBruto = $precioSinImpuesto;
        $iva = $importeBruto * 0.05;
        $total = $importeBruto + $iva;

        $pdf->Ln(10);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(130, 10, 'Importe Bruto', 0, 0, 'R');
        $pdf->Cell(40, 10, '$' . number_format($importeBruto, 2), 0, 1, 'R');

        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(130, 10, 'IVA Incl. 5%', 0, 0, 'R');
        $pdf->Cell(40, 10, '$' . number_format($iva, 2), 0, 1, 'R');

        // Mensaje final
        $pdf->Ln(20);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->SetFillColor(255, 0, 0);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Cell(0, 10, 'Gracias por comprar en Pole-Position', 0, 1, 'C', true);

        $pdf->Output();
    }
}

// Generar la factura pasando el ID de la compra
$factura = new GenerarFactura();
$factura->crearFactura(1); // Cambia '1' por el ID de la compra que corresponda


?>
