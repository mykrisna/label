<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<meta name="description" content="" />
	<meta name="author" content="" />
	<title>TTA | Label Shipment</title>
	<link href="<?= base_url(); ?>vendor/css/style.min.css" rel="stylesheet" />
	<link href="<?= base_url(); ?>vendor/css/styles.css" rel="stylesheet" />
	<link href="<?= base_url(); ?>vendor/css/sweetalert2.min.css" rel="stylesheet" />
	<script src="<?= base_url(); ?>vendor/js/all.js" crossorigin="anonymous"></script>
	<script src="<?= base_url(); ?>vendor/js/jquery-3.5.1.js"></script>
</head>

<body class="sb-nav-fixed">
	<nav class="sb-topnav navbar navbar-expand navbar-dark bg-primary">
		<!-- Navbar Brand-->
		<a class="navbar-brand ps-3" href="<?= base_url() ?>">TTA</a>
		<!-- Sidebar Toggle-->
		<button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>

		<ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
			<li class="nav-item dropdown">

			</li>
		</ul>
	</nav>
	<div id="layoutSidenav">
		<div id="layoutSidenav_nav">
			<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
				<div class="sb-sidenav-menu">
					<div class="nav">
						<div class="sb-sidenav-menu-heading">Menu</div>
						<a class="nav-link" href="<?= base_url() ?>">
							<div class="sb-nav-link-icon"><i class="fas fa-tag"></i></div>
							Label Shipment
						</a>
					</div>
				</div>
				<div class="sb-sidenav-footer">
					<div class="small">Logged in as:</div>
					Nobody
				</div>
			</nav>
		</div>
		<div id="layoutSidenav_content">
			<main>
				<div class="container-fluid px-4">
					<h1 class="mt-4"><i class="fas fa-tag"></i>&nbsp;Label Shipment Generator</h1>

					<div class="card mb-4">
						<div class="card-body">
							<form id="f_upload_xls" method="POST" action="http://10.100.200.1:8787/label_barcode/upload_barcode.php" enctype="multipart/form-data">
								<div class="input-group">
									<input type="file" class="form-control" name="userfile" id="userfile" accept=".xls" aria-label="Upload" required>
									<button class="btn btn-success" type="submit" id="inputGroupFileAddon04"><i class="fas fa-file-import"></i>&nbsp;Import xls</button>
								</div>
							</form>
						</div>
					</div>
					<div class="card mb-4">
						<div class="card-header">
							<i class="fas fa-table me-1"></i>
							Label List
							<button style="float:right;margin: 1px;" type="button" onclick="tampildata()" class="btn btn-primary btn-sm"><i class="fas fa-sync-alt"></i>&nbsp;Refresh Grid</button>
							<button style="float:right;margin: 1px;" type="button" onclick="pesan()" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i>&nbsp;Kosongkan data</button>
							<label>&nbsp;</label>
							<a href="<?= base_url('welcome/cetak'); ?>" style="float:right;margin: 1px;" target="_blank" type="button" class="btn btn-warning btn-sm"><i class="fas fa-print"></i>&nbsp;Cetak</a>

						</div>
						<div class="card-body">
							<div id="tbdata"></div>
						</div>
					</div>
				</div>
			</main>
			<footer class="py-4 bg-light mt-auto">
				<div class="container-fluid px-4">
					<div class="d-flex align-items-center justify-content-between small">
						<div class="text-muted">GNU</div>
						<div>
						</div>
					</div>
				</div>
			</footer>
		</div>
	</div>
	<script src="<?= base_url(); ?>vendor/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
	<script src="<?= base_url(); ?>vendor/js/scripts.js"></script>
	<script src="<?= base_url(); ?>vendor/js/simple-datatables.min.js" crossorigin="anonymous"></script>
	<script src="<?= base_url(); ?>vendor/js/datatables-simple-demo.js"></script>
	<script src="<?= base_url(); ?>vendor/js/sweetalert2.min.js"></script>
</body>

</html>

<script type="text/javascript">
	$.get("<?= base_url('Welcome/tb_data') ?>", function(data, status) {
		$("#tbdata").html(data);
	});

	function tampildata() {
		$.get("<?= base_url('Welcome/tb_data') ?>", function(data, status) {
			$("#tbdata").html(data);
		});
	}

	function pesan() {
		Swal.fire({
			title: "Semua data akan dihapus",
			text: "Lanjutkan ?",
			icon: "warning",
			showCancelButton: true,
			confirmButtonColor: "#3085d6",
			cancelButtonColor: "#d33",
			cancelButtonText: "Jangan donk",
			confirmButtonText: "Ya, Hapus Semua"
		}).then((result) => {
			if (result.isConfirmed) {
				// begin
				$.get("<?= base_url('Welcome/delete_all') ?>", function(data, status) {
					//$("#tbspk").html(data);
					tampildata();
				});
				//end
			}
		});
	}

	$('#f_upload_xls').on('submit', function(e) {
		e.preventDefault();
		$.ajax({
			url: "http://10.100.200.1:8787/label_barcode/upload_barcode.php",
			type: "POST",
			data: new FormData(this),
			contentType: false,
			cache: false,
			processData: false,
			success: function(data) {
				tampildata();
				document.getElementById('userfile').value = '';
			}
		});
	});
</script>