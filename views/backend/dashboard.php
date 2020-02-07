<!-- Content Header (Page header) -->
<?php if ($this->session->userdata('access') === 'super_user'||$this->session->userdata('access') === 'administrator'||$this->session->userdata('access') === 'user'): ?>
<section class="content-header">
    <h1>
        Selamat Datang, <?=user()['user_fullname'];?>
        <!-- <small>KKNPayment</small> -->
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?=base_url('dashboard');?>"><i class="fa fa-home"></i> Home</a></li>
    </ol>
</section>
<?php endif;?>

<!-- Main content -->
<section class="content">
    <?php if ($this->session->userdata('access') === 'super_user'||$this->session->userdata('access') === 'administrator'||$this->session->userdata('access') === 'user'): ?>
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3><?=hitung('mahasiswa');?></h3>

                    <p>Total Mahasiswa</p>
                </div>
                <div class="icon">
                    <i class="fa fa-users"></i>
                </div>
                <a href="#" class="small-box-footer"><i class="fa fa-info"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3><?=hitung('mahasiswa','status_bayar','Sudah Bayar');?></h3>

                    <p>Total Sudah Bayar</p>
                </div>
                <div class="icon">
                    <i class="fa fa-check-square-o"></i>
                </div>
                <a href="#" class="small-box-footer"><i class="fa fa-info"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3><?=hitung('mahasiswa','status_bayar','Belum Bayar');?></h3>

                    <p>Total Belum Bayar</p>
                </div>
                <div class="icon">
                    <i class="fa fa-remove"></i>
                </div>
                <a href="#" class="small-box-footer"><i class="fa fa-info"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-blue">
                <div class="inner">
                    <h3><?=hitung('users');?></h3>

                    <p>Total Pengguna</p>
                </div>
                <div class="icon">
                    <i class="fa fa-user"></i>
                </div>
                <a href="#" class="small-box-footer"><i class="fa fa-info"></i></a>
            </div>
        </div>
        <!-- ./col -->
    </div>
    <?php endif;?>
    <div class="callout callout-info">
        <h4><i class="fa fa-info"></i> Informasi </h4>

        <p>Selamat datang di Aplikasi Pembayaran KKN, semoga Aplikasi ini dapat membantu anda.</p>
    </div>
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Cek Pembayaran KKN</h3>
        </div>
        <div class="box-body">
            <form action="<?=base_url('result?qcari=');?>" method="get">
                <div class="row">
                    <div class="col-md-12">
                        <div class="input-group">
                            <input type="text" class="form-control nim" name="qcari"
                                placeholder="Ketikkan NIM anda disini..." autofocus required>
                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-info btn-flat"><i class="fa fa-search"></i> Cari
                                    Data</button>
                            </span>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php if(isset($_GET['qcari'])):?>
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Hasil Pencarian "<b><?=$_GET['qcari'];?></b>"</h3>
            <a href="<?=base_url('dashboard');?>" class="btn btn-xs btn-primary pull-right"><i class="fa fa-trash"></i>
                Bersihkan</a>
        </div>
        <div class="box-body table-responsive">
            <table class="table table-striped table-hover">
                <tr>
                    <th>NIM</th>
                    <th>Nama Lengkap</th>
                    <th>JK</th>
                    <th>Jenjang</th>
                    <th>Fakultas</th>
                    <th>Program Studi</th>
                    <th>Status Pembayaran</th>
                    <th>Action</th>
                </tr>
                <?php if($row):?>
                <tr>
                    <td><?=$row->nim;?></td>
                    <td><?=$row->nama_lengkap;?></td>
                    <td><?=$row->jk;?></td>
                    <td><?=$row->jenjang;?></td>
                    <td><?=$row->fakultas;?></td>
                    <td><?=$row->program_studi;?></td>
                    <td>
                        <span
                            class="label <?= $row->status_bayar=='Belum Bayar'?'label-warning':'label-success';?>"><?=$row->status_bayar;?></span>
                    </td>
                    <td><a href="<?=base_url('konfirmasi_pembayaran/');?><?=enc_url($row->idmahasiswa);?>"
                            class="btn btn-primary btn-xs"
                            <?=$row->status_bayar=='Sudah Bayar'?'disabled':'';?>>Konfirmasi</a>
                    </td>
                </tr>
                <?php else:?>
                <tr>
                    <td colspan="7" class="text-center">Maaf, data yang anda cari tidak ditemukan !</td>
                </tr>
                <?php endif;?>
            </table>
        </div>
    </div>
    <?php endif;?>
</section>
<!-- /.content -->
