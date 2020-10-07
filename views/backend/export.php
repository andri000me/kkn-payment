<?php
	header("Cache-Control: no-cache, must-revalidate");
	header("Pragma: no-cache");
	header("Content-type: application/x-msexcel");
	header("Content-type: application/octet-stream");
	header("Content-Disposition: attachment; filename=Export_Excel.xls");
?>

<style type="text/css">
table,
th,
td {
    border-collapse: collapse;
    padding: 15px;
    margin: 10px;
    color: #000;
    font-size: 12pt;
    font-family: times;
}
</style>
<div style="text-align:center;">
    <span style="margin-left: 10px;font-size:14pt;font-family:times;"><b>LEMBAGA PENELITIAN DAN PENGABDIAN
            MASYARAKAT</b></span><br>
    <span style="margin-left: 10px;font-size:14pt;font-family:times;"><b>UNIVERSITAS PAPUA</b></span><br>
    <span style="margin-left: 10px;font-size:14pt;font-family:times;"><b>DATA MAHASISWA SELESAI KKN TAHUN
            <?= $tahun; ?></span>
</div>
<br>
<table border="1">
    <thead>
        <tr style="background-color:#b3e3af;">
            <th>NO</th>
            <th>NIM</th>
            <th>NAMA LENGKAP</th>
            <th>JK</th>
            <th>TTL</th>
            <th>JENJANG</th>
            <th>FAKULTAS</th>
            <th>PROGRAM STUDI</th>
        </tr>
    </thead>
    <?php
		$no=1;
		if($data->num_rows() > 0){
			foreach ($data->result() as $row) {
				?>
    <tr>
        <td><?= $no++; ?></td>
        <td><?= ucwords(strtolower($row->nim)); ?></td>
        <td><?= ucwords(strtolower($row->nama_lengkap)); ?></td>
        <td><?= $row->jk; ?></td>
        <td><?= ucwords(strtolower($row->tempat_lahir)).', '.date('d F Y',strtotime($row->tanggal_lahir)); ?></td>
        <td><?= $row->jenjang; ?></td>
        <td><?= ucwords(strtolower($row->fakultas)); ?></td>
        <td><?= ucwords(strtolower($row->program_studi)); ?></td>
    </tr>
    <?php
			}
		}
	?>

</table>