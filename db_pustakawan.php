<?php
  $koneksi = mysqli_connect("localhost","root","","perpustakaan");

  if (isset($_POST["action"])) {
    $nip = $_POST["nip"];
    $nama = $_POST["nama"];
    $kontak = $_POST["kontak"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $action = $_POST["action"];

    if ($action == "insert") {
      // kita tampung deskripsi file gambarnya
      $path = pathinfo($_FILES["image"]["name"]);
      // ambil extensi gambarnya
      $extensi = $path["extension"];
      // rangkai nama file yang akan disimpan
      $filename = $nip."-".rand(1,1000).".".$extensi;

      // simpan file gambar
      move_uploaded_file($_FILES["image"]["tmp_name"],"img_pustakawan/$filename");
      $sql = "insert into pustakawan values('$nip','$nama','$kontak','$username','$password','$filename')";
    } else if($action == "update") {
      // ambil data dari database
      $sql = "select * from pustakawan where nip='$nip'";
      $result = mysqli_query($koneksi,$sql);
      $hasil = mysqli_fetch_array($result); // untuk mengkonversi menjadi array
      if (!empty($_FILES["image"]["name"])) {
        if (file_exists("img_pustakawan/".$hasil["image"])) {
          // jika filenya tersedia
          unlink("img_pustakawan/".$hasil["image"]);
          // menghapus file
        }
        $path = pathinfo($_FILES["image"]["name"]);
        // ambil extensi gambarnya
        $extensi = $path["extension"];
        // rangkai nama file yang akan disimpan
        $filename = $nip."-".rand(1,1000).".".$extensi;

        // simpan file gambar
        move_uploaded_file($_FILES["image"]["tmp_name"],"img_pustakawan/$filename");
        $sql = "update pustakawan set nama='$nama',kontak='$kontak',username='$username',password='$password',image='$filename' where nip='$nip'";
      }else{
        $sql = "update pustakawan set nama='$nama',kontak='$kontak',username='$username',password='$password' where nip='$nip'";
      }
    }
    mysqli_query($koneksi,$sql);
    echo $sql;
    header("location:template.php?page=pustakawan");
  }

  if (isset($_GET["hapus"])) {
    $nip = $_GET["nip"];
    // ambil data dari database
    $sql = "select * from pustakawan where nip='$nip'";
    // eksekusi query
    $result = mysqli_query($koneksi,$sql);
    // konversi ke array
    $hasil = mysqli_fetch_array($result);
    if (file_exists("img_pustakawan/".$hasil["image"])) {
      unlink("img_pustakawan/".$hasil["image"]);
      // menghapus file
    }
    $sql = "delete from pustakawan where nip='$nip'";
    mysqli_query($koneksi,$sql);
    header("location:template.php?page=pustakawan");
  }
 ?>
