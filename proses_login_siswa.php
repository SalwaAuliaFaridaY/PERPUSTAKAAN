<?php
 session_start();
 $username = $_POST["username"];
 $password = $_POST["password"];

 //koneksi database
 $koneksi = mysqli_connect("localhost","root","","perpustakaan");
 $sql = "select * from siswa where username='$username' and password='$password'";
 $result = mysqli_query($koneksi,$sql);
 $jumlah = mysqli_num_rows($result);

 if ($jumlah == 0) {
   // jumlah datanya = 0 berarti username/password salah
   header("location:login_siswa.php");
 } else {
   // buat sebuah variabel session
   $_SESSION["session_siswa"] = mysqli_fetch_array($result);
   $_SESSION["session_pinjam"] = array(); //ini buat menampung data buku yang dipinjam(keranjang belanja)
   header("location:template_siswa.php");
 }

if (isset($_GET["logout"])) {
  // hapus session-nya
  session_destroy();
  header("location:login_siswa.php");
}
 ?>
