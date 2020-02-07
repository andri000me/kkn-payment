<script>
function changeStatus(x) {
    $.ajax({
        type: "POST",
        data: {
            id: x
        },
        url: '<?=base_url();?>pembayaran/verified',
        success: function(data) {
            toastr.success('Payment Verified Successfully');
            setTimeout(() => {
                window.location =
                    "<?=site_url();?>pembayaran/verifikasi";
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
                        <th>MAHASISWA</th>
                        <th>PENDIDIKAN</th>
                        <th>REKENING</th>
                        <th>TOTAL BAYAR</th>
                        <th>STATUS</th>
                        <th width="20">Verifikasi?</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
					$n=1;
					foreach($verdata as $m):?>
                    <tr>
                        <td><?=$n++.'.';?></td>
                        <td>
                            <?=$m->nim;?>
                            <hr style="padding:0px;margin:0px;border:0.5px dashed">
                            <a href="<?=base_url('uploads/bukti/'.$m->bukti);?>" target="_blank"><?=$m->bukti;?></a>
                        </td>
                        <td>
                            <?=$m->nama_lengkap;?>
                            <hr style="padding:0px;margin:0px;border:0.5px dashed">
                            <?=$m->jk;?>
                        </td>
                        <td>
                            <?=$m->jenjang;?>
                            <hr style="padding:0px;margin:0px;border:0.5px dashed">
                            <?=$m->fakultas;?>
                            <hr style="padding:0px;margin:0px;border:0.5px dashed">
                            <?=$m->program_studi;?>
                        </td>
                        <td>
                            <?=$m->rek_bank;?>
                            <hr style="padding:0px;margin:0px;border:0.5px dashed">
                            <?=$m->rek_nama;?>
                            <hr style="padding:0px;margin:0px;border:0.5px dashed">
                            <?=$m->rek_nomor;?>
                        </td>
                        <td><?='Rp. '.money($m->total_bayar);?></td>
                        <td><span
                                class="label <?= $m->is_verified=='no'?'label-warning':'label-success';?>"><?=ucfirst($m->is_verified);?></span>
                        </td>
                        <td class="text-center"><input type="checkbox" name="verify" class="verified"
                                onclick="changeStatus(<?=$m->mahasiswa_id;?>)">
                        </td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
</section>
