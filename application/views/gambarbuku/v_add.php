<div class="col-md-12">
  <div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Add Gambar buku : <?= $buku->judul ?></h3>

      <div class="card-tools">

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
      <?php
      //notifikasi form kosong
      echo validation_errors('<div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-info"></i>', '</h5> </div>');

      //notifikasi gagal upload gambar
      if (isset($error_upload)) {
        echo '<div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-info"></i>' . $error_upload . '</h5> </div>';
      }
      echo form_open_multipart('gambarbuku/add/' . $buku->id_buku) ?>

      <div class="row">
        <div class="col-sm-4">
          <div class="form-group">
            <label>Keterangan Gambar</label>
            <input name="keterangan" type="text" class="form-control" placeholder="Keterangan Gambar" value="<?= set_value('keterangan') ?>">
          </div>
        </div>
        <div class="col-sm-4">
          <div class="form-group">
            <label>Gambar buku</label>
            <input type="file" name="gambar" class="form-control" id="preview_gambar" required>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="form-group">
            <img src="<?= base_url('assets/gambar/no-foto.png') ?>" id="gambar_load" width="200px">
          </div>
        </div>
      </div>
      <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
      <a href="<?= base_url('gambarbuku') ?>" class="btn btn-success btn-sm">Kembali</a>

      <?php echo form_close() ?>

      <hr>
      <div class="row">
        <?php foreach ($gambar as $key => $value) { ?>
          <div class="col-sm-3">
            <div class="form-group">
              <img src="<?= base_url('assets/gambarbuku/' . $value->gambar) ?>" id="gambar_load" width="250px" height="200px">
            </div>
            <p href="">Keterangan : <?= $value->keterangan ?></p>
            <button data-toggle="modal" data-target="#delete<?= $value->id_gambar  ?>" class="btn btn-danger btn-xs btn-block"><i class="fa fa-trash"></i> Delete</button>
          </div>
        <?php } ?>

      </div>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>

<!-- /.modal delete -->
<?php foreach ($gambar as $key => $value) { ?>
  <div class="modal fade" id="delete<?= $value->id_gambar ?>">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Delete <?= $value->keterangan ?></h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body text-center">
          <div class="form-group">
            <img src="<?= base_url('assets/gambarbuku/' . $value->gambar) ?>" id="gambar_load" width="250px" height="200px">
          </div>
          <h5>Apakah Anda Yakin Akan Menghapus Gambar Ini...?</h5>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <a href="<?= base_url('gambarbuku/delete/' . $value->id_buku .'/' . $value->id_gambar) ?>" class="btn btn-primary">Delete</a>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
<?php } ?>

<script>
  function bacaGambar(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function(e) {
        $('#gambar_load').attr('src', e.target.result);
      }
      reader.readAsDataURL(input.files[0]);
    }
  }

  $("#preview_gambar").change(function() {
    bacaGambar(this);
  });
</script>