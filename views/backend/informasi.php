<script>
function submit(x) {
    if (x == 'add') {
        $('[name="idinfo"]').val("");
        $('[name="info_nama"]').val("");
        $('[name="info_isi"]').val("");
        $('#modal-add .modal-title').html('Add New Informasi');
        $('#btn-tambah').show();
        $('#btn-ubah').hide();
    } else {
        $('#modal-add .modal-title').html('Edit Informasi')
        $('#btn-tambah').hide();
        $('#btn-ubah').show();

        $.ajax({
            type: "POST",
            data: {
                id: x
            },
            url: '<?=base_url();?>settings/viewInfo',
            dataType: 'json',
            success: function(data) {
                $('[name="idinfo"]').val(data.idinfo);
                $('[name="info_nama"]').val(data.info_nama);
                $('[name="info_isi"]').val(data.info_isi);
            }
        });
    }
}

function norek(x) {
    if (x == 'add') {
        $('[name="idrek"]').val("");
        $('[name="rek_bank"]').val("");
        $('[name="rek_nama"]').val("");
        $('[name="rek_nomor"]').val("");
        $('#modal-add-rek .modal-title').html('Add New Rekening');
        $('#btn-tambah-rek').show();
        $('#btn-ubah-rek').hide();
    } else {
        $('#modal-add-rek .modal-title').html('Edit Rekening')
        $('#btn-tambah-rek').hide();
        $('#btn-ubah-rek').show();

        $.ajax({
            type: "POST",
            data: {
                id: x
            },
            url: '<?=base_url();?>settings/viewRek',
            dataType: 'json',
            success: function(data) {
                $('[name="idrek"]').val(data.idrek);
                $('[name="rek_bank"]').val(data.rek_bank);
                $('[name="rek_nama"]').val(data.rek_nama);
                $('[name="rek_nomor"]').val(data.rek_nomor);
            }
        });
    }
}

function saveNew() {
    var info_nama = $('[name="info_nama"]').val();
    var info_isi = $('[name="info_isi"]').val();
    $.ajax({
        type: "POST",
        cache: false,
        data: {
            info_nama: info_nama,
            info_isi: info_isi
        },
        url: '<?=base_url();?>settings/add',
        success: function(data) {
            $('#modal-add').modal('hide');
            if (data) {
                toastr.error(data);
            }
            setTimeout(() => {
                window.location =
                    "<?=site_url();?>settings/information";
            }, 1500);
        }
    });
}

function saveNewRek() {
    var rek_bank = $('[name="rek_bank"]').val();
    var rek_nama = $('[name="rek_nama"]').val();
    var rek_nomor = $('[name="rek_nomor"]').val();
    $.ajax({
        type: "POST",
        cache: false,
        data: {
            rek_bank: rek_bank,
            rek_nama: rek_nama,
            rek_nomor: rek_nomor
        },
        url: '<?=base_url();?>settings/addRek',
        success: function(data) {
            $('#modal-add-rek').modal('hide');
            if (data) {
                toastr.error(data);
            }
            setTimeout(() => {
                window.location =
                    "<?=site_url();?>settings/information";
            }, 1500);
        }
    });
}

function saveUpdate() {
    var idinfo = $('[name="idinfo"]').val();
    var info_nama = $('[name="info_nama"]').val();
    var info_isi = $('[name="info_isi"]').val();
    $.ajax({
        type: "POST",
        cache: false,
        data: {
            id: idinfo,
            info_nama: info_nama,
            info_isi: info_isi
        },
        url: '<?=base_url();?>settings/edit',
        success: function(data) {
            $('#modal-add').modal('hide');
            if (data) {
                toastr.error(data);
            }
            setTimeout(() => {
                window.location =
                    "<?=site_url();?>settings/information";
            }, 1500);
        }
    });
}

function saveUpdateRek() {
    var idrek = $('[name="idrek"]').val();
    var rek_bank = $('[name="rek_bank"]').val();
    var rek_nama = $('[name="rek_nama"]').val();
    var rek_nomor = $('[name="rek_nomor"]').val();
    $.ajax({
        type: "POST",
        cache: false,
        data: {
            id: idrek,
            rek_bank: rek_bank,
            rek_nama: rek_nama,
            rek_nomor: rek_nomor
        },
        url: '<?=base_url();?>settings/editRek',
        success: function(data) {
            $('#modal-add-rek').modal('hide');
            if (data) {
                toastr.error(data);
            }
            setTimeout(() => {
                window.location =
                    "<?=site_url();?>settings/information";
            }, 1500);
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

$(document).ready(function() {

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
        <a href="#" class="btn btn-sm btn-primary btn-flat" data-target="#modal-add" data-toggle="modal"
            onclick="submit('add')"><i class="fa fa-plus"></i>
            Add New</a>
        <a href="<?=base_url('pembayaran');?>" class="btn btn-sm btn-primary btn-flat" data-toggle="tooltip"
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
                        <th>NAMA INFORMASI</th>
                        <th>ISI INFORMASI</th>
                        <th>TANGGAL</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
					$n=1;
					foreach($informasi as $m):?>
                    <tr>
                        <td><?=$n++.'.';?></td>
                        <td><a href="#modal-add" data-toggle="modal" onclick="submit(<?=$m->idinfo;?>)"><i
                                    class="fa fa-edit"></i></a></td>
                        <td><?=$m->info_nama;?></td>
                        <td><?=$m->info_isi;?></td>
                        <td><?=date('d M Y',$m->create_at);?></td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
</section>
<section class="content">
    <div class="box box-primary">
        <div class="box-header with-border">
            <a href="#" class="btn btn-sm btn-primary btn-flat" data-target="#modal-add-rek" data-toggle="modal"
                onclick="norek('add')"><i class="fa fa-plus"></i>
                Add Rekening</a>
        </div>
        <div class="box-body table-responsive">
            <table id="datatable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th width="20">NO</th>
                        <th width="5"><i class="fa fa-edit"></i></th>
                        <th>NAMA BANK</th>
                        <th>NAMA REKENING</th>
                        <th>NOMOR REKENING</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
					$n=1;
					foreach($rekening as $m):?>
                    <tr>
                        <td><?=$n++.'.';?></td>
                        <td><a href="#modal-add-rek" data-toggle="modal" onclick="norek(<?=$m->idrek;?>)"><i
                                    class="fa fa-edit"></i></a></td>
                        <td><?=$m->rek_bank;?></td>
                        <td><?=$m->rek_nama;?></td>
                        <td><?=$m->rek_nomor;?></td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
</section>
<div class="modal fade" id="modal-add" role="dialog" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Nama Informasi<span style="color:red;">*</span></label>
                                <input type="hidden" class="form-control" name="idinfo">
                                <input type="text" class="form-control" name="info_nama"
                                    placeholder="ex: Rekening Bank BRI">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Isi Informasi<span style="color:red;">*</span></label>
                                <textarea class="form-control" name="info_isi" cols="30" rows="10"></textarea>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat btn-sm pull-left" data-dismiss="modal"><i
                        class="fa fa-remove"></i> Close</button>
                <button type="button" class="btn btn-success btn-flat btn-sm" onclick="saveNew()" id="btn-tambah"><i
                        class="fa fa-save"></i> Add New &
                    Save</button>
                <button type="button" class="btn btn-success btn-flat btn-sm" onclick="saveUpdate()" id="btn-ubah"><i
                        class="fa fa-save"></i> Update &
                    Save</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-add-rek" role="dialog" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Nama Bank<span style="color:red;">*</span></label>
                                <input type="hidden" class="form-control" name="idrek">
                                <input type="text" class="form-control" name="rek_bank" placeholder="ex: Bank BRI">
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label>Nama Pemilik Rekening<span style="color:red;">*</span></label>
                                <input type="text" class="form-control" name="rek_nama"
                                    placeholder="ex: Universitas Papua">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Nomor Rekening<span style="color:red;">*</span></label>
                                <input type="text" class="form-control" name="rek_nomor"
                                    placeholder="ex: 21232-52525-1252-55-5">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat btn-sm pull-left" data-dismiss="modal"><i
                        class="fa fa-remove"></i> Close</button>
                <button type="button" class="btn btn-success btn-flat btn-sm" onclick="saveNewRek()"
                    id="btn-tambah-rek"><i class="fa fa-save"></i> Add New &
                    Save</button>
                <button type="button" class="btn btn-success btn-flat btn-sm" onclick="saveUpdateRek()"
                    id="btn-ubah-rek"><i class="fa fa-save"></i> Update &
                    Save</button>
            </div>

        </div>
    </div>
</div>
