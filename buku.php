      <script type="text/javascript">
        function Add() {
          document.getElementById('action').value = "insert";

          document.getElementsByClassName('kode_buku').value = "";
          document.getElementById('genre').value = "";
          document.getElementById('judul').value = "";
          document.getElementById('penulis').value = "";
        }

        function Edit(index) {
          document.getElementById('action').value ="update";

          var table = document.getElementById("table_buku");

          var kode_buku = table.rows[index].cells[0].innerHTML;
          var genre = table.rows[index].cells[1].innerHTML;
          var judul = table.rows[index].cells[2].innerHTML;
          var penulis = table.rows[index].cells[3].innerHTML;

          document.getElementById("kode_buku").value = kode_buku;
          document.getElementById("genre").value = genre;
          document.getElementById("judul").value = judul;
          document.getElementById("penulis").value = penulis;
        }
      </script>
      <div class="card col-sm-12">
        <div class="card-header">
          <h4>Daftar Buku</h4>
        </div>
        <div class="card-body">
          <?php
            $koneksi = mysqli_connect("localhost","root","","perpustakaan");
            $sql = "select * from buku";
            $result = mysqli_query($koneksi,$sql);
            $count = mysqli_num_rows($result);
           ?>

           <?php if($count == 0): ?>
             <div class="alert alert-info">
               Data belum tersedia
             </div>
           <?php else: ?>
             <table class="table" id="table_buku">
               <thead>
                 <tr>
                   <th>Kode Buku</th>
                   <th>Genre</th>
                   <th>Judul</th>
                   <th>Penulis</th>
                   <th>Stok</th>
                   <th>Image</th>
                   <th>Opsi</th>
                 </tr>
               </thead>
               <tbody>
                 <?php foreach ($result as $hasil): ?>
                   <tr>
                     <td><?php echo $hasil["kode_buku"] ?></td>
                     <td><?php echo $hasil["genre"] ?></td>
                     <td><?php echo $hasil["judul"]; ?></td>
                     <td><?php echo $hasil["penulis"] ?></td>
                     <td><?php echo $hasil["stok"] ?></td>
                     <td>
                       <img src="<?php echo "img_book/".$hasil["image"]; ?>"
                       class="img" width="100">
                     </td>
                     <td>
                       <button type="button" class="btn btn-info"
                       data-toggle="modal" data-target="#modal"
                       onclick="Edit(this.parentElement.parentElement.rowIndex);">
                         Edit
                       </button>

                       <a href="db_buku.php?hapus=buku&kode_buku=<?php echo $hasil["kode_buku"]; ?>"
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
          data-toggle = "modal" data-target="#modal" onclick="Add()">
            Tambah
          </button>
        </div>
      </div>
    

    <div class="modal fade" id="modal">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <form  action="db_buku.php" method="post" enctype="multipart/form-data">
            <div class="modal-header">
              <h4>Data Buku</h4>
            </div>
            <div class="modal-body">
              <input type="hidden" name="action" id="action">

              Kode Buku
              <input type="text" name="kode_buku" id="kode_buku" class="form-control">
              Genre
              <input type="text" name="genre" id="genre" class="form-control">
              Judul
              <input type="text" name="judul" id="judul" class="form-control">
              Penulis
              <input type="text" name="penulis" id="penulis" class="form-control">
              Stok
              <input type="number" name="stok" id="stok" class="form-control">
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
