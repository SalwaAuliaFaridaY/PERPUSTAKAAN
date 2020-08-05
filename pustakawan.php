      <script type="text/javascript">
        function Add() {
          document.getElementById('action').value = "insert";

          document.getElementById("nip").value = "";
          document.getElementById("nama").value = "";
          document.getElementById("kontak").value = "";
        }

        function Edit(index) {
          document.getElementById('action').value ="update";

          var table = document.getElementById("table_pustakawan");

          var nip = table.rows[index].cells[0].innerHTML;
          var nama = table.rows[index].cells[1].innerHTML;
          var kontak = table.rows[index].cells[2].innerHTML;

          document.getElementById("nip").value = nip;
          document.getElementById("nama").value = nama;
          document.getElementById("kontak").value = kontak;
        }
      </script>
      <div class="card col-sm-12">
        <div class="card-header">
          <h4>Pustakawan</h4>
        </div>
        <div class="card-body">
          <?php
            $koneksi = mysqli_connect("localhost","root","","perpustakaan");
            $sql = "select * from pustakawan";
            $result = mysqli_query($koneksi,$sql);
            $count = mysqli_num_rows($result);
          ?>

          <?php if ($count == 0): ?>
            <div class="alert alert-info">
              Data belum tersedia
            </div>
          <?php else: ?>
            <table class="table" id="table_pustakawan">
              <thead>
                <tr>
                  <th>NIP</th>
                  <th>Nama</th>
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
                    <td><?php echo $hasil["nip"] ?></td>
                    <td><?php echo $hasil["nama"] ?></td>
                    <td><?php echo $hasil["kontak"] ?></td>
                    <td><?php echo $hasil["username"] ?></td>
                    <td><?php echo $hasil["password"] ?></td>
                    <td>
                      <img src="<?php echo "img_pustakawan/".$hasil["image"]; ?>"
                      class="img" width="100">
                    </td>
                    <td>
                      <button type="button" class="btn btn-info"
                      data-toggle="modal" data-target="#modal"
                      onclick="Edit(this.parentElement.parentElement.rowIndex);">
                      Edit
                      </button>

                      <a href="db_pustakawan.php?hapus=pustakawan&nip=<?php echo $hasil["nip"]; ?>"
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
          <form action="db_pustakawan.php" method="post" enctype="multipart/form-data">
            <div class="modal-header">
              <h4>Pustakawan</h4>
            </div>
            <div class="modal-body">
              <input type="hidden" name="action" id="action">

              NIP
              <input type="text" name="nip" id="nip" class="form-control">
              Nama
              <input type="text" name="nama" id="nama" class="form-control">
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
