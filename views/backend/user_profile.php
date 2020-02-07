<section class="content-header">
    <h1>
        <?=$title;?>
    </h1>
</section>
<!-- Main content -->
<section class="content">
    <div class="box">
        <div class="box-body">
            <form action="<?=base_url('settings/editprofil');?>" method="post">
                <table class="table table-stripped">
                    <tr>
                        <td>Username</td>
                        <td>:</td>
                        <td>
                            <div class="form-group">
                                <input type="hidden" class="form-control" name="idusers" value="<?=$profil->idusers;?>">
                                <input type="text" class="form-control" name="user_name"
                                    value="<?=$profil->user_name;?>" readonly>
                                <span style="color:red;margin:0px;font-size:9pt;">* Username tidak dapat di
                                    rubah.</span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Nama Lengkap</td>
                        <td>:</td>
                        <td>
                            <div class="form-group">
                                <input type="text" class="form-control" name="user_fullname"
                                    value="<?=$profil->user_fullname;?>">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Nomor Handphone</td>
                        <td>:</td>
                        <td>
                            <div class="form-group">
                                <input type="text" class="form-control" name="user_telp"
                                    value="<?=$profil->user_telp;?>">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Password</td>
                        <td>:</td>
                        <td>
                            <div class="form-group">
                                <input type="password" class="form-control" name="user_password">
                                <span style="color:red;margin:0px;font-size:9pt;">* Biarkan kosong jika tidak ingin
                                    merubah
                                    password</span>
                            </div>
                        </td>
                    </tr>
                </table>
                <a href="<?=base_url('dashboard');?>" class="btn btn-sm btn-default btn-flat pull-left"><i
                        class="fa fa-reply"></i> Cancel</a>
                <button type="submit" class="btn btn-sm btn-success btn-flat pull-right"><i class="fa fa-save"></i> Save
                    & updata
                    profil</button>
            </form>
        </div>
    </div>
</section>




<!-- /.content -->
