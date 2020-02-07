<!-- Main content -->
<section class="content">
    <?php foreach($row as $i):?>
    <div class="callout callout-success">
        <p>Dipublikasi pada tanggal : <?=date('d M Y',$i->create_at);?></p>
        <h4><?=$i->info_nama;?></h4>
        <p><?=$i->info_isi;?></p>
    </div>
    <?php endforeach;?>
</section>
<!-- /.content -->
