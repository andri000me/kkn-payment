<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?=settings('general','app_name');?> | <?=settings('general','tagline');?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="keywords" content="<?=settings('general','meta_keywords');?>" />
    <meta name="description" content="<?=settings('general','meta_description');?>" />
    <link rel="icon" href="<?=base_url('uploads/'. settings('general','favicon'));?>">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="<?=base_url('assets/');?>bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?=base_url('assets/');?>bower_components/font-awesome/css/font-awesome.min.css">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet"
        href="<?=base_url('assets/');?>bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <!-- DataTables -->
    <link rel="stylesheet"
        href="<?=base_url('assets/');?>bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="<?=base_url('assets/');?>bower_components/select2/dist/css/select2.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?=base_url('assets/');?>dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
	folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?=base_url('assets/');?>dist/css/skins/_all-skins.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">


    <!-- jQuery 3 -->
    <script src="<?=base_url('assets/');?>bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="<?=base_url('assets/');?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- SlimScroll -->
    <script src="<?=base_url('assets/');?>bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <!-- bootstrap datepicker -->
    <script src="<?=base_url('assets/');?>bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js">
    </script>
    <!-- DataTables -->
    <script src="<?=base_url('assets/');?>bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?=base_url('assets/');?>bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <!-- Select2 -->
    <script src="<?=base_url('assets/');?>bower_components/select2/dist/js/select2.full.min.js"></script>
    <!-- Mask Money -->
    <script src="<?= base_url('assets/'); ?>plugins/jquery-mask.min.js"></script>
    <!-- FastClick -->
    <script src="<?=base_url('assets/');?>bower_components/fastclick/lib/fastclick.js"></script>
    <!-- AdminLTE App -->
    <script src="<?=base_url('assets/');?>dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?=base_url('assets/');?>dist/js/demo.js"></script>
    <script>
    // Fungsi check all
    $(document).ready(function() {
        $('#datatable').DataTable({
            'paging': true,
            'lengthChange': true,
            'searching': true,
            'ordering': false,
            'info': true,
            'autoWidth': true
        });
        //Date picker
        $('#datepicker').datepicker({
            autoclose: true,
            format: 'yyyy-mm-dd'
        });

        $('.select2').select2()

        $('[data-toggle="tooltip"]').tooltip()

        $('.uang').mask('000.000.000.000.000', {
            reverse: true
        });
        $('.nim').mask('000000000', {
            reverse: true
        });

        $('#check_all').on('click', function() {
            if (this.checked) {
                $('.check').each(function() {
                    this.checked = true;
                });
            } else {
                $('.check').each(function() {
                    this.checked = false;
                });
            }
        });

        $('.check').on('click', function() {
            if ($('.check:checked').length == $('.check').length) {
                $('#check_all').prop('checked', true);
            } else {
                $('#check_all').prop('checked', false);
            }
        });
    });
    </script>
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->

<body class="hold-transition skin-purple layout-top-nav">
    <div class="wrapper">

        <header class="main-header">
            <nav class="navbar navbar-fixed-top">
                <div class="container">
                    <div class="navbar-header">
                        <a href="<?=base_url('dashboard');?>" class="navbar-brand"><b>KKN</b>Payment</a>
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                            data-target="#navbar-collapse">
                            <i class="fa fa-bars"></i>
                        </button>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                        <ul class="nav navbar-nav">
                            <li <?=isset($dashboard) ? 'class="active"':'';?>><a href="<?=base_url('dashboard');?>"><i
                                        class="fa fa-home"></i> Home
                                    <span class="sr-only">(current)</span></a></li>

                            <?php if ($this->session->userdata('access') === 'super_user'||$this->session->userdata('access') === 'administrator'||$this->session->userdata('access') === 'user'): ?>
                            <li <?=isset($mahasiswa) ? 'class="active"':'';?>><a href="<?=base_url('mahasiswa');?>"><i
                                        class="fa fa-users"></i> Mahasiswa</a></li>
                            <li <?=isset($pembayaran) ? 'class="active"':'';?>><a href="<?=base_url('pembayaran');?>"><i
                                        class="fa fa-money"></i>
                                    Pembayaran</a></li>
                            <li <?=isset($verifikasi) ? 'class="active"':'';?>><a
                                    href="<?=base_url('pembayaran/verifikasi');?>"><i class="fa fa-check-square-o"></i>
                                    Verifikasi<span class="badge bg-yellow"
                                        style="margin-top:-15px;margin-left:5px;"><?=hitung('pembayaran','is_verified','no');?></span></a>
                            </li>
                            <?php if ($this->session->userdata('access') === 'super_user'||$this->session->userdata('access') === 'administrator'): ?>
                            <li class="dropdown <?=isset($settings) ? 'active':'';?>">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-cog"></i>
                                    Pengaturan <span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <!-- <li <?=isset($general) ? 'class="active"':'';?>><a
                                            href="<?=base_url('settings');?>">Umum</a></li> -->
                                    <li <?=isset($information) ? 'class="active"':'';?>><a
                                            href="<?=base_url('settings/information');?>">Informasi</a></li>
                                    <li <?=isset($pengguna) ? 'class="active"':'';?>><a
                                            href="<?=base_url('settings/pengguna');?>">Pengguna</a></li>
                                    <?php if ($this->session->userdata('access') === 'super_user'): ?>
                                    <li class="divider"></li>
                                    <li><a href="<?=base_url('maintenance/backup_database');?>"><i
                                                class="fa fa-file-archive-o"></i> Backup Database</a></li>
                                    <li class="divider"></li>
                                    <li><a href="<?=base_url('maintenance/backup_apps');?>"><i
                                                class="fa fa-file-archive-o"></i> Backup Apps</a></li>
                                    <?php endif;?>
                                </ul>
                            </li>
                            <?php endif;?>
                            <?php else:?>
                            <li <?=isset($informasi) ? 'class="active"':'';?>><a href="<?=base_url('informasi');?>"><i
                                        class="fa fa-info"></i>
                                    Informasi</a></li>
                            <!-- <li><a href="#"><i class="fa fa-question"></i> Tutorial</a></li> -->
                            <?php endif;?>
                        </ul>
                    </div>
                    <!-- /.navbar-collapse -->
                    <!-- Navbar Right Menu -->
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <?php if ($this->session->userdata('access') === 'super_user'||$this->session->userdata('access') === 'administrator'||$this->session->userdata('access') === 'user'): ?>
                            <!-- User Account Menu -->
                            <li class="dropdown user user-menu" style="background-color:#f56954;">
                                <!-- Menu Toggle Button -->
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <!-- The user image in the navbar-->
                                    <img src="<?=base_url('assets/');?>dist/img/user.png" class="user-image"
                                        alt="User Image">
                                    <!-- hidden-xs hides the username on small devices so only the image appears. -->
                                    <span class="hidden-xs"><?=user()['user_fullname'];?></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- The user image in the menu -->
                                    <li class="user-header">
                                        <img src="<?=base_url('assets/');?>dist/img/user.png" class="img-circle"
                                            alt="User Image">

                                        <p>
                                            <?=user()['user_fullname'];?> - <?=user()['user_name'];?>
                                            <small>Member at <?=date('M Y',user()['create_at']);?></small>
                                        </p>
                                    </li>
                                    <!-- Menu Footer-->
                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <a href="<?=base_url('dashboard/user_profile/');?><?=enc_url(user()['idusers']);?>"
                                                class="btn btn-default btn-flat">Profil</a>
                                        </div>
                                        <div class="pull-right">
                                            <a href="<?=base_url('auth/logout');?>"
                                                class="btn btn-default btn-flat">Keluar</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <?php else:?>
                            <li><a href="<?=base_url('auth');?>"><i class="fa fa-sign-in"></i> LOGIN</a></li>
                            <?php endif;?>
                        </ul>
                    </div>
                    <!-- /.navbar-custom-menu -->
                </div>
                <!-- /.container-fluid -->
            </nav>
        </header>
        <!-- Full Width Column -->
        <div class="content-wrapper">
            <?php $this->load->view('backend/inc/alert'); ?>
            <div class="container" style="margin-top:55px;">
                <?php $this->load->view($content);?>
            </div>
            <!-- /.container -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <div class="container">
                <div class="pull-right hidden-xs">
                    <!-- <b>Version</b> 2.4.18 -->
                    Page rendered in <strong>{elapsed_time}</strong> seconds.
                </div>
                Copyright &copy; 2020-<?=date('Y');?> <strong><?=settings('general','app_name');?></strong>. All rights
                reserved.
            </div>
            <!-- /.container -->
        </footer>
    </div>
    <!-- ./wrapper -->

</body>





</html>