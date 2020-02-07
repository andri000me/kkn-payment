<script>
function submit(x) {
    $.ajax({
        type: "POST",
        data: {
            id: x
        },
        url: '<?=base_url();?>settings/view',
        dataType: 'json',
        success: function(data) {
            $('[name="id"]').val(data.id);
            $('[name="value"]').val(data.setting_value);
        }
    });
}

function saveNew() {
    var nim = $('[name="nim"]').val();
    var nama_lengkap = $('[name="nama_lengkap"]').val();
    var jk = $('[name="jk"]').val();
    var tempat_lahir = $('[name="tempat_lahir"]').val();
    var tanggal_lahir = $('[name="tanggal_lahir"]').val();
    var jenjang = $('[name="jenjang"]').val();
    var fakultas = $('[name="fakultas"]').val();
    var program_studi = $('[name="program_studi"]').val();
    $.ajax({
        type: "POST",
        data: {
            nim: nim,
            nama_lengkap: nama_lengkap,
            jk: jk,
            tempat_lahir: tempat_lahir,
            tanggal_lahir: tanggal_lahir,
            jenjang: jenjang,
            fakultas: fakultas,
            program_studi: program_studi
        },
        url: '<?=base_url();?>mahasiswa/add',
        success: function(data) {
            $('#modal-add').modal('hide');
            if (data) {
                toastr.error(data);
            }
            setTimeout(() => {
                window.location =
                    "<?=site_url();?>mahasiswa";
            }, 2500);
        }
    });
}


function ubah_gambar(x) {
    $.ajax({
        type: "POST",
        data: {
            id: x
        },
        url: '<?=base_url();?>category/view',
        dataType: 'json',
        success: function(data) {
            var html = '<img src="<?= base_url(); ?>uploads/category/' + data.category_image +
                '" alt="kosong" width="100%" height="300">';
            $('#view_gambar').html(html);
            $('[name="idcategory"]').val(data.idcategory);
        }
    });
    if (x == 'ganti') {
        var action = '<?= base_url(); ?>category/editImgCategory';
        $('#form-ganti-gambar').attr('action', action).submit();
    }
}

function changeStatus(x) {
    $.ajax({
        type: "POST",
        data: {
            id: x
        },
        url: '<?=base_url();?>pembayaran/editStatus',
        success: function(data) {
            toastr.success('Payment Status Changed');
            setTimeout(() => {
                window.location =
                    "<?=site_url();?>pembayaran";
            }, 1000);
        }
    });
}
$(function() {

    $('#delete_permanen_all').click(function() {
        $('#modal_delete').modal('show', {
            backdrop: 'static',
            keyboard: false
        });
        $('#deleted').click(function() {
            var delete_check = $('.check:checked');
            if (delete_check.length > 0) {
                var delete_value = [];
                $(delete_check).each(function() {
                    delete_value.push($(this).val());
                });

                $.ajax({
                    type: 'post',
                    url: '<?=base_url();?>category/delete',
                    data: {
                        idx: delete_value
                    },
                    success: function() {
                        $('#modal_delete').modal('hide');
                        toastr.success("Deleted Permanentelly Successfully");
                        setTimeout(() => {
                            window.location =
                                "<?=site_url();?>category";
                        }, 2500);
                    }
                })
            } else {
                $('#modal_delete').modal('hide');
                toastr.warning("Please Select Data To Delete Permanentelly !");
            }
        })
    });

})
</script>
<!-- Content Header (Page header) -->
<?php if ($this->session->userdata('access') === 'super_user'||$this->session->userdata('access') === 'administrator'): ?>
<section class="content-header">
    <h1>
        <?=$title;?>
        <!-- <small>KKNPayment</small> -->
    </h1>
    <ol class="breadcrumb">
        <a href="<?=base_url('settings');?>" class="btn btn-sm btn-primary btn-flat" data-toggle="tooltip"
            data-placement="top" title="Refresh"><i class="fa fa-refresh"></i></a>
    </ol>
</section>
<?php endif;?>

<!-- Main content -->
<section class="content">
    <div class="box box-primary">
        <div class="box-body table-responsive">
            <table id="datatable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th width="20">NO</th>
                        <th width="5"><i class="fa fa-edit"></i></th>
                        <th>SETTING NAME</th>
                        <th>SETTING VALUE</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
					$n=1;
					foreach(setting('general') as $m):?>
                    <tr>
                        <td><?=$n++.'.';?></td>
                        <td><a href="#<?=idModal($m->setting_variable);?>" data-toggle="modal"
                                onclick="submit(<?=$m->id;?>)"><i class="fa fa-edit"></i></a></td>
                        <td><?=$m->setting_description;?></td>
                        <td><?php if($m->setting_value!='' || $m->setting_value!=null){echo $m->setting_value;}else{echo $m->setting_default;}?>
                        </td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
</section>
<!-- Modal view produk -->
<div class="modal fade" id="modal_edit" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?=base_url('settings/editGeneral');?>" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit Setting Value</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group" id="default-form">
                        <label>Setting Value <span style="color:red;">*</span></label>
                        <input type="hidden" class="form-control" name="id">
                        <input type="text" class="form-control" name="value" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-default btn-flat pull-left" data-dismiss="modal"><i
                            class="fa fa-remove"></i> Cancel</button>
                    <button type="submit" class="btn btn-sm btn-success btn-flat"><i class="fa fa-save"></i>
                        Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal view produk -->
<div class="modal fade" id="modal_edit_favicon" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?=base_url('settings/editFavicon');?>" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit Setting Value</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group" id="icon-form">
                        <label>Setting Value <span style="color:red;">*</span></label>
                        <input type="hidden" class="form-control" name="id">
                        <input type="file" class="form-control" name="image" required>
                        <span>File format : <b><?=settings('general','file_allowed_types');?></b></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-default btn-flat pull-left" data-dismiss="modal"><i
                            class="fa fa-remove"></i> Cancel</button>
                    <button type="submit" class="btn btn-sm btn-success btn-flat"><i class="fa fa-save"></i>
                        Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal view produk -->
<div class="modal fade" id="modal_edit_timezone" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?=base_url('settings/editGeneral');?>" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit Setting Value</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group" id="timezone-form">
                        <label>Setting Value <span style="color:red;">*</span></label>
                        <input type="hidden" class="form-control" name="id">
                        <select name="value" class="form-control select2" style="width: 100%;">
                            <?php foreach(timezone_list() as $tl):?>
                            <option value="<?=explode(' ',$tl)[1];?>"><?=$tl;?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-default btn-flat pull-left" data-dismiss="modal"><i
                            class="fa fa-remove"></i> Cancel</button>
                    <button type="submit" class="btn btn-sm btn-success btn-flat"><i class="fa fa-save"></i>
                        Save</button>
                </div>
            </form>
        </div>
    </div>
</div>