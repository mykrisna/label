

<?php

//include 'koneksi.php';

include "excel_reader2.php";
?>

<?php

$target = basename($_FILES['userfile']['name']);
move_uploaded_file($_FILES['userfile']['tmp_name'], $target);


chmod($_FILES['userfile']['name'], 0777);


$data = new Spreadsheet_Excel_Reader($_FILES['userfile']['name'], false);

$jumlah_baris = $data->rowcount($sheet_index = 0);

$url = 'http://10.100.200.2/label/welcome/simpan';
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
	/*
	mysqli_query($koneksi, "INSERT into tb_barcode(no_ctn,ship_to,ship2,po,qty,style,sku,color,size,barcode,alamat1,alamat2,alamat3) 
	values('" . $no_ctn . "','" . $buyer . "','" . $deskripsi . "','" . $po . "','" . $qty . "','" . $style . "','" . $sku . "','" . $color . "','" . $size . "','" . $barcode . "','" . $alamat1 . "','" . $alamat2 . "','" . $alamat3 . "')");
	$berhasil++;
	*/

	$post_data = array(
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

	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post_data));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$response = curl_exec($ch);
	if (curl_errno($ch)) {
		echo 'Error: ' . curl_error($ch);
	}
	$responses[] = $response;
	curl_close($ch);
	foreach ($responses as $response) {
		echo $response;
	}
}

unlink($_FILES['userfile']['name']);
?>