<?php
 
include("../koneksi.php");

$nama     = $_POST['nama'];
$nisn     = $_POST['nisn'];
$tp_lahir = $_POST['tp_lahir'];
$tg_lahir = $_POST['tg_lahir'];
$alamat   = $_POST['alamat'];
$email    = $_POST['email'];
$jk = $_POST['jk'] ?? '';

$jur      = $_POST['jur'];


$nama_foto = $_FILES['foto']['name'];
$tmp_foto  = $_FILES['foto']['tmp_name'];
$error     = $_FILES['foto']['error'];

if ($error !== 0) {
    die("Upload foto gagal");
}


$folder = "../fotosiswa/";
if (!is_dir($folder)) {
    mkdir($folder, 0777, true);
}


$foto_baru = time() . "_" . $nama_foto;


move_uploaded_file($tmp_foto, $folder . $foto_baru);


$query = "INSERT INTO biodata 
(nama, nisn, tp_lahir, tg_lahir, alamat, email, jk, jur, foto)
VALUES 
('$nama','$nisn','$tp_lahir','$tg_lahir','$alamat','$email','$jk','$jur','$foto_baru')";

$tambah = mysqli_query($koneksi, $query);

if ($tambah) {
    header("location:index.php");
} else {
    echo "Data gagal ditambah: " . mysqli_error($koneksi);
}
?>

?>