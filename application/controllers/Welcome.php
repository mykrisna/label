<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{
	public function index()
	{
		$this->load->model('M_sql');
		$data = $this->M_sql->view_barcode();
		$this->load->view('welcome_message', ['data' => $data]);
	}

	public function cetak()
	{
		$this->load->model('M_sql');
		$data = $this->M_sql->view_barcode();
		$this->load->library('Code128');

		$pdf = new PDF_Code128('P', 'mm', [101.6, 101.6]);
		$leftMargin = 3;
		$topMargin = 6;
		$rightMargin = 3;
		$bottomMargin = 5;

		$pdf->SetMargins($leftMargin, $topMargin, $rightMargin);
		$pdf->SetAutoPageBreak(true, $bottomMargin);

		$pdf->AddPage();
		$pdf->SetFont('Arial', '', 10);

		$pdf->SetFont('Times', '', 10);

		foreach ($data as $dt) {
			$pdf->SetFont('arial', '', 22);
			$pdf->Cell(27, 6, 'US', 0, 0);
			$pdf->Cell(27, 6, '', 0, 0);
			$pdf->Cell(40, 7, substr($dt['barcode'], 16), 0, 1, 'R');
			$startY = $pdf->GetY();
			$startX = $pdf->GetX();
			$pdf->SetLineWidth(0.75);
			$pdf->Line($startX, $startY, $startX + 96, $startY);
			$pdf->SetFont('Arial', 'B', 8);
			$pdf->Cell(0, 3, '', 0, 1, 'L');
			$pdf->Cell(50, 3, 'Supplier :', 0, 0, 'L');
			$pdf->Cell(27, 3, 'Ship To :', 0, 0, 'L');
			$pdf->Cell(10, 3, '', 0, 1, 'L');

			$pdf->Cell(50, 3, 'TEX WORLD PTE LTD :', 0, 0, 'L');
			$pdf->Cell(27, 3, $dt['ship_to'], 0, 0, 'L');
			$pdf->Cell(27, 3, '', 0, 1, 'L');

			$pdf->Cell(50, 3, '17 PHILLIP ST #05-01', 0, 0, 'L');
			$pdf->Cell(27, 3, $dt['alamat1'], 0, 0, 'L');
			$pdf->Cell(27, 3, '', 0, 1, 'L');

			$pdf->Cell(50, 3, 'GRANDE BUILDING', 0, 0, 'L');
			$pdf->Cell(27, 3, '', 0, 0, 'L');
			$pdf->Cell(27, 3, '', 0, 1, 'L');

			$pdf->Cell(50, 3, 'SINGAPORE,,04869', 0, 0, 'L');
			$pdf->Cell(27, 3, $dt['alamat2'], 0, 0, 'L');
			$pdf->Cell(27, 3, '', 0, 1, 'L');

			$pdf->Cell(50, 3, 'SG', 0, 0, 'L');
			$pdf->Cell(27, 3, $dt['alamat3'], 0, 0, 'L');
			$pdf->Cell(27, 3, '', 0, 1, 'L');
			$pdf->Cell(27, 3, '', 0, 1);

			$startX = $pdf->GetX();
			$startY = $pdf->GetY();
			$pdf->SetLineWidth(0.75); // Atur lebar garis
			$pdf->Line($startX, $startY, $startX + 96, $startY); // Sesuaikan panjang garis
			$pdf->Ln(); // Pindah ke baris baru

			$pdf->SetFont('Arial', 'B', 12);
			$pdf->Cell(45, 6, $dt['ship2'], 0, 0, 'L');
			$pdf->SetFont('Arial', 'B', 10);
			$pdf->Cell(27, 6, '', 0, 0, 'L');
			$pdf->Cell(27, 6, 'Shade :', 0, 1, 'L');

			$pdf->Cell(35, 5, 'PO : ' . $dt['po'], 0, 0, 'L');
			$pdf->Cell(37, 5, 'Style : ' . $dt['style'], 0, 0, 'L');
			$pdf->Cell(27, 5, 'Color : ' . $dt['color'], 0, 1, 'L');

			$pdf->Cell(35, 5, 'Unit Qty: ' . $dt['qty'], 0, 0, 'L');
			$pdf->Cell(37, 5, 'SKU : ' . $dt['sku'], 0, 0, 'L');
			$pdf->Cell(27, 5, 'Size : ' . $dt['size'], 0, 1, 'L');
			$pdf->Ln();
			$startX = $pdf->GetX();
			$startY = $pdf->GetY();
			$pdf->SetLineWidth(0.75); // Atur lebar garis
			$pdf->Line($startX, $startY, $startX + 96, $startY); // Sesuaikan panjang garis
			$pdf->Ln();

			$pageWidth = $pdf->GetPageWidth();
			$barcodeWidth = 76;
			$xCentered = ($pageWidth - $barcodeWidth) / 2;
			$yPosition = $pdf->GetY();
			$pdf->Code128($xCentered, $pdf->GetY(), $dt['barcode'], $barcodeWidth, 25);
			$pdf->SetY($yPosition + 26);
			$pdf->SetFont('Arial', 'B', 13);
			$pdf->Cell(0, 3, $dt['barcode'], 0, 1, 'C');
			$pdf->Ln();
		}
		$pdf->Output();
	}

	public function do_upload_kirim()
	{
		$this->load->library('Excel');
		$target = basename($_FILES['userfile']['name']);
		move_uploaded_file($_FILES['userfile']['tmp_name'], $target);

		// beri permisi agar file xls dapat di baca
		chmod($_FILES['userfile']['name'], 0777);

		// mengambil isi file xls
		$data = new Spreadsheet_Excel_Reader($_FILES['userfile']['name'], false);
		// menghitung jumlah baris data yang ada
		$jumlah_baris = $data->rowcount($sheet_index = 0);

		// jumlah default data yang berhasil di import
		$berhasil = 0;
		for ($i = 2; $i <= $jumlah_baris; $i++) {

			// menangkap data dan memasukkan ke variabel sesuai dengan kolumnya masing-masing
			$nama     = $data->val($i, 1);
			$alamat   = $data->val($i, 2);
			$telepon  = $data->val($i, 3);

			if ($nama != "" && $alamat != "" && $telepon != "") {
				// input data ke database (table data_pegawai)
				//mysqli_query($koneksi, "INSERT into data_pegawai values('','$nama','$alamat','$telepon')");
				$berhasil++;
			}
		}

		// hapus kembali file .xls yang di upload tadi
		unlink($_FILES['filepegawai']['name']);

		// alihkan halaman ke index.php
		header("location:index.php?berhasil=$berhasil");
	}
}
