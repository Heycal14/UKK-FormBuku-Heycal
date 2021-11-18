<!-- Default box -->
<div class="card card-solid">
    <div class="card-body">
        <div class="row">
            <div class="col-12 col-sm-6">
                <h3 class="d-inline-block d-sm-none"><?= $buku->judul ?></h3>
                <div class="col-12">
                    <img src="<?= base_url('assets/gambar/' . $buku->gambar) ?>" class="product-image" alt="Product Image">
                </div>
                <div class="col-12 product-image-thumbs">
                    <div class="product-image-thumb active"><img src="<?= base_url('assets/gambar/' . $buku->gambar) ?>" alt="Product Image"></div>
                    <?php foreach ($gambar as $key => $value) { ?>
                        <div class="product-image-thumb"><img src="<?= base_url('assets/gambarbuku/' . $value->gambar) ?>" alt="Product Image"></div>
                    <?php } ?>

                </div>
            </div>
            <div class="col-12 col-sm-6">
                <h3 class="my-3"><?= $buku->judul ?></h3>
                <hr>
                <h5><?= $buku->nama_kategori ?></h5>
                <hr>
                <h5><?= $buku->pengarang ?></h5>
                <hr>
                <h5><?= $buku->penerbit ?></h5>
                <hr>
                <p><?= $buku->deskripsi ?></p>
                <hr>

                <div class="mt-4 product-share">
                    <a href="https://www.facebook.com/heycal.heycal.90" class="text-gray">
                        <i class="fab fa-facebook-square fa-2x"></i>
                    </a>
                    <a href="https://twitter.com/KALIM18202995" class="text-gray">
                        <i class="fab fa-twitter-square fa-2x"></i>
                    </a>
                   
                </div>

            </div>
        </div>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->
<script src="<?= base_url() ?>template/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= base_url() ?>template/dist/js/demo.js"></script>
<script type="text/javascript">
    $(function() {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });

        $('.swalDefaultSuccess').click(function() {
            Toast.fire({
                icon: 'success',
                title: 'buku Berhasil Ditambahkan Ke Keranjang'
            })
        });
    });
</script>