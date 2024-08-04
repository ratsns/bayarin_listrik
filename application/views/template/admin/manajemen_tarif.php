<!-- Main Content -->
<div id="content">

    <?php include('admin_topbar.php'); ?>

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-2">
            <h1 class="h3 mb-0 text-gray-800"><?= $judul; ?></h1>
        </div>

        <div class="page-header mb-2">
            <?= $this->session->flashdata('message') ?>
        </div>

        <!-- Content Row -->
        <div class="row">

            <div class="table-responsive table-bordered col-sm-12 ml-auto mr-auto mt-2 text-center">
                <h4 class="mt-3 text-primary"> Data Penggunaan Listrik </h4>
                <table class="table mt-3">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID Tarif</th>
                            <th>tarif Per KWH</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($penggunaan)) { ?>
                            <?php
                            $i = 1;
                            foreach ($penggunaan as $a) { ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td><?= htmlspecialchars($a['id_pelanggan']); ?></td>
                                    <td><?= htmlspecialchars($a['nama_pelanggan']); ?></td>
                                    <td><?= htmlspecialchars($a['bulan']); ?></td>
                                    <td><?= htmlspecialchars($a['meter_awal']); ?></td>
                                    <td><?= htmlspecialchars($a['meter_akhir']); ?></td>
                                    <td><?= htmlspecialchars($a['jumlah_meter']); ?></td>
                                    <td>
                                        <a href="<?= base_url('admin/tambah_penggunaan/' . $a['id_pelanggan']); ?>" class="btn btn-success btn-sm">
                                            <i style="color: #000;" class="fa-solid fa-plus"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>
                        <?php } else { ?>
                            <tr>
                                <td colspan="8">Tidak ada data ditemukan.</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->