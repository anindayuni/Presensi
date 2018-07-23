<?php 
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=$title.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>

<table border="1" width="100%">
	<thead>
		<tr style="background-color: #e1e1e1;">
			<th>No</th>
			<th>Hari, Tanggal</th>
			<th>Nama Karyawan</th>
			<th>Jam Masuk</th>
			<th>Jam Keluar</th>
			<th>Status</th>
			<th>Keterangan</th>
		</tr>
	</thead>
	<tbody>
		<?php $i=1; foreach($user as $user) { ?>
			<tr>
				<td><?= $i; ?></td>
				<td><?= hari($user->tanggal).', '.tanggal($user->tanggal); ?></td>
				<td><?= $user->karyawan_nama ?></td>
				<td><?= $user->jam_masuk_absen ?></td>
				<td><?= $user->jam_keluar_absen ?></td>
				<td><?= $user->status ?></td>
				<td><?php if (!empty($user->keteragan)) echo $user->keterangan; else echo "-"; ?></td>
			</tr>
		<?php $i++; } ?>
	</tbody>
</table>