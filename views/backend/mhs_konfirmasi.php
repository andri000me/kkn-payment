<section class="invoice" id="print">
    <form action="<?=base_url('welcome/verifikasi');?>" method="post" enctype="multipart/form-data">
        <!-- title row -->
        <div class="row">
            <div class="col-xs-12">
                <h2 class="page-header">
                    <i class="fa fa-users"></i> <?=$row->nim;?>
                </h2>
            </div>
            <!-- /.col -->
        </div>
        <!-- info row -->
        <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
                NIM
                <address>
                    <strong><?=$row->nim;?></strong>
                </address>
                Nama Lengkap
                <address>
                    <strong><?=$row->nama_lengkap;?></strong>
                </address>
                Jenis Kelamin
                <address>
                    <strong><?=$row->jk=='L'?'Laki-Laki':'Perempuan';?></strong>
                </address>
                <?php if($verifikasi->num_rows()>0):?>
                File Bukti
                <address>
                    <a href="<?=base_url('uploads/bukti/');?><?=$verifikasi->row()->bukti;?>"
                        target="_blank"><?=$verifikasi->row()->bukti;?></a>
                </address>
                <?php endif;?>
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
                Jenjang Pendidikan
                <address>
                    <strong><?=$row->jenjang;?></strong>
                </address>
                Fakultas
                <address>
                    <strong><?=$row->fakultas;?></strong>
                </address>
                Program Studi
                <address>
                    <strong><?=$row->program_studi;?></strong>
                </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
                <div class="form-group">
                    <label>Rekening Tujuan<span style="color:red;">*</span></label>
                    <select name="rek_id" class="form-control select2" style="width:100%;" required>
                        <option value="">--Pilih Nomor Rekening--</option>
                        <?php foreach(norek() as $i):?>
                        <option value="<?=$i->idrek;?>"><?=$i->rek_bank;?></option>
                        <?php endforeach;?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Jumlah Transfer<span style="color:red;">*</span></label>
                    <input type="hidden" class="form-control" name="mahasiswa_id" value="<?=$row->idmahasiswa;?>">
                    <input type="hidden" class="form-control" name="nim" value="<?=$row->nim;?>">
                    <input type="text" class="form-control uang" name="total_bayar" placeholder="Total transfer"
                        required>
                </div>
                <div class="form-group">
                    <label>Bukti Transfer<span style="color:red;">*</span></label>
                    <input type="file" class="form-control" name="image" placeholder="Total transfer" required>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->


        <div class="row">
            <?php foreach(norek() as $i):?>
            <div class="col-md-3">
                <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;" id="info_rekening">
                    <?=$i->rek_bank;?><br>
                    <b><?=$i->rek_nama;?></b><br>
                    <?=$i->rek_nomor;?>
                </p>
            </div>
            <?php endforeach;?>
        </div>
        <!-- /.row -->

        <!-- this row will not appear when printing -->
        <div class="row no-print">
            <div class="col-xs-12">
                <a href="<?=base_url('dashboard');?>" class="btn btn-default btn-sm btn-flat"><i
                        class="fa fa-reply"></i> Kembali</a>
                <button type="submit" class="btn btn-primary btn-sm btn-flat pull-right" style="margin-right: 5px;"
                    <?=$verifikasi->num_rows()>0?'disabled':'';?>>
                    <i class="fa fa-edit"></i> Verifikasi Pembayaran
                </button>
            </div>
        </div>
    </form>
</section>