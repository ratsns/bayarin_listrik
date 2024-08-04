<!-- Main Content -->
<div id="content">

    <?php include('admin_topbar.php'); ?>

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-2">
            <h1 class="h3 mb-0 text-gray-800"><?= $judul ?></h1>
        </div>

        <div class="page-header mb-2">
            <a href="<?= base_url('admin/tambah_pelanggan') ?>" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fas fa-user-plus fa-sm text-white-50"></i> Tambah Data Pelanggan</a>
        </div>

        <div class="page-header mb-2">
            <?= $this->session->flashdata('message') ?>
        </div>

        <!-- Content Row -->
        <div class="row">

            <div class="table-responsive table-bordered col-sm-12 ml-auto mr-auto mt-2 text-center">
                <h4 class="mt-3 text-primary"> Data Pelanggan Listrik </h4>
                <table class="table mt-3">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID Pelanggan</th>
                            <th>Username</th>
                            <th>Nomor Kwh</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($pelanggan)) { ?>
                            <?php
                            $i = 1;
                            foreach ($pelanggan as $a) { ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td><?= htmlspecialchars($a['id_pelanggan']); ?></td>
                                    <td><?= htmlspecialchars($a['username']); ?></td>
                                    <td><?= htmlspecialchars($a['nomor_kwh']); ?></td>
                                    <td><?= htmlspecialchars($a['nama_pelanggan']); ?></td>
                                    <td><?= htmlspecialchars($a['alamat']); ?></td>
                                    <td>
                                        <a href="<?= base_url(); ?>" class="btn btn-warning btn-sm">
                                            <i style="color: #000;" class="fas fa-fw fa-pencil"></i>
                                        </a>
                                        <a href="<?= base_url('admin/hapus_pelanggan/' . $a['id_pelanggan']); ?>" class="btn btn-danger btn-sm">
                                            <i style="color: #000;" class="fa-solid fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>
                        <?php } else { ?>
                            <tr>
                                <td colspan="6">Tidak ada data ditemukan.</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->