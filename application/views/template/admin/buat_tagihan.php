<!-- Main Content -->
<div id="content">

    <?php include('admin_topbar.php'); ?>

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-2">
            <h1 class="h3 mb-0 text-gray-800"><?= $judul ?></h1>
        </div>

        <!-- Content Row -->
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header text-center mt-2">
                            <h4><?= $judul ?></h4>
                        </div>
                        <div class="card-body shadow-lg">
                            <form action="<?= base_url('admin/buat_tagihan'); ?>" method="POST">
                                <div class="form-group">
                                    <label for="idpel">ID Pelanggan</label>
                                    <input type="text" class="form-control" id="idpel" name="idpel" value="<?= isset($id_pelanggan) ? $id_pelanggan : 'Data pelanggan tidak ditemukan'; ?>" readonly>
                                    <?= form_error('idpel', '<small class="text-danger">', '</small>'); ?>
                                </div>

                                <div class="form-group">
                                    <label for="idpen">ID Penggunaan</label>
                                    <select class="form-control" id="idpen" name="idpen">
                                        <option value="">Pilih ID Penggunaan</option>
                                        <?php if (!empty($penggunaan)) : ?>
                                            <?php foreach ($penggunaan as $item) : ?>
                                                <option value="<?= $item['id_penggunaan']; ?>"><?= $item['id_penggunaan']; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                    <?= form_error('idpen', '<small class="text-danger">', '</small>'); ?>
                                </div>

                                <div class="form-group">
                                    <label for="bulan">Bulan</label>
                                    <input type="text" class="form-control" id="bulan" name="bulan" readonly>
                                    <?= form_error('bulan', '<small class="text-danger">', '</small>'); ?>
                                </div>

                                <div class="form-group">
                                    <label for="tahun">Tahun</label>
                                    <input type="text" class="form-control" id="tahun" name="tahun" readonly>
                                    <?= form_error('tahun', '<small class="text-danger">', '</small>'); ?>
                                </div>

                                <div class="form-group">
                                    <label for="jumlah">Jumlah Meter</label>
                                    <input type="text" class="form-control" id="jumlah" name="jumlah" readonly>
                                    <?= form_error('jumlah', '<small class="text-danger">', '</small>'); ?>
                                </div>

                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="form-control" id="status" name="status">
                                        <option value=""> Pilih Opsi </option>
                                        <option value="Belum Bayar"> Belum Dibayar </option>
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-primary btn-block">Tambah</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#idpen').change(function() {
                var idPenggunaan = $(this).val();

                if (idPenggunaan) {
                    $.ajax({
                        url: '<?= base_url('admin/get_bulan_tahun/'); ?>' +
                            idPenggunaan,
                        type: 'GET',
                        dataType: 'json',
                        success: function(response) {
                            $('#bulan').val(response.bulan || 'Data bulan tidak ditemukan');
                            $('#tahun').val(response.tahun || 'Data tahun tidak ditemukan');
                        },
                        error: function() {
                            $('#bulan').val('Terjadi kesalahan saat memuat data');
                            $('#tahun').val('Terjadi kesalahan saat memuat data');
                        }
                    });
                } else {
                    $('#bulan').val('');
                    $('#tahun').val('');
                }
            });
        });
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#idpen').change(function() {
                var idPenggunaan = $(this).val();

                if (idPenggunaan) {
                    $.ajax({
                        url: '<?= base_url('admin/get_meter/'); ?>' +
                            idPenggunaan,
                        type: 'GET',
                        dataType: 'json',
                        success: function(response) {
                            var meterAwal = response.meter_awal ||
                                'Data meter awal tidak ditemukan';
                            var meterAkhir = response.meter_akhir ||
                                'Data meter akhir tidak ditemukan';
                            var jumlahMeter = meterAwal + '' +
                                meterAkhir;

                            $('#jumlah').val(jumlahMeter);
                        },
                        error: function() {
                            $('#jumlah').val('Terjadi kesalahan saat memuat data');
                        }
                    });
                } else {
                    $('#jumlah').val('');
                }
            });
        });
    </script>