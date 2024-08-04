<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 font-weight-bold text-gray-800"></h1>
    <p class="mb-4">Mohon isi data diri anda dengan benar.</p>

    <!-- Content Row -->
    <div class="row">
        <div class="col-xl-8 col-lg-7">

            <!-- Area Chart -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"> Your Profile</h6>
                </div>
                <?php echo $this->session->userdata('message'); ?>
                <div class="card-body">
                    <form class="user" method="post" enctype="multipart/form-data" action="<?php echo base_url() . 'profile'; ?>">
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <small class="text-primary font-weight-bold">Nama Lengkap</small>
                                <input type="text" class="form-control form-control-user" name="nama" placeholder="Nama Lengkap" value="<?= $pelanggan['nama_pelanggan']; ?>">
                                <?php echo form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="col-sm-6">
                                <small class="text-primary font-weight-bold">Username</small>
                                <input type="text" class="form-control form-control-user" name="username" placeholder="username" value="<?= $pelanggan['username']; ?>">
                                <?php echo form_error('username', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                    </form>
                    <hr>
                </div>
            </div>
        </div>

        <!-- Donut Chart -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Profile Picture</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div id="imagePreview">
                        <img width="200" class="img-responsive" src="<?php echo base_url('assets/img/team-3.jpg'); ?>" />
                    </div>
                    <hr>
                    <small style="font-style: italic;">
                        “Tetap Semangat.” 
                    </small>
                </div>
            </div>
        </div>
    </div>