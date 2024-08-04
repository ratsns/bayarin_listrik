<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $judul ?></title>
    <style>
        body {
            background-image: url('<?php echo base_url('assets/img/bg-pln.jpg'); ?>');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            margin: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: Arial, sans-serif;
        }

        .container {
            text-align: center;
            max-width: 100%;
            display: grid;
            place-items: center;
            height: 100vh;
            /* Atur sesuai kebutuhan */
        }

        .card {
            background-color: rgba(255, 255, 255, 0.85);
            /* Transparansi pada card */
        }

        .btn {
            place-items: center;
            display: inline-block;
        }
    </style>
    <!-- Load CSS lainnya jika diperlukan -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
</head>

<body>
    <div class="container">
        <section class="login">
            <!-- Outer Row -->
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->
                            <div class="row">
                                <div class="col-lg">
                                    <div class="p-5">
                                        <div class="text-center">
                                            <h1 class="h4 text-gray-900 mb-4"><b>Halaman Login Admin</b><br>
                                                <small>Aplikasi Pembayaran Listrik</small>
                                            </h1>
                                        </div>
                                        <?= $this->session->flashdata('pesan'); ?>
                                        <form class="user" method="post" action="<?= base_url('autentifikasi'); ?>">
                                            <div class="form-group mb-3">
                                                <input type="text" class="form-control form-control-user" value="<?= set_value('username'); ?>" id="username" placeholder="Username" name="username">
                                                <?= form_error('username', '<small class="text-danger pl-3">', '</small>'); ?>
                                            </div>
                                            <div class="form-group mb-3">
                                                <input type="password" class="form-control form-control-user" id="password" placeholder="Password" name="password">
                                                <?= form_error(
                                                    'password',
                                                    '<small class="text-danger pl-3">',
                                                    '</small>'
                                                ); ?>
                                            </div>
                                            <div class='btn'>
                                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                                    Masuk
                                                </button>
                                            </div>
                                        </form>
                                        <hr>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</body>

</html>