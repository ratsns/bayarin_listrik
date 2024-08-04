<!-- Main Content -->
<div id="content">

    <?php include('admin_topbar.php'); ?>

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-2">
            <h1 class="h3 mb-0 text-gray-800"><?= $judul; ?></h1>
            <!-- Tombol untuk menambahkan tarif -->
            <a href="<?= base_url('admin/form_tambah_tarif') ?>" class="btn btn-primary btn-sm">
                <i class="fa fa-plus"></i> Tambah Tarif
            </a>
        </div>

        <div class="page-header mb-2">
            <?= $this->session->flashdata('message') ?>
        </div>

        <!-- Content Row -->
        <div class="row">

            <div class="table-responsive table-bordered col-sm-12 ml-auto mr-auto mt-2 text-center">
                <h4 class="mt-3 text-primary">  Data Tarif </h4>
                <table class="table mt-3">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID Tarif</th>
                            <th>Daya</th>
                            <th>Tarif Per KWH</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($tarif)) { ?>
                            <?php
                            $i = 1;
                            foreach ($tarif as $a) { ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td><?= htmlspecialchars($a['id_tarif']); ?></td>
                                    <td><?= htmlspecialchars($a['daya']); ?></td>
                                    <td><?= htmlspecialchars($a['tarifperkwh']); ?></td>
                                </tr>
                            <?php } ?>
                        <?php } else { ?>
                            <tr>
                                <td colspan="4">Tidak ada data ditemukan.</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->
</div>