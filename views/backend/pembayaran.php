<script>
function changeStatus(x) {
    $.ajax({
        type: "POST",
        data: {
            id: x
        },
        url: '<?=base_url();?>pembayaran/editStatus',
        success: function(data) {
            toastr.success('Payment Successfully');
            setTimeout(() => {
                window.location =
                    "<?=site_url();?>pembayaran";
            }, 1000);
        }
    });
}
</script>
<!-- Content Header (Page header) -->
<?php if ($this->session->userdata('access') === 'super_user'||$this->session->userdata('access') === 'administrator'||$this->session->userdata('access') === 'user'): ?>
<section class="content-header">
    <h1>
        <?=$title;?>
        <!-- <small>KKNPayment</small> -->
    </h1>
    <ol class="breadcrumb">
        <a href="<?=base_url('pembayaran');?>" class="btn btn-sm btn-primary btn-flat" data-toggle="tooltip"
            data-placement="top" title="Refresh"><i class="fa fa-refresh"></i></a>
    </ol>
</section>
<?php endif;?>

<!-- Main content -->
<section class="content">
    <div class="box box-primary">
        <div class="box-body table-responsive">
            <table id="datatable" class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th width="20">NO</th>
                        <th>NIM</th>
                        <th>NAMA LENGKAP</th>
                        <th>JK</th>
                        <th>JENJANG</th>
                        <th>FAKULTAS</th>
                        <th>PROGRAM STUDI</th>
                        <th>STATUS</th>
                        <th width="20">Bayar?</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
					$n=1;
					foreach($bayar as $m):?>
                    <tr>
                        <td><?=$n++.'.';?></td>
                        <td><?=$m->nim;?></td>
                        <td><?=$m->nama_lengkap;?></td>
                        <td><?=$m->jk;?></td>
                        <td><?=$m->jenjang;?></td>
                        <td><?=$m->fakultas;?></td>
                        <td><?=$m->program_studi;?></td>
                        <td><span
                                class="label <?= $m->status_bayar=='Belum Bayar'?'label-warning':'label-success';?>"><?=$m->status_bayar;?></span>
                        </td>
                        <td class="text-center"><input type="checkbox" name="bayar" class="change-sts minimal"
                                onclick="changeStatus(<?=$m->idmahasiswa;?>)"
                                <?= $m->status_bayar=='Sudah Bayar'?'checked':'';?>>
                        </td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
</section>
