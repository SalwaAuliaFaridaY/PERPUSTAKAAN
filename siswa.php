      <script type="text/javascript">
        function Add() {
          document.getElementById('action').value = "insert";

          document.getElementById("nisn").value = "";
          document.getElementById("nama").value = "";
          document.getElementById("alamat").value = "";
          document.getElementById("kontak").value = "";
        }

        function Edit(index) {
          document.getElementById('action').value ="update";

          var table = document.getElementById("table_siswa");

          var nisn = table.rows[index].cells[0].innerHTML;
          var nama = table.rows[index].cells[1].innerHTML;
          var alamat = table.rows[index].cells[2].innerHTML;
          var kontak = table.rows[index].cells[3].innerHTML;

          document.getElementById("nisn").value = nisn;
          document.getElementById("nama").value = nama;
          document.getElementById("alamat").value = alamat;
          document.getElementById("kontak").value = kontak;
        }
      </script>
      <div class="card col-sm-12">
        <div class="card-header">
          <h4>Daftar Siswa</h4>
        </div>
        <div class="card-body">
          <?php
            $koneksi = mysqli_connect("localhost","root","","perpustakaan");
            $sql = "select * from siswa";
            $result = mysqli_query($koneksi,$sql);
            $count = mysqli_num_rows($result);
          ?>

          <?php if ($count == 0): ?>
            <div class="alert alert-info">
              Data belum tersedia
            </div>
          <?php else: ?>
            <table class="table" id="table_siswa">
              <thead>
                <tr>
                  <th>NISN</th>
                  <th>Nama</th>
                  <th>Alamat</th>
                  <th>Kontak</th>
                  <th>Username</th>
                  <th>Password</th>
                  <th>Image</th>
                  <th>Opsi</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($result as $hasil): ?>
                  <tr>
                    <td><?php echo $hasil["nisn"] ?></td>
                    <td><?php echo $hasil["nama"] ?></td>
                    <td><?php echo $hasil["alamat"] ?></td>
                    <td><?php echo $hasil["kontak"] ?></td>
                    <td><?php echo $hasil["username"] ?></td>
                    <td><?php echo $hasil["password"] ?></td>
                    <td>
                      <img src="<?php echo "img_siswa/".$hasil["image"]; ?>"
                      class="img" width="100">
                    </td>
                    <td>
                      <button type="button" class="btn btn-info"
                      data-toggle="modal" data-target="#modal"
                      onclick="Edit(this.parentElement.parentElement.rowIndex);">
                      Edit
                      </button>

                      <a href="db_siswa.php?hapus=siswa&nisn=<?php echo $hasil["nisn"]; ?>"
                        onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">
                        <button type="button" class="btn btn-danger">
                          Hapus
                        </button>
                      </a>

                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          <?php endif; ?>
        </div>
        <div class="card-footer">
          <button type="button" class="btn btn-success"
          data-toggle="modal" data-target="#modal" onclick="Add()">
          Tambah
        </button>
        </div>
      </div>


    <div class="modal fade" id="modal">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <form action="db_siswa.php" method="post" enctype="multipart/form-data">
            <div class="modal-header">
              <h4>Form Siswa</h4>
            </div>
            <div class="modal-body">
              <input type="hidden" name="action" id="action">

              NISN
              <input type="text" name="nisn" id="nisn" class="form-control">
              Nama
              <input type="text" name="nama" id="nama" class="form-control">
              Alamat
              <input type="text" name="alamat" id="alamat" class="form-control">
              Kontak
              <input type="text" name="kontak" id="kontak" class="form-control">
              Username
              <input type="text" name="username" id="username" class="form-control">
              Password
              <input type="password" name="password" id="password" class="form-control">
              Image
              <input type="file" name="image" id="image" class="form-control">
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-success">
                Simpan
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
