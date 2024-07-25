<?php include '../config.php'; ?>
<?= (!isset($_SESSION['logged_in']) ? header("location:index.php") : null) ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin KRS</title>
    <link rel="stylesheet" href="../assets/css/dashboard.css">
</head>

<body>

    <div class="wrapper">
        <div class="menu">
            <h1 class="heading">Daftar KRS</h1>
            <ul>
                <li>
                    <a href="dashboard.php">Dashboard</a>
                </li>
                <li>
                    <a href="user.php">Data User</a>
                </li>
                <li>
                    <a href="daftarkrs.php">Daftar Krs</a>
                </li>
                <li>
                    <a href="krs.php">Peninjauan KRS</a>
                </li>
                <li>
                    <a href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
        <div class="content">
            <div class="admin">
                <h2>Daftar Mata Kuliah Per-Semester</h2>

                <div class="add-form" style="margin-bottom: 20px;">
                    <h3 style="color: #34495e;">Tambah Mata Kuliah Baru</h3>
                    <form method="POST" action="" style="margin-bottom: 20px;">
                        <label style="display: block; margin-bottom: 5px;">Mata Kuliah:</label>
                        <input type="text" name="nama_makul" required style="width: 50%; padding: 8px; margin-bottom: 10px; border: 1px solid #ccc; border-radius: 4px;"><br>
                        <label style="display: block; margin-bottom: 5px;">SKS:</label>
                        <input type="number" name="sks" required style="width: 50%; padding: 8px; margin-bottom: 10px; border: 1px solid #ccc; border-radius: 4px;"><br>
                        <label style="display: block; margin-bottom: 5px;">Semester:</label>
                        <input type="number" name="semester" required style="width: 50%; padding: 8px; margin-bottom: 10px; border: 1px solid #ccc; border-radius: 4px;"><br>
                        <label style="display: block; margin-bottom: 5px;">Prodi:</label>
                        <input type="text" name="prodi" required style="width: 50%; padding: 8px; margin-bottom: 10px; border: 1px solid #ccc; border-radius: 4px;"><br>
                        <button type="submit" name="btn-add" style="background-color: #027F73; color: #fff; padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer;">Tambah</button>
                    </form>
                </div>
                <br>
                <!-- PHP to handle adding new course -->
                <?php
                if (isset($_POST['btn-add'])) {
                    $nama_makul = $_POST['nama_makul'];
                    $sks = $_POST['sks'];
                    $semester = $_POST['semester'];
                    $prodi = $_POST['prodi'];

                    $insert_query = "INSERT INTO mata_kuliah (nama_makul, sks, semester, prodi) VALUES ('$nama_makul', '$sks', '$semester', '$prodi')";
                    if (mysqli_query($conn, $insert_query)) {
                        echo "<div class='notif sukses'>Mata kuliah berhasil ditambahkan.</div>";
                    } else {
                        echo "<div class='notif gagal'>Gagal menambahkan mata kuliah. Silakan coba lagi.</div>";
                    }
                }
                ?>

                <table>
                    <tr>
                        <th>No.</th>
                        <th>Mata kuliah</th>
                        <th>SKS</th>
                        <th>Semester</th>
                        <th>Prodi</th>
                        <th>Action</th>
                    </tr>
                    <?php
                    $query = "SELECT * FROM mata_kuliah ORDER BY semester ASC";
                    $res = mysqli_query($conn, $query);
                    $no = 1;
                    while ($row = mysqli_fetch_assoc($res)) :
                    ?>
                        <tr>
                            <td><?= $no ?></td>
                            <td><?= $row['nama_makul'] ?></td>
                            <td><?= $row['sks'] ?></td>
                            <td><?= $row['semester'] ?></td>
                            <td><?= $row['prodi'] ?></td>
                            <td>
                                <!-- Edit button triggers the edit form -->
                                <form method="POST" action="" style="display:inline;">
                                    <input type="hidden" name="edit_id" value="<?= $row['id_makul'] ?>">
                                    <button type="submit" name="btn-edit">Edit</button>
                                </form>
                                <!-- Delete button -->
                                <form method="POST" action="" style="display:inline;">
                                    <input type="hidden" name="delete_id" value="<?= $row['id_makul'] ?>">
                                    <button type="submit" name="btn-delete" onclick="return confirm('Are you sure you want to delete this course?');">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php $no++;
                    endwhile ?>
                </table>

                <!-- Edit Form -->
                <?php if (isset($_POST['btn-edit'])) :
                    $edit_id = $_POST['edit_id'];
                    $query = "SELECT * FROM mata_kuliah WHERE id_makul = '$edit_id'";
                    $result = mysqli_query($conn, $query);
                    $course = mysqli_fetch_assoc($result);
                ?><br>
                     <div class="edit-form" style="margin-top: 20px;">
                        <h3 style="color: #34495e;">Edit Mata Kuliah</h3>
                        <form method="POST" action="">
                            <input type="hidden" name="id_makul" value="<?= $course['id_makul'] ?>">
                            <label style="display: block; margin-bottom: 5px;">Mata Kuliah:</label>
                            <input type="text" name="nama_makul" value="<?= $course['nama_makul'] ?>" required style="width: 50%; padding: 8px; margin-bottom: 10px; border: 1px solid #ccc; border-radius: 4px;"><br>
                            <label style="display: block; margin-bottom: 5px;">SKS:</label>
                            <input type="number" name="sks" value="<?= $course['sks'] ?>" required style="width: 50%; padding: 8px; margin-bottom: 10px; border: 1px solid #ccc; border-radius: 4px;"><br>
                            <label style="display: block; margin-bottom: 5px;">Semester:</label>
                            <input type="number" name="semester" value="<?= $course['semester'] ?>" required style="width:50%%; padding: 8px; margin-bottom: 10px; border: 1px solid #ccc; border-radius: 4px;"><br>
                            <label style="display: block; margin-bottom: 5px;">Prodi:</label>
                            <input type="text" name="prodi" value="<?= $course['prodi'] ?>" required style="width: 50%; padding: 8px; margin-bottom: 10px; border: 1px solid #ccc; border-radius: 4px;"><br>
                            <button type="submit" name="btn-update" style="background-color:  #027F73; color: #fff; padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer;">Update</button>
                        </form>
                    </div>
                <?php endif; ?>

                <!-- Update course in the database -->
                <?php
                if (isset($_POST['btn-update'])) {
                    $id_makul = $_POST['id_makul'];
                    $nama_makul = $_POST['nama_makul'];
                    $sks = $_POST['sks'];
                    $semester = $_POST['semester'];
                    $prodi = $_POST['prodi'];

                    $update_query = "UPDATE mata_kuliah SET nama_makul = '$nama_makul', sks = '$sks', semester = '$semester', prodi = '$prodi' WHERE id_makul = '$id_makul'";
                    if (mysqli_query($conn, $update_query)) {
                        echo "<div class='notif sukses'>Mata kuliah berhasil diperbarui.</div>";
                    } else {
                        echo "<div class='notif gagal'>Gagal memperbarui mata kuliah. Silakan coba lagi.</div>";
                    }
                }

                // Delete course from the database
                if (isset($_POST['btn-delete'])) {
                    $delete_id = $_POST['delete_id'];
                    $delete_query = "DELETE FROM mata_kuliah WHERE id_makul = '$delete_id'";
                    if (mysqli_query($conn, $delete_query)) {
                        echo "<div class='notif sukses'>Mata kuliah berhasil dihapus.</div>";
                    } else {
                        echo "<div class='notif gagal'>Gagal menghapus mata kuliah. Silakan coba lagi.</div>";
                    }
                }
                ?>

            </div>
        </div>
    </div>

</body>

</html>
