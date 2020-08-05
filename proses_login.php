<?php
 session_start();
 $username = $_POST["username"];
 $password = $_POST["password"];

 //koneksi database
 $koneksi = mysqli_connect("localhost","root","","perpustakaan");
 $sql = "select * from pustakawan where username='$username' and password='$password'";
 $result = mysqli_query($koneksi,$sql);
 $jumlah = mysqli_num_rows($result);

 if ($jumlah == 0) {
   // jumlah datanya = 0 berarti username/password salah
   header("location:login.php");
 } else {
   // buat sebuah variabel session
   $_SESSION["session_pustakawan"] = mysqli_fetch_array($result);
   header("location:template.php");
 }

if (isset($_GET["logout"])) {
  // hapus session-nya
  session_destroy();
  header("location:login.php");
}
 ?>
