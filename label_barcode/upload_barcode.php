

<?php
header("Access-Control-Allow-Origin: *");
include "excel_reader2.php";
$target = basename($_FILES['userfile']['name']);
move_uploaded_file($_FILES['userfile']['tmp_name'], $target);
chmod($_FILES['userfile']['name'], 0777);
$data = new Spreadsheet_Excel_Reader($_FILES['userfile']['name'], false);
$jumlah_baris = $data->rowcount($sheet_index = 0);
$url = 'http://10.100.200.2/label/welcome/simpan';
$url2 = 'http://10.100.200.2/label/welcome/delete_all';
$options = array(
	'http' => array(
		'header'  => "Content-type: application/x-www-form-urlencoded",
		'method'  => 'POST',
		'content' => http_build_query()
	)
);
$context  = stream_context_create($options);
$resp = file_get_contents($url2, false, $context);
$berhasil = 0;
for ($i = 2; $i <= $jumlah_baris; $i++) {
	$no_ctn     = $data->val($i, 1);
	$buyer   = $data->val($i, 2);
	$alamat1  = $data->val($i, 3);
	$alamat2  = $data->val($i, 4);
	$alamat3  = $data->val($i, 5);
	$deskripsi  = $data->val($i, 6);
	$po  = $data->val($i, 7);
	$qty  = $data->val($i, 8);
	$style  = $data->val($i, 9);
	$sku  = $data->val($i, 10);
	$color  = $data->val($i, 11);
	$size  = $data->val($i, 12);
	$barcode  = $data->val($i, 13);


	$kirimdata = array(
		'no_ctn' => $no_ctn,
		'buyer' => $buyer,
		'alamat1' => $alamat1,
		'alamat2' => $alamat2,
		'alamat3' => $alamat3,
		'deskripsi' => $deskripsi,
		'po' => $po,
		'qty' => $qty,
		'style' => $style,
		'sku' => $sku,
		'color' => $color,
		'size' => $size,
		'barcode' => $barcode,
	);


	$options = array(
		'http' => array(
			'header'  => "Content-type: application/x-www-form-urlencoded",
			'method'  => 'POST',
			'content' => http_build_query($kirimdata)
		)
	);
	$context  = stream_context_create($options);
	//$resp2 = file_get_contents($url2, false, $context);
	$resp = file_get_contents($url, false, $context);
	echo $resp;
}





unlink($_FILES['userfile']['name']);
header("location:http://10.100.200.2/label/");
?>