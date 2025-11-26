<?php
session_start();
include "koneksi.php";

// Cek login
if (!isset($_SESSION['username'])) {
    header("location:login.php");
    exit();
}

// Hanya level 1 boleh akses
if ($_SESSION['level'] != 1) {
    echo "<h3>Anda tidak punya akses ke halaman ini.</h3>";
    exit();
}

// Proses Tambah User
if (isset($_POST['tambah'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $level = $_POST['level'];

    mysqli_query($koneksi, "INSERT INTO nama_user (username, password, level)
                            VALUES ('$username', '$password', '$level')");
    header("location:data_master.php");
    exit();
}

// Proses Edit User
if (isset($_POST['edit'])) {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $level = $_POST['level'];

    mysqli_query($koneksi, "UPDATE nama_user SET 
        username='$username', 
        password='$password', 
        level='$level' 
        WHERE id='$id'
    ");
    header("location:data_master.php");
    exit();
}

// Proses Hapus User
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    mysqli_query($koneksi, "DELETE FROM nama_user WHERE id='$id'");
    header("location:data_master.php");
    exit();
}
?>

<h2>Data Master User</h2>

<!-- Form Tambah User -->
<h3>Tambah User</h3>
<form method="POST">
    <label>Username</label><br>
    <input type="text" name="username" required><br><br>

    <label>Password</label><br>
    <input type="text" name="password" required><br><br>

    <label>Level</label><br>
    <select name="level" required>
        <option value="1">Admin</option>
        <option value="2">User</option>
    </select><br><br>

    <button type="submit" name="tambah">Tambah</button>
</form>

<hr>

<!-- Tabel User -->
<h3>Daftar User</h3>
<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>No</th>
        <th>Username</th>
        <th>Password</th>
        <th>Level</th>
        <th>Aksi</th>
    </tr>

    <?php
    $no = 1;
    $data = mysqli_query($koneksi, "SELECT * FROM nama_user ORDER BY id ASC");

    while ($row = mysqli_fetch_assoc($data)) {
        echo "
        <tr>
            <td>$no</td>
            <td>{$row['username']}</td>
            <td>{$row['password']}</td>
            <td>{$row['level']}</td>
            <td>
                <a href='?edit={$row['id']}'>Edit</a> | 
                <a href='?hapus={$row['id']}' onclick='return confirm(\"Hapus user ini?\")'>Hapus</a>
            </td>
        </tr>";
        $no++;
    }
    ?>
</table>

<!-- Form Edit User  -->
<?php
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $result = mysqli_query($koneksi, "SELECT * FROM nama_user WHERE id='$id'");
    $u = mysqli_fetch_assoc($result);
?>

<hr>
<h3>Edit User</h3>

<form method="POST">
    <input type="hidden" name="id" value="<?php echo $u['id']; ?>">

    <label>Username</label><br>
    <input type="text" name="username" value="<?php echo $u['username']; ?>" required><br><br>

    <label>Password</label><br>
    <input type="text" name="password" value="<?php echo $u['password']; ?>" required><br><br>

    <label>Level</label><br>
    <select name="level" required>
        <option value="1" <?php if ($u['level'] == 1) echo "selected"; ?>>Admin</option>
        <option value="2" <?php if ($u['level'] == 2) echo "selected"; ?>>User</option>
    </select><br><br>

    <button type="submit" name="edit">Simpan Perubahan</button>
</form>

<?php } ?>
