<?php
session_start();
include 'fpdf186/fpdf.php';
include 'function.php';

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

$products = query("SELECT * FROM tb_barang_masuk ORDER BY tanggal_masuk");

class PDF extends FPDF
{
    // Para el header
    function Header()
    {
        $this->SetFont('Arial', 'B', 16);
        $this->SetTextColor(16, 92, 145);
        $this->Cell(0, 0, 'PT. Gloria Mandiri');
        $this->Ln(5);
        $this->Cell(0, 4, 'Teknik');
        $this->Ln(10);
        $this->SetFont('Arial', '', 10);
        $this->SetTextColor(26, 114, 176);
        $this->Cell(0, 0, 'Rekapitulasi Inventaris Barang');
        $this->Ln(5);
        $this->SetFont('Arial', '', 10);
        $this->SetTextColor(92, 92, 92);
        $this->Cell(0, 0, 'Jl. Soekarno Hatta');
        $this->Ln(4);
        $this->Cell(0, 0, 'Gg. Bahagia No. 19');
        $this->Ln(4);
        $this->Cell(0, 0, 'Kelurahan Labuh Baru Timur');
        $this->Ln(4);
        $this->Cell(0, 0, 'Kec. Payung Sekaki, 28292');
        $this->Ln(4);
        $this->Cell(0, 0, '(0761) 567632');
        $this->Ln(8);
    }

    // el footer de la pagina
    function Footer()
    {

        $this->SetFont('Arial', '', 10);
        $this->SetY(-40);
        $this->Cell(140, 10, 'Tanda tangan supervisor: ', 1, 0, 'L');
        $this->Cell(50, 10,  "Tanggal: " .  date('Y/m/d'), 1, 0, 'C');
    }
}

// Instanciation of inherited class
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();

// Table
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetLineWidth(.3);
$pdf->SetTextColor(16, 92, 145);

$w = array(10, 40, 35, 40, 45);

$pdf->cell(8);
$header = ['NO.', 'TANGGAL MASUK', 'ID BARANG', 'NAMA BARANG', 'JUMLAH BARANG'];
for ($i = 0; $i < count($header); $i++) {
    $pdf->Cell($w[$i], 7, $header[$i], 0, 0, 'C');
}
$pdf->Ln();

$pdf->SetFont('Arial', '', 10);
$pdf->SetTextColor(0, 0, 0);
$i = 1;

foreach ($products as $product) {
    $pdf->cell(8);
    $pdf->Cell($w[0], 6, $i, 1, 0, 'C');
    $pdf->Cell($w[1], 6, $product['tanggal_masuk'], 1, 0, 'C');
    $pdf->Cell($w[2], 6, $product['id_barang'], 1, 0, 'C');
    $pdf->Cell($w[3], 6, $product['nama_barang'], 1, 0, 'LR');
    $pdf->Cell($w[4], 6, $product['jumlah_barang'], 1, 0, 'C',);
    $pdf->Ln();
    $i++;
}


$pdf->Output();
