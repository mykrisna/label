<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<meta name="description" content="" />
	<meta name="author" content="" />
	<title>TTA | Shipment</title>
	<link href="<?= base_url(); ?>vendor/css/style.min.css" rel="stylesheet" />
	<link href="<?= base_url(); ?>vendor/css/styles.css" rel="stylesheet" />
	<script src="<?= base_url(); ?>vendor/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
	<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
		<!-- Navbar Brand-->
		<a class="navbar-brand ps-3" href="index.html">TTA</a>
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
							<div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
							Shipment
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
					<h1 class="mt-4">Shipment</h1>

					<div class="card mb-4">
						<div class="card-body">

						</div>
					</div>
					<div class="card mb-4">
						<div class="card-header">
							<i class="fas fa-table me-1"></i>
							Shipment List
						</div>
						<div class="card-body">
							<table id="datatablesSimple">
								<thead>
									<tr>
										<th>#</th>
										<th>Date</th>
										<th>Ship To</th>
										<th></th>
										<th>PO</th>
										<th>Qty</th>
										<th>Style</th>
										<th>SKU</th>
										<th>Color</th>
										<th>Size</th>
										<th>Barcode</th>
										<th>Option</th>
									</tr>
								</thead>

								<tbody>
									<?php
									$i = 1;
									foreach ($data as $dt) {
										echo "<tr>";
										echo "<td>" . $i . "</td>";
										echo "<td>" . $dt['shipdate'] . "</td>";
										echo "<td>" . $dt['ship_to'] . "</td>";
										echo "<td>" . $dt['ship2'] . "</td>";
										echo "<td>" . $dt['po'] . "</td>";
										echo "<td>" . $dt['qty'] . "</td>";
										echo "<td>" . $dt['style'] . "</td>";
										echo "<td>" . $dt['sku'] . "</td>";
										echo "<td>" . $dt['color'] . "</td>";
										echo "<td>" . $dt['size'] . "</td>";
										echo "<td>" . $dt['barcode'] . "</td>";
										echo "<td><button class='btn btn-primary btn-sm'>Cetak</button></td>";
										echo "</tr>";
										$i++;
									}
									?>
								</tbody>
							</table>
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
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
	<script src="<?= base_url(); ?>vendor/js/scripts.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
	<script src="<?= base_url(); ?>vendor/js/datatables-simple-demo.js"></script>
</body>

</html>