<!-- Main Content -->
<div id="content">

    <?php include('admin_topbar.php'); ?>

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-2">
            <h1 class="h3 mb-0 text-gray-800">Tambah Tarif</h1>
        </div>

        <div class="page-header mb-2">
            <?= $this->session->flashdata('message') ?>
        </div>

        <!-- Content Row -->
        <div class="row">

            <div class="col-md-6 ml-auto mr-auto mt-2">
                <div class="card">
                    <div class="card-header">
                        <h4>Form Tambah Tarif</h4>
                    </div>
                    <div class="card-body">
                        <form action="<?= base_url('admin/tambah_tarif') ?>" method="POST">
                            <div class="form-group">
                                <label for="id_tarif">ID Tarif</label>
                                <input type="text" class="form-control" id="id_tarif" name="id_tarif" required>
                            </div>
                            <div class="form-group">
                                <label for="daya">Daya</label>
                                <input type="text" class="form-control" id="daya" name="daya" required>
                            </div>
                            <div class="form-group">
                                <label for="tarifperkwh">Tarif Per KWH</label>
                                <input type="text" class="form-control" id="tarifperkwh" name="tarifperkwh" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Tambah Tarif</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- /.container-fluid