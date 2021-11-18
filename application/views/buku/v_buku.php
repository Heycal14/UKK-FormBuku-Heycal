<div class="col-md-12">
  <div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Data Buku</h3>

      <div class="card-tools">
        <a href="<?= base_url('buku/add') ?>" type="button" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> 
        </a>
      </div>
      <!-- /.card-tools -->
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <?php
      if ($this->session->flashdata('pesan')) {
        echo ' <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-check"></i>';
        echo $this->session->flashdata('pesan');
        echo '</h5></div>';
      }
      ?>
      <table class="table table-bordered" id="example1">
        <thead class="text-center">
          <tr>
            <th>No</th>
            <th>Judul Buku</th>
            <th>Kategori</th>
            <th>Harga</th>
            <th>Gambar</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1;
          foreach ($buku as $key => $value) { ?>
            <tr class="text-center">
              <td><?= $no++; ?></td>
              <td>
                <?= $value->judul ?>
              </td>
              <td><?= $value->nama_kategori ?></td>
              <td><?= $value->pengarang ?></td>
              <td><?= $value->penerbit ?></td>
              <td><img src="<?= base_url('assets/gambar/' . $value->gambar) ?>" width="150px"></td>
              <td class="text-center">
                <a href="<?= base_url('buku/edit/' . $value->id_buku) ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete<?= $value->id_buku  ?>"><i class="fas fa-trash"></i></button>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>

<!-- /.modal delete -->
<?php foreach ($buku as $key => $value) { ?>
  <div class="modal fade" id="delete<?= $value->id_buku ?>">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Delete <?= $value->id_buku ?></h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <h5>Apakah Anda Yakin Akan Menghapus Data Ini...?</h5>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <a href="<?= base_url('buku/delete/' . $value->id_buku) ?>" class="btn btn-primary">Delete</a>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
<?php } ?>