<script>
function submit(x) {
    if (x == 'add') {
        $('[name="id"]').val("");
        $('[name="category_name"]').val("");
        $('[name="category_description"]').val("");
        $('#modal-add .modal-title').html('Add New Mahasiswa');
        $('#btn-tambah').show();
        $('#btn-ubah').hide();
    } else {
        $('#modal-add .modal-title').html('Edit Category')
        $('#image').hide();
        $('#btn-tambah').hide();
        $('#btn-ubah').show();

        $.ajax({
            type: "POST",
            data: {
                id: x
            },
            url: '<?=base_url();?>category/view',
            dataType: 'json',
            success: function(data) {
                $('[name="idcategory"]').val(data.idcategory);
                $('[name="category_name"]').val(data.category_name);
                $('[name="category_description"]').val(data.category_description);
            }
        });
    }
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
            }, 1500);
        }
    });
}

$(function() {
    $('#selesai_all').click(function() {
        $('#modal_selesai').modal('show', {
            backdrop: 'static',
            keyboard: false
        });
        $('#selesai').click(function() {
            var delete_check = $('.check:checked');
            if (delete_check.length > 0) {
                var delete_value = [];
                $(delete_check).each(function() {
                    delete_value.push($(this).val());
                });
                $.ajax({
                    type: 'post',
                    url: '<?=site_url();?>mahasiswa/selesai',
                    data: {
                        id: delete_value
                    },
                    success: function() {
                        $('#modal_selesai').modal('hide');
                        toastr.success("Status Update Successfully");
                        setTimeout(() => {
                            window.location =
                                "<?=site_url();?>mahasiswa";
                        }, 2500);
                    }
                })
            } else {
                $('#modal_selesai').modal('hide');
                toastr.warning("Please Select Data To Change Status !");
            }
        })
    });
    $('#delete_all').click(function() {
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
                    url: '<?=site_url();?>mahasiswa/delete',
                    data: {
                        id: delete_value
                    },
                    success: function() {
                        $('#modal_delete').modal('hide');
                        toastr.success("Deleted Successfully");
                        setTimeout(() => {
                            window.location =
                                "<?=site_url();?>mahasiswa";
                        }, 2500);
                    }
                })
            } else {
                $('#modal_delete').modal('hide');
                toastr.warning("Please Select Data To Deleted !");
            }
        })
    });
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
                    url: '<?=base_url();?>mahasiswa/delete',
                    data: {
                        idx: delete_value
                    },
                    success: function() {
                        $('#modal_delete').modal('hide');
                        toastr.success("Deleted Permanentelly Successfully");
                        setTimeout(() => {
                            window.location =
                                "<?=site_url();?>mahasiswa";
                        }, 2500);
                    }
                })
            } else {
                $('#modal_delete').modal('hide');
                toastr.warning("Please Select Data To Delete Permanentelly !");
            }
        })
    });
    $('#restore_all').click(function() {
        var restore_check = $('.check:checked');
        if (restore_check.length > 0) {
            var restore_value = [];
            $(restore_check).each(function() {
                restore_value.push($(this).val());
            });
            $.ajax({
                type: 'post',
                url: '<?=site_url();?>mahasiswa/restore',
                data: {
                    id: restore_value
                },
                success: function() {
                    toastr.success("Restored Successfully");
                    setTimeout(() => {
                        window.location =
                            "<?=site_url();?>mahasiswa";
                    }, 2500);
                }
            })
        } else {
            toastr.warning("Please Select Data To Restore !");
        }
    });
})
</script>
<!-- Content Header (Page header) -->
<?php if ($this->session->userdata('access') === 'super_user'||$this->session->userdata('access') === 'administrator'||$this->session->userdata('access') === 'user'): ?>
<section class="content-header">
    <h1>
        <?=$title;?>
    </h1>
    <ol class="breadcrumb">
        <a href="#" class="btn btn-sm btn-primary btn-flat" data-target="#modal-add" data-toggle="modal"
            onclick="submit('add')"><i class="fa fa-plus"></i>
            Add New</a>
        <a href="<?=base_url('mahasiswa/import');?>" class="btn btn-sm btn-primary btn-flat" data-toggle="tooltip"
            data-placement="top" title="Import Excel"><i class="fa fa-file-excel-o"></i></a>
        <a href="#" class="btn btn-sm btn-primary btn-flat" data-toggle="tooltip" data-placement="top"
            title="Selesai KKN" id="selesai_all"><i class="fa fa-check"></i></a>
        <a href="#" class="btn btn-sm btn-primary btn-flat" data-toggle="tooltip" data-placement="top" title="Delete"
            id="delete_all"><i class="fa fa-recycle"></i></a>
        <a href="#" class="btn btn-sm btn-primary btn-flat" data-toggle="tooltip" data-placement="top"
            title="Delete Permanentelly" id="delete_permanen_all"><i class="fa fa-trash"></i></a>
        <a href="#" class="btn btn-sm btn-primary btn-flat" data-toggle="tooltip" data-placement="top" title="Restore"
            id="restore_all"><i class="fa fa-history"></i></a>
        <a href="<?=base_url('mahasiswa');?>" class="btn btn-sm btn-primary btn-flat" data-toggle="tooltip"
            data-placement="top" title="Refresh"><i class="fa fa-refresh"></i></a>
        <a href="#" class="btn btn-sm btn-primary btn-flat" data-toggle="modal" data-target="#modal_laporan"><i
                class="fa fa-file-excel-o"></i> Laporan</a>
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
                        <th width="5"><input type="checkbox" id="check_all" value=""></th>
                        <th>NIM</th>
                        <th>NAMA LENGKAP</th>
                        <th>JK</th>
                        <th>JENJANG</th>
                        <th>FAKULTAS</th>
                        <th>PROGRAM STUDI</th>
                        <th>STATUS</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
					$n=1;
					foreach($mhs as $m):?>
                    <tr <?php if($m->is_deleted=='true'){ echo 'style="color:red;text-decoration:line-through;"';}?>>
                        <td><?=$n++.'.';?></td>
                        <td><input type="checkbox" class="check" name="check_id[]" value="<?=$m->idmahasiswa;?>"></td>
                        <td><?=$m->nim;?></td>
                        <td><?=$m->nama_lengkap;?></td>
                        <td><?=$m->jk;?></td>
                        <td><?=$m->jenjang;?></td>
                        <td><?=$m->fakultas;?></td>
                        <td><?=$m->program_studi;?></td>
                        <td><span
                                class="label <?php if($m->status=='Baru'){echo 'label-primary';}elseif($m->status=='Proses'){echo 'label-info';}else{echo 'label-success';}?>"><?=$m->status;?></span>
                        </td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
</section>
<!-- Modal Add New Mahasiswa -->
<div class="modal fade" id="modal-add">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <form action="" method="post" id="add-mahasiswa">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>NIM<span style="color:red;">*</span></label>
                                <input type="text" class="form-control nim" name="nim" placeholder="ex: 201552001">
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label>Nama Lengkap<span style="color:red;">*</span></label>
                                <input type="text" class="form-control" name="nama_lengkap" placeholder="ex: John Andy">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Jenis Kelamin<span style="color:red;">*</span></label>
                                <select name="jk" class="form-control select2" style="width: 100%;">
                                    <option value="L">Laki-Laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label>Tempat Lahir</label>
                                <input type="text" class="form-control" name="tempat_lahir" placeholder="ex: Bintuni">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Tanggal Lahir</label>
                                <div class="input-group date" id="datepicker">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" name="tanggal_lahir">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Jenjang<span style="color:red;">*</span></label>
                                <input type="text" class="form-control" name="jenjang" placeholder="ex: S1">
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label>Faluktas<span style="color:red;">*</span></label>
                                <input type="text" class="form-control" name="fakultas" placeholder="ex: Teknik">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Program Studi<span style="color:red;">*</span></label>
                                <input type="text" class="form-control" name="program_studi"
                                    placeholder="ex: Teknik Komputer">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat btn-sm pull-left" data-dismiss="modal"><i
                        class="fa fa-remove"></i> Close</button>
                <button type="button" class="btn btn-success btn-flat btn-sm" onclick="saveNew()"><i
                        class="fa fa-save"></i> Add New &
                    Save</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal konfirmasi delete -->
<div class="modal fade" id="modal_delete" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Konfirmasi</h4>
            </div>
            <div class="modal-body bg-red">
                <p>Anda yakin akan menghapus data ini ? </p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-default btn-flat" data-dismiss="modal">Cancel</button>
                <button class="btn btn-sm btn-danger btn-flat" id="deleted">Yes, Delete</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal konfirmasi selesai -->
<div class="modal fade" id="modal_selesai" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Konfirmasi</h4>
            </div>
            <div class="modal-body bg-yellow">
                <p>Anda yakin mahasiswa ini telah selesai KKN ? </p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-default btn-flat" data-dismiss="modal">Cancel</button>
                <button class="btn btn-sm btn-success btn-flat" id="selesai">Yes, Selesai</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal laporan -->
<div class="modal fade" id="modal_laporan" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?=base_url('mahasiswa/export');?>" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Export Laporan</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Pilih Tahun </label>
                        <select name="tahun" class="form-control select2" style="width:100%">
                            <?php foreach(tahun() as $thn):?>
                            <option value="<?= $thn; ?>"><?= $thn; ?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-sm btn-default btn-flat pull-left" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-sm btn-success btn-flat pull-right" type="submit"><i
                            class="fa fa-file-excel-o"></i> Export</button>
                </div>
            </form>
        </div>
    </div>
</div>