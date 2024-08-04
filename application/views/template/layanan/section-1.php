<div class='container'>
    <div class='tab-box mb-3'>
        <input hidden type="radio" name="tab-name" id="tab-1" checked>
    </div>

    <div class="row">
        <div class="col-md">
            <form action="<?= base_url('layanan/search'); ?>" method="post">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Cari ID" name="id" autocomplete="off" autofocus
                        aria-describedby="button-addon2">
                    <input class="btn btn-primary" type="submit" name="submit">
                </div>
            </form>
        </div>
    </div>

    <div class="container mt-3">
        <?php if (!empty($id) && !empty($pelanggan)) { ?>
        <div class="card" id="card" style="width: 100%; max-width: 600px; margin: auto;">
            <div class="card-body shadow-lg">
                <h5 class="text-center">Informasi Tagihan</h5>
                <table class="table table-striped">
                    <tbody>
                        <tr>
                            <th>ID Pelanggan</th>
                            <td><?= htmlspecialchars($pelanggan['id_pelanggan']); ?></td>
                        </tr>
                        <tr>
                            <th>Nama Pelanggan</th>
                            <td><?= htmlspecialchars($pelanggan['nama_pelanggan']); ?></td>
                        </tr>
                        <tr>
                            <th>Bulan</th>
                            <td><?= htmlspecialchars($pelanggan['bulan']); ?></td>
                        </tr>
                        <tr>
                            <th>Tahun</th>
                            <td><?= htmlspecialchars($pelanggan['tahun']); ?></td>
                        </tr>
                        <tr>
                            <th>Meter Awal</th>
                            <td><?= htmlspecialchars($pelanggan['meter_awal']); ?></td>
                        </tr>
                        <tr>
                            <th>Meter Akhir</th>
                            <td><?= htmlspecialchars($pelanggan['meter_akhir']); ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="card-footer text-center">
                <a href="<?= base_url('Layanan/tagihan/' . $pelanggan['id_pelanggan']); ?>"
                    class="btn btn-primary">Detail</a>
            </div>
        </div>
        <?php } elseif (!empty($id) && empty($pelanggan)) { ?>
        <div class="alert alert-warning" role="alert">
            No data found for ID: <?= htmlspecialchars($id); ?>.
        </div>
        <?php } ?>
    </div>


</div>