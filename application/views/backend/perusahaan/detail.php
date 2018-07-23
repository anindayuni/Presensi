<div id="content">
	<div id="content-header">
		<div id="breadcrumb">
			<a href="<?php echo base_url('mastercms'); ?>" title="" class="tip-bottom" data-original-title="Go to Home">
				<i class="icon-home"></i> Home </a>
			<a href="#" class="current"> Detail Perusahaan	</a>
		</div>
	</div>
	<!-- body start -->
	<div class="container-fluid">
		<div class="row-fluid">
			<div class="widget-box">
				<div class="widget-title"> <span class="icon"> <i class="icon-th"></i> </span>
					<h5>Static table</h5>
					<div class="buttons">
						<a href="<?php echo base_url('mastercms/perusahaan/edit/').$id; ?>" class="btn btn-mini btn-warning"></i> Edit </a>
						<button onclick="goBack()" class="btn btn-mini btn-default"></i> Kembali </button>
					</div>
				</div>
				<div class="widget-content nopadding">
					<table class="table table-striped">
						<thead></thead>
						<tbody>
							<tr class="odd gradeX" class="text-center">
								<td width="25%" rowspan="5">
									<img style="width: 80%; height: auto; padding: 10px; " name="Logo Perusahaan" src="
								<?php echo base_url("assets/images/qrcode/".$detail['qr_code']); ?>">
								</td>
							</tr>
							<tr>
								<td class="detail" width="13%">Kantor</td>
								<td>:</td>
								<td align="left"><?php echo ucwords($detail['perusahaan_title']); ?></td>
							</tr>
							<tr>
								<td class="detail">Nama Perusahaan</td>
								<td style="width: 1%">:</td>
								<td><?php echo $detail['lokasi_nama']; ?></td>
							</tr>
							<tr>
								<td class="detail">Alamat</td>
								<td>:</td>
								<td><?php echo $detail['perusahaan_alamat']; ?></td>
							</tr>
							<tr>
								<td class="detail">Jam Kerja</td>
								<td>&nbsp;</td>
								<td colspan="2">
									<?php if (!empty($jamkerja)): ?>
										<table class="table table-striped" width="100%">
											<thead style="font-weight: bold;">
												<tr>
													<td style="width:15%;">Hari</td>
													<td style="width:15%;">Jam Masuk</td>
													<td style="width:15%;">Jam Keluar</td>
												</tr>
											</thead>
											<tbody>
												<?php foreach ($jamkerja as $key => $value): ?>
													<tr>
														<td><?= $value['kerja_hari']; ?></td>
														<td><?= $value['jam_masuk']; ?></td>
														<td><?= $value['jam_keluar']; ?></td>
													</tr>
												<?php endforeach ?>	
											</tbody>
										</table>
										<?php else: ?>
											<span class="btn btn-primary"><a href="<?php echo base_url('mastercms/perusahaan/add_jam_kerja/').$detail['lokasi_id']; ?>" title="Detail" style="color: white">Tambah Jam Kerja</a></span>
										<?php endif ?>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>

		</div><!-- row fluid -->
	</div><!-- container fluid -->
</div><!-- content -->