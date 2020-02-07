<!-- Content Header (Page header) -->
<?php if ($this->session->userdata('access') === 'super_user'): ?>
<section class="content-header">
    <h1>
        <?=$title;?>
    </h1>
</section>
<?php endif;?>

<!-- Main content -->
<section class="content">
    <div class="box box-primary">
        <div class="box-body table-responsive">
            <h4>Panduan Import</h4>
            <ol>
                <li>Copy dan paste <strong>[NIM] [NAMA LENGKAP] [JENIS KELAMIN] [JENJANG] [FAKULTAS] [PROGRAM
                        STUDI]</strong> dari Ms. Excel pada Text Area dibawah.</li>
                <li>Kolom <strong>JENIS KELAMIN</strong> diisi huruf <strong>"L"</strong> jika Laki-laki dan
                    <strong>"P"</strong> jika Perempuan.</li>
                <!-- <li>Kolom <strong>TANGGAL LAHIR</strong> diisi dengan format <strong>"YYYY-MM-DD"</strong>. Contoh :
                    <strong>1991-03-15</strong></li> -->
            </ol>
            <form action="<?=base_url('mahasiswa/import_proses');?>" method="post">
                <div class="form-group">
                    <textarea class="form-control" rows="15" name="mhs" placeholder="Paste here..."></textarea>
                </div>
                <a href="<?=base_url('mahasiswa');?>" class="btn btn-sm btn-default pull-left"> <i
                        class="fa fa-reply"></i> Kembali</a>
                <button type="submit" class="btn btn-sm btn-success pull-right"> <i class="fa fa-save"></i> Import
                    Data</button>
            </form>
        </div>
    </div>
</section>
