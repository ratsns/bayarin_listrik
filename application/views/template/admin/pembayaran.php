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
                <h4 class="mt-3 text-primary">  Data Pembayaran Listrik </h4>
                <table class="table mt-3">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID Pelanggan</th>
                            <th>Nama</th>
                            <th>Nomor Kwh</th>
                            <th>Bulan</th>
                            <th>Alamat</th>
                            <th>Status Bayar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($pembayaran)) { ?>
                            <?php
                            $i = 1;
                            foreach ($pembayaran as $b) { ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td><?= htmlspecialchars($b['id_pelanggan']); ?></td>
                                    <td><?= htmlspecialchars($b['nama_pelanggan']); ?></td>
                                    <td><?= htmlspecialchars($b['nomor_kwh']); ?></td>
                                    <td><?= htmlspecialchars($b['bulan_tagihan']?? ''); ?></td>
                                    <td><?= htmlspecialchars($b['alamat']); ?></td>
                                    <td>
                                        <?= htmlspecialchars($b['status_bayar']); ?>
                                    </td>
                                    <td>
                                    <a href="<?= base_url('admin/delete/' . $b['id_pembayaran']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
    <i class="bi bi-trash3-fill"></i>
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