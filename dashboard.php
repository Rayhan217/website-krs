<?php include 'config.php'; ?>
<?= (!isset($_SESSION['logged_in']) ? header("location:index.php") : null) ?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Dashboard</title>
	<link rel="stylesheet" href="assets/css/dashboard.css">
</head>

<body>

	<div class="wrapper">
		<div class="menu">
			<h1 class="heading">Dashboard</h1>
			<ul>
				<li>
					<a href="dashboard.php">Dashboard</a>
				</li>
				<li>
					<a href="kuliah.php">Mata Kuliah Per-Semester</a>
				</li>
				<li>
					<a href="pengambilan.php">Pengambilan KRS</a>
				</li>
				<li>
					<a href="notifikasi.php">Notifikasi</a>
				</li>
				<li>
					<a href="logout.php">Logout</a>
				</li>
			</ul>
		</div>
		<div class="content">
			<img src="assets/img/mahasiswa.jpg">
			<h1>
				Selamat Datang, <?= $_SESSION['nama'] ?> <br>
				
			</h1>
		</div>
	</div>

</body>

</html>