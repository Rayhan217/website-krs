<?php include 'config.php'; ?>
<?= (!isset($_SESSION['logged_in']) ? header("location:index.php") : null) ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin KRS</title>
    <link rel="stylesheet" href="assets/css/dashboard.css">
</head>

<body>

    <div class="wrapper">
        <div class="menu">
            <h1 class="heading">Pengambilan KRS</h1>
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
            <div class="admin">
                <h2>Daftar Mata Kuliah Per-Semester</h2>
                <table>
                    <tr>
                        <th>No.</th>
                        <th>Mata kuliah</th>
                        <th>SKS</th>
                        <th>Semester</th>
                        <th>Prodi</th>
                    </tr>
                    <?php
                    $query = "SELECT * FROM mata_kuliah ORDER BY semester ASC";
                    $res   = mysqli_query($conn, $query);
                    $no    = 1;
                    while ($row = mysqli_fetch_assoc($res)) :
                    ?>
                        <tr>
                            <td><?= $no ?></td>
                            <td><?= $row['nama_makul'] ?></td>
                            <td><?= $row['sks'] ?></td>
                            <td><?= $row['semester'] ?></td>
                            <td><?= $row['prodi'] ?></td>
                        </tr>
                    <?php $no++;
                    endwhile ?>
                </table>
            </div>
        </div>
    </div>

</body>

</html>

