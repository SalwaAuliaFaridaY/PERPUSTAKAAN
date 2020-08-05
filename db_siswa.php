<?php
  $koneksi = mysqli_connect("localhost","root","","perpustakaan");

  if (isset($_POST["action"])) {
    $nisn = $_POST["nisn"];
    $nama = $_POST["nama"];
    $alamat = $_POST["alamat"];
    $kontak = $_POST["kontak"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $action = $_POST["action"];

    if ($action == "insert") {
      $path = pathinfo($_FILES["image"]["name"]);
      $extensi = $path["extension"];
      $filename = $nisn."-".rand(1,1000).".".$extensi;

      move_uploaded_file($_FILES["image"]["tmp_name"],"img_siswa/$filename");
      $sql = "insert into siswa values('$nisn','$nama','$alamat','$kontak','$username','$password','$filename')";
    } else if($action == "update") {
      $sql = "select * from siswa where nisn='$nisn'";
      $result = mysqli_query($koneksi,$sql);
      $hasil = mysqli_fetch_array($result);
      if (isset($_FILES["image"])) {
        if (file_exists("img_siswa/".$hasil["image"])) {
          unlink("img_siswa/".$hasil["image"]);
        }
        $path = pathinfo($_FILES["image"]["name"]);
        $extensi = $path["extension"];
        $filename = $nisn."-".rand(1,1000).".".$extensi;

        move_uploaded_file($_FILES["image"]["tmp_name"],"img_siswa/$filename");
        $sql = "update siswa set nama='$nama',alamat='$alamat',kontak='$kontak',username='$username',password='$password',image='$filename' where nisn='$nisn'";
      } else {
        $sql = "update siswa set nama='$nama',alamat='$alamat',kontak='$kontak',username='$username',password='$password' where nisn='$nisn'";
      }
    }
    mysqli_query($koneksi,$sql);
    echo $sql;
    header("location:template.php?page=siswa");
  }

  if (isset($_GET["hapus"])) {
    $nisn = $_GET["nisn"];
    $sql = "select * from siswa where nisn='$nisn'";
    $result = mysqli_query($koneksi,$sql);
    $hasil = mysqli_fetch_array($result);
    if (file_exists("img_siswa/".$hasil["image"])) {
      unlink("img_siswa/".$hasil["image"]);
    }
    $sql = "delete from siswa where nisn='$nisn'";
    mysqli_query($koneksi,$sql);
    header("location:template.php?page=siswa");
  }
 ?>
