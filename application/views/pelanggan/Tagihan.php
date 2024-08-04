<div class="card" style="width: 100%;">
    <div class="card-body">
        <h5 class="card-title">Data Tagihan</h5>
    </div>
    <div class="container mt-3">
        <?php if (!empty($tagihan)) : ?>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID Tagihan</th>
                    <th scope="col">ID Penggunaan</th>
                    <th scope="col">Bulan</th>
                    <th scope="col">Tahun</th>
                    <th scope="col">Jumlah Meter</th>
                    <th scope="col">Status</th>
                    <th scope="col">ID Pelanggan</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tagihan as $item) : ?>
                <tr>
                    <td><?= htmlspecialchars($item['id_tagihan']); ?></td>
                    <td><?= htmlspecialchars($item['id_penggunaan']); ?></td>
                    <td><?= htmlspecialchars($item['bulan']); ?></td>
                    <td><?= htmlspecialchars($item['tahun']); ?></td>
                    <td><?= htmlspecialchars($item['meter_awal']) . ' - ' . htmlspecialchars($item['meter_akhir']); ?>
                    </td>
                    <td><?= htmlspecialchars($item['status']); ?></td>
                    <td><?= htmlspecialchars($item['id_pelanggan']); ?></td>
                    <td><a href="<?= base_url('layanan/proses_pembayaran/' . $item['id_tagihan']); ?>"
                            class="btn btn-primary">Lanjut Bayar</a></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php else : ?>
        <p>No data found for this customer.</p>
        <?php endif; ?>
    </div>
</div>