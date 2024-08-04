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
                            <form
                                action="<?= base_url('admin/tambah_penggunaan/' . (isset($id_pelanggan) ? $id_pelanggan : '')); ?>"
                                method="POST">
                                <div class="form-group">
                                    <label for="idpel">ID Pelanggan</label>
                                    <input type="text" class="form-control" id="idpel" name="idpel"
                                        value="<?= isset($id_pelanggan) ? $id_pelanggan : 'Data pelanggan tidak ditemukan'; ?>"
                                        readonly>
                                    <?= form_error('idpel', '<small class="text-danger">', '</small>'); ?>
                                </div>

                                <div class="form-group">
                                    <label for="bulan">Bulan</label>
                                    <select class="form-control" id="bulan" name="bulan">
                                        <option value="">Pilih Bulan</option>
                                        <option value="Januari">Januari</option>
                                        <option value="Februari">Februari</option>
                                        <option value="Maret">Maret</option>
                                        <option value="April">April</option>
                                        <option value="Mei">Mei</option>
                                        <option value="Juni">Juni</option>
                                        <option value="Juli">Juli</option>
                                        <option value="Agustus">Agustus</option>
                                        <option value="September">September</option>
                                        <option value="Oktober">Oktober</option>
                                        <option value="November">November</option>
                                        <option value="Desember">Desember</option>
                                    </select>
                                    <?= form_error('bulan', '<small class="text-danger">', '</small>'); ?>
                                </div>

                                <div class="form-group">
                                    <label for="tahun">Tahun</label>
                                    <input type="text" class="form-control" id="tahun" name="tahun">
                                    <?= form_error('tahun', '<small class="text-danger">', '</small>'); ?>
                                </div>

                                <div class="form-group">
                                    <label for="mawal">Meter Awal</label>
                                    <input type="number" class="form-control" id="mawal" name="mawal">
                                    <?= form_error('mawal', '<small class="text-danger">', '</small>'); ?>
                                </div>

                                <div class="form-group">
                                    <label for="makhir">Meter Akhir</label>
                                    <input type="number" class="form-control" id="makhir" name="makhir">
                                    <?= form_error('makhir', '<small class="text-danger">', '</small>'); ?>
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