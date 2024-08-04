<!-- Main Content -->
<div id="content">

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
                            <form action="<?= base_url('layanan/bayar') ?>" method="POST">
                                <div class="form-group">
                                    <label for="nama">Nama Pelanggan</label>
                                    <input type="text" class="form-control" id="nama" name="nama"
                                        value="<?= $nama_pelanggan['nama_pelanggan'] ?>" readonly>
                                    <?= form_error('nama', '<small class="text-danger">', '</small>'); ?>
                                </div>
                                <div class="form-group" hidden>
                                    <label for="idpel">ID Pelanggan</label>
                                    <input type="text" class="form-control" id="idpel" name="idpel"
                                        value="<?= isset($tagihan['id_pelanggan']) ? $tagihan['id_pelanggan'] : 'ID tagihan tidak ditemukan'; ?>"
                                        readonly>
                                    <?= form_error('idpel', '<small class="text-danger">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="id_tagihan">ID Tagihan</label>
                                    <input type="text" class="form-control" id="id_tagihan" name="id_tagihan"
                                        value="<?= isset($tagihan['id_tagihan']) ? $tagihan['id_tagihan'] : 'ID tagihan tidak ditemukan'; ?>"
                                        readonly>
                                    <?= form_error('id_tagihan', '<small class="text-danger">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="idpen">ID Penggunaan</label>
                                    <input type="text" class="form-control" id="idpen" name="idpen"
                                        value="<?= isset($tagihan['id_penggunaan']) ? $tagihan['id_penggunaan'] : 'ID tagihan tidak ditemukan'; ?>"
                                        readonly>
                                    <?= form_error('idpen', '<small class="text-danger">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="bulan">Bulan</label>
                                    <input type="text" class="form-control" id="bulan" name="bulan"
                                        value="<?= isset($tagihan['bulan']) ? $tagihan['bulan'] : 'ID tagihan tidak ditemukan'; ?>"
                                        readonly>
                                    <?= form_error('bulan', '<small class="text-danger">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="tahun">Tahun</label>
                                    <input type="text" class="form-control" id="tahun" name="tahun"
                                        value="<?= isset($tagihan['tahun']) ? $tagihan['tahun'] : 'ID tagihan tidak ditemukan'; ?>"
                                        readonly>
                                    <?= form_error('tahun', '<small class="text-danger">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="jumlah">Jumlah Meter</label>
                                    <input type="text" class="form-control" id="jumlah" name="jumlah"
                                        value="<?= isset($tagihan['jumlah_meter']) ? $tagihan['jumlah_meter'] : 'ID tagihan tidak ditemukan'; ?>"
                                        readonly>
                                    <?= form_error('jumlah', '<small class="text-danger">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="idtarif">Tarif</label>
                                    <input type="text" class="form-control" id="idtarif" name="idtarif"
                                        value="Tarif <?= isset($id_tarif['id_tarif']) ? $id_tarif['id_tarif'] : 'ID tagihan tidak ditemukan'; ?>"
                                        readonly>
                                    <?= form_error('idtarif', '<small class="text-danger">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="badmin">Biaya Admin</label>
                                    <input type="text" class="form-control" id="badmin" name="badmin" value="2500"
                                        readonly>
                                    <?= form_error('badmin', '<small class="text-danger">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="total">Total biaya yang akan dibayar</label>
                                    <input type="text" class="form-control" id="total" name="total"
                                        value="Rp <?= number_format($total_cost, 2); ?>" readonly>
                                    <?= form_error('total', '<small class="text-danger">', '</small>'); ?>
                                </div>

                                <button type="submit" class="btn btn-primary btn-block">Bayar Sekarang</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->